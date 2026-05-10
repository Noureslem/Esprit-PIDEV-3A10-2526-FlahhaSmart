(function () {
    function urgencyClass(level) {
        if (level === 'high') {
            return 'bg-red-100 text-red-700';
        }

        if (level === 'medium') {
            return 'bg-orange-100 text-orange-700';
        }

        return 'bg-emerald-100 text-emerald-700';
    }

    function categoryLabel(value) {
        switch (value) {
            case 'critique':
                return 'critique';
            case 'eleve':
                return 'eleve';
            case 'moyen':
                return 'moyen';
            default:
                return 'faible';
        }
    }

    function setText(element, value) {
        if (element) {
            element.textContent = value;
        }
    }

    window.initIrrigationModule = function initIrrigationModule(scope) {
        var root = (scope || document).querySelector('#irrigationModule');
        if (!root || root.dataset.initialized === 'true') {
            return;
        }

        root.dataset.initialized = 'true';

        var endpoint = root.dataset.endpoint;
        var form = root.querySelector('#irrigationForm');
        var submitButton = root.querySelector('#irrigationSubmit');
        var loader = root.querySelector('#irrigationLoader');
        var errorBox = root.querySelector('#irrigationError');

        var urgency = root.querySelector('#irrigationUrgency');
        var water = root.querySelector('#irrigationWater');
        var duration = root.querySelector('#irrigationDuration');
        var time = root.querySelector('#irrigationTime');
        var date = root.querySelector('#irrigationDate');
        var justification = root.querySelector('#irrigationJustification');
        var urgencyScore = root.querySelector('#irrigationUrgencyScore');
        var urgencyCategory = root.querySelector('#irrigationUrgencyCategory');
        var weatherLocation = root.querySelector('#irrigationWeatherLocation');
        var weatherTemp = root.querySelector('#irrigationWeatherTemp');
        var weatherHumidity = root.querySelector('#irrigationWeatherHumidity');
        var weatherDesc = root.querySelector('#irrigationWeatherDesc');
        var weatherSource = root.querySelector('#irrigationWeatherSource');
        var recommendationsList = root.querySelector('#irrigationRecommendations');

        if (!form || !endpoint) {
            return;
        }

        function setLoading(isLoading) {
            if (loader) {
                loader.classList.toggle('hidden', !isLoading);
            }
            if (submitButton) {
                submitButton.disabled = isLoading;
            }
        }

        function setError(message) {
            if (!errorBox) {
                return;
            }

            errorBox.textContent = message || '';
            errorBox.classList.toggle('hidden', !message);
        }

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            setError('');
            setLoading(true);

            var formData = new FormData(form);
            var payload = Object.fromEntries(formData.entries());

            try {
                var response = await fetch(endpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                var result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(result.error || 'Impossible de generer un plan d irrigation.');
                }

                var plan = result.data;

                setText(water, Number(plan.waterAmount || 0).toFixed(1));
                setText(duration, String(plan.duration || 0));
                setText(time, plan.irrigationTime || '--');
                setText(date, plan.irrigationDate || '--');
                setText(justification, plan.justification || '--');
                setText(urgencyScore, String(plan.urgencyScore || 0));
                setText(urgencyCategory, categoryLabel(plan.urgencyCategory || 'faible'));

                if (plan.weather) {
                    setText(weatherLocation, String(plan.weather.location || '--'));
                    setText(weatherTemp, String(plan.weather.temperature || '--') + ' deg C');
                    setText(weatherHumidity, String(plan.weather.humidity || '--') + ' %');
                    setText(weatherDesc, String(plan.weather.description || '--'));
                    setText(weatherSource, String(plan.weather.source || 'api'));
                }

                if (recommendationsList && Array.isArray(plan.recommendations) && plan.recommendations.length > 0) {
                    recommendationsList.innerHTML = plan.recommendations.map(function (entry) {
                        return '<li>' + String(entry) + '</li>';
                    }).join('');
                }

                if (urgency) {
                    urgency.className = 'inline-flex px-3 py-1 rounded-full text-xs font-semibold ' + urgencyClass(plan.urgencyLevel || 'low');
                    urgency.textContent = (plan.urgencyLevel || 'low').toUpperCase();
                }
            } catch (error) {
                setError(error && error.message ? error.message : 'Erreur reseau.');
            } finally {
                setLoading(false);
            }
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof window.initIrrigationModule === 'function') {
            window.initIrrigationModule(document);
        }
    });
})();
