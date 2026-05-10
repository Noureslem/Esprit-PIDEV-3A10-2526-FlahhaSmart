(function () {
    function formatNow() {
        return new Date().toLocaleString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function inferTheme(description) {
        var value = (description || '').toLowerCase();
        if (value.indexOf('rain') !== -1 || value.indexOf('pluie') !== -1) {
            return 'rain';
        }
        if (value.indexOf('cloud') !== -1 || value.indexOf('nuage') !== -1) {
            return 'cloud';
        }
        return 'sun';
    }

    function toNumber(value, fallback) {
        var parsed = Number(value);
        return Number.isFinite(parsed) ? parsed : fallback;
    }

    function buildTips(data) {
        var tips = [];
        var desc = (data.weather_descriptions || '').toLowerCase();
        var humidity = toNumber(data.humidity, 0);
        var wind = toNumber(data.wind_speed, 0);
        var temp = toNumber(data.temperature, 0);

        tips.push({
            title: 'Observation generale',
            description: 'Surveillez les conditions toutes les 3-4 heures pour ajuster vos operations.',
            color: 'slate'
        });

        if (temp < 10) {
            tips.push({
                title: 'Temps frais',
                description: 'Temperature basse: privilegiez les interventions en milieu de jour et limitez les semis sensibles.',
                color: 'orange'
            });
        }

        if (humidity > 80) {
            tips.push({
                title: 'Humidite elevee',
                description: 'Risque de maladies foliaires: augmentez la surveillance sanitaire et espacez les irrigations.',
                color: 'green'
            });
        }

        if (wind > 30) {
            tips.push({
                title: 'Vent fort',
                description: 'Evitez les traitements pulverises et securisez les jeunes plants contre la casse.',
                color: 'orange'
            });
        }

        if (desc.indexOf('rain') !== -1 || desc.indexOf('pluie') !== -1) {
            tips.push({
                title: 'Pluie detectee',
                description: 'Reportez les travaux mecaniques et ajustez le drainage pour eviter la saturation du sol.',
                color: 'blue'
            });
        }

        if (tips.length <= 1) {
            tips.push({
                title: 'Conditions stables',
                description: 'Fenetre favorable pour planifier les interventions culturales prevues.',
                color: 'green'
            });
        }

        return tips;
    }

    function tipClasses(color) {
        var map = {
            slate: 'border-slate-400 bg-slate-50 text-slate-700',
            orange: 'border-orange-400 bg-orange-50 text-orange-800',
            blue: 'border-blue-400 bg-blue-50 text-blue-800',
            green: 'border-emerald-400 bg-emerald-50 text-emerald-800'
        };

        return map[color] || map.slate;
    }

    function renderTips(list, tips) {
        if (!list) {
            return;
        }

        list.innerHTML = tips.map(function (tip) {
            var classes = tipClasses(tip.color).split(' ');
            return [
                '<article class="tip-item border-l-4 rounded-lg p-4 transition-shadow ', classes.join(' '), '">',
                '<h4 class="font-semibold mb-1">', tip.title, '</h4>',
                '<p class="text-sm mb-0">', tip.description, '</p>',
                '</article>'
            ].join('');
        }).join('');
    }

    function applyTheme(root, badge, theme) {
        if (!root) {
            return;
        }

        root.classList.remove('is-sun', 'is-rain', 'is-cloud');
        root.classList.add(theme === 'rain' ? 'is-rain' : theme === 'cloud' ? 'is-cloud' : 'is-sun');

        if (!badge) {
            return;
        }

        badge.textContent = theme === 'rain' ? 'Pluie' : theme === 'cloud' ? 'Nuageux' : 'Ensoleille';
    }

    window.initWeatherDashboard = function initWeatherDashboard(scope) {
        var root = (scope || document).querySelector('#weatherDashboard');
        if (!root || root.dataset.initialized === 'true') {
            return;
        }

        root.dataset.initialized = 'true';

        var endpoint = root.dataset.weatherEndpoint;
        var defaultCity = root.dataset.defaultCity || 'Tunis';

        var cityInput = root.querySelector('#weatherCityInput');
        var searchBtn = root.querySelector('#weatherSearchBtn');
        var locationText = root.querySelector('#weatherLocationText');
        var tempText = root.querySelector('#weatherMainTemp');
        var descText = root.querySelector('#weatherMainDesc');
        var feelsLikeText = root.querySelector('#weatherFeelsLike');
        var humidityText = root.querySelector('#weatherHumidity');
        var windText = root.querySelector('#weatherWind');
        var updatedAtText = root.querySelector('#weatherUpdatedAt');
        var weatherLoader = root.querySelector('#weatherLoader');
        var weatherError = root.querySelector('#weatherError');
        var weatherCard = root.querySelector('.weather-card-main');
        var themeBadge = root.querySelector('#weatherThemeBadge');
        var tipsList = root.querySelector('#agriTipsList');

        function setLoading(state) {
            if (weatherLoader) {
                weatherLoader.classList.toggle('hidden', !state);
            }
            if (searchBtn) {
                searchBtn.disabled = state;
            }
        }

        function setError(message) {
            if (!weatherError) {
                return;
            }
            weatherError.textContent = message || '';
            weatherError.classList.toggle('hidden', !message);
        }

        async function loadWeather(city) {
            var queryCity = (city || defaultCity || '').trim();
            if (!queryCity) {
                setError('Veuillez entrer une ville.');
                return;
            }

            setError('');
            setLoading(true);

            try {
                var response = await fetch(endpoint + '?city=' + encodeURIComponent(queryCity));
                var payload = await response.json();

                if (!response.ok || !payload.success) {
                    throw new Error(payload.error || 'Impossible de charger la meteo.');
                }

                var data = payload.data;
                var feelsLike = toNumber(data.feelslike, toNumber(data.temperature, 0));
                var theme = inferTheme(data.weather_descriptions);

                locationText.textContent = data.location || queryCity;
                tempText.textContent = String(toNumber(data.temperature, 0)) + '°C';
                descText.textContent = data.weather_descriptions || '--';
                feelsLikeText.textContent = String(feelsLike) + '°C';
                humidityText.textContent = String(toNumber(data.humidity, 0)) + '%';
                windText.textContent = String(toNumber(data.wind_speed, 0).toFixed(1)) + ' km/h';
                updatedAtText.textContent = formatNow();

                applyTheme(weatherCard, themeBadge, theme);
                renderTips(tipsList, buildTips(data));
            } catch (error) {
                setError(error && error.message ? error.message : 'Erreur reseau.');
            } finally {
                setLoading(false);
            }
        }

        if (searchBtn) {
            searchBtn.addEventListener('click', function () {
                loadWeather(cityInput ? cityInput.value : defaultCity);
            });
        }

        if (cityInput) {
            cityInput.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    loadWeather(cityInput.value);
                }
            });
        }

        loadWeather(cityInput ? cityInput.value : defaultCity);
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof window.initWeatherDashboard === 'function') {
            window.initWeatherDashboard(document);
        }
    });
})();
