(function () {
    'use strict';

    var STORAGE_KEY = 'workspace_plantnet_history_v1';
    var MAX_HISTORY_ITEMS = 6;
    var MAX_IMAGE_SIZE = 8 * 1024 * 1024;
    var ACCEPTED_MIME_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    function toPercent(value) {
        var number = Number(value);
        if (!Number.isFinite(number)) {
            return 0;
        }

        // PlantNet may return score in [0, 1].
        if (number > 1) {
            return clamp(number, 0, 100);
        }

        return clamp(number * 100, 0, 100);
    }

    function formatBytes(bytes) {
        var size = Number(bytes);
        if (!Number.isFinite(size) || size <= 0) {
            return '0 B';
        }

        if (size < 1024) {
            return size.toFixed(0) + ' B';
        }

        if (size < 1024 * 1024) {
            return (size / 1024).toFixed(1) + ' KB';
        }

        return (size / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function formatDate(isoString) {
        if (!isoString) {
            return '--';
        }

        var date = new Date(isoString);
        if (Number.isNaN(date.getTime())) {
            return '--';
        }

        return date.toLocaleString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function loadHistory() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) {
                return [];
            }

            var data = JSON.parse(raw);
            return Array.isArray(data) ? data : [];
        } catch (error) {
            return [];
        }
    }

    function saveHistory(entries) {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(entries));
        } catch (error) {
            // ignore storage failures
        }
    }

    function confidenceTone(percent) {
        if (percent >= 80) {
            return 'text-emerald-700 bg-emerald-100 border-emerald-200';
        }

        if (percent >= 55) {
            return 'text-amber-700 bg-amber-100 border-amber-200';
        }

        return 'text-rose-700 bg-rose-100 border-rose-200';
    }

    function buildSuggestionHtml(item, index) {
        var confidence = toPercent(item.confidence || item.score || 0);
        var commonName = Array.isArray(item.commonNames) && item.commonNames.length > 0
            ? item.commonNames[0]
            : item.scientificName;
        var thumb = item.imageUrl
            ? '<img src="' + escapeHtml(item.imageUrl) + '" alt="miniature" class="h-12 w-12 rounded-lg object-cover border border-slate-200">'
            : '<span class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-slate-100 text-slate-400"><i class="bi bi-image"></i></span>';

        return [
            '<article class="rounded-xl border border-slate-200 bg-white px-3 py-2 flex items-start gap-3">',
            thumb,
            '<div class="flex-1 min-w-0">',
            '<p class="text-xs uppercase tracking-wide text-slate-500 mb-1">Suggestion ', (index + 1), '</p>',
            '<p class="font-semibold text-slate-900 leading-tight">', escapeHtml(commonName || '-'), '</p>',
            '<p class="text-xs text-slate-500 truncate">', escapeHtml(item.scientificName || '-'), '</p>',
            '<p class="text-xs text-slate-500 mt-1">Famille: ', escapeHtml(item.family || 'N/A'), ' - Genre: ', escapeHtml(item.genus || 'N/A'), '</p>',
            '</div>',
            '<span class="text-xs font-semibold rounded-full border px-2 py-1 whitespace-nowrap ', confidenceTone(confidence), '">',
            confidence.toFixed(1), '%',
            '</span>',
            '</article>'
        ].join('');
    }

    function buildDiseaseHtml(item) {
        var confidence = toPercent(item.confidence || item.score || 0);
        var severity = (item && item.severity) ? String(item.severity) : '';
        var recommendations = Array.isArray(item && item.recommendations) ? item.recommendations : [];
        var thumb = item.imageUrl
            ? '<img src="' + escapeHtml(item.imageUrl) + '" alt="maladie" class="h-10 w-10 rounded-lg object-cover border border-amber-200">'
            : '<span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 text-amber-500"><i class="bi bi-shield-exclamation"></i></span>';

        var severityLabel = severity
            ? '<span class="inline-flex items-center rounded-full border border-amber-200 bg-white px-2 py-0.5 text-[11px] font-semibold text-amber-900">' + escapeHtml(severity) + '</span>'
            : '';

        var recHtml = '';
        if (recommendations.length) {
            recHtml = '<ul class="mt-2 text-xs text-amber-900 list-disc ps-4 space-y-1">' + recommendations.slice(0, 4).map(function (rec) {
                return '<li>' + escapeHtml(rec) + '</li>';
            }).join('') + '</ul>';
        }

        return [
            '<div class="rounded-xl border border-amber-200 bg-white/80 px-3 py-2 flex items-start gap-3">',
            thumb,
            '<div class="flex-1">',
            '<div class="flex items-center justify-between gap-2">',
            '<p class="font-semibold text-amber-900">', escapeHtml(item.name || item.disease || 'Diagnostic inconnu'), '</p>',
            severityLabel,
            '</div>',
            recHtml || '<p class="text-xs text-amber-800 mt-1">Diagnostic sans recommandations.</p>',
            '</div>',
            '<span class="text-xs font-semibold text-amber-900">', confidence.toFixed(1), '%</span>',
            '</div>'
        ].join('');
    }

    function createToast(container, message, type) {
        if (!container) {
            return;
        }

        var toast = document.createElement('div');
        toast.className = 'plantnet-toast ' + (type === 'error' ? 'is-error' : 'is-success');
        toast.textContent = message;

        container.appendChild(toast);

        requestAnimationFrame(function () {
            toast.classList.add('is-visible');
        });

        window.setTimeout(function () {
            toast.classList.remove('is-visible');
            window.setTimeout(function () {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 180);
        }, 2600);
    }

    function validateFile(file) {
        if (!file) {
            return 'Veuillez choisir une image.';
        }

        if (ACCEPTED_MIME_TYPES.indexOf(file.type) === -1) {
            return 'Formats acceptes: JPG, PNG, WEBP.';
        }

        if (file.size > MAX_IMAGE_SIZE) {
            return 'Image trop lourde (8 Mo max).';
        }

        return '';
    }

    window.initPlantNetModule = function initPlantNetModule(scope) {
        var root = (scope || document).querySelector('#plantnetWorkspace');
        if (!root || root.dataset.initialized === 'true') {
            return;
        }

        root.dataset.initialized = 'true';

        var endpoint = root.dataset.endpoint || '';
        var form = root.querySelector('#plantnetForm');
        var dropzone = root.querySelector('#plantnetDropzone');
        var fileInput = root.querySelector('[data-plantnet-file-input="1"]')
            || root.querySelector('input[type="file"][name$="[image]"]');
        var submitButton = root.querySelector('#plantnetSubmit');
        var loader = root.querySelector('#plantnetLoader');
        var alertBox = root.querySelector('#plantnetAlert');
        var fieldError = root.querySelector('#plantnetFieldError');
        var previewPanel = root.querySelector('#plantnetPreviewPanel');
        var previewImage = root.querySelector('#plantnetImagePreview');
        var fileName = root.querySelector('#plantnetFileName');
        var fileSize = root.querySelector('#plantnetFileSize');

        var resultEmpty = root.querySelector('#plantnetResultEmpty');
        var resultContent = root.querySelector('#plantnetResultContent');
        var topImage = root.querySelector('#plantnetTopImage');
        var topName = root.querySelector('#plantnetTopName');
        var topScientific = root.querySelector('#plantnetTopScientific');
        var topMeta = root.querySelector('#plantnetTopMeta');
        var topScore = root.querySelector('#plantnetTopScore');
        var topScoreBar = root.querySelector('#plantnetTopScoreBar');
        var suggestionsList = root.querySelector('#plantnetSuggestionsList');
        var diseasesCard = root.querySelector('#plantnetDiseaseCard');
        var diseasesList = root.querySelector('#plantnetDiseaseList');
        var remainingRequests = root.querySelector('#plantnetRemainingRequests');

        var historyBlock = root.querySelector('#plantnetHistoryBlock');
        var historyList = root.querySelector('#plantnetHistoryList');
        var clearHistoryButton = root.querySelector('#plantnetHistoryClear');

        var toastContainer = root.querySelector('#plantnetToastContainer');

        var detectDiseasesCheckbox = form
            ? form.querySelector('input[type="checkbox"][name$="[detectDiseases]"]')
            : null;

        if (!form || !dropzone || !fileInput || !submitButton || !endpoint) {
            return;
        }

        var currentFile = null;
        var previewObjectUrl = null;

        dropzone.setAttribute('role', 'button');
        dropzone.setAttribute('tabindex', '0');

        function clearFieldError() {
            if (!fieldError) {
                return;
            }

            fieldError.textContent = '';
            fieldError.classList.add('hidden');
        }

        function showFieldError(message) {
            if (!fieldError) {
                return;
            }

            fieldError.textContent = message;
            fieldError.classList.remove('hidden');
        }

        function setAlert(message, type) {
            if (!alertBox) {
                return;
            }

            if (!message) {
                alertBox.textContent = '';
                alertBox.className = 'hidden rounded-xl px-3 py-2 text-sm';
                return;
            }

            var tone = type === 'error'
                ? 'border border-red-200 bg-red-50 text-red-700'
                : 'border border-emerald-200 bg-emerald-50 text-emerald-700';

            alertBox.textContent = message;
            alertBox.className = 'rounded-xl px-3 py-2 text-sm ' + tone;
        }

        function setLoading(state) {
            if (loader) {
                loader.classList.toggle('hidden', !state);
            }

            submitButton.disabled = state;
            submitButton.classList.toggle('opacity-70', state);
            submitButton.classList.toggle('cursor-not-allowed', state);
        }

        function clearPreview() {
            if (previewObjectUrl) {
                URL.revokeObjectURL(previewObjectUrl);
                previewObjectUrl = null;
            }

            if (previewImage) {
                previewImage.removeAttribute('src');
            }

            if (fileName) {
                fileName.textContent = '-';
            }

            if (fileSize) {
                fileSize.textContent = '-';
            }

            if (previewPanel) {
                previewPanel.classList.add('hidden');
            }
        }

        function syncInputFile(file) {
            if (!file || typeof DataTransfer === 'undefined') {
                return;
            }

            var transfer = new DataTransfer();
            transfer.items.add(file);
            fileInput.files = transfer.files;
        }

        function applyFile(file) {
            var validationError = validateFile(file);
            if (validationError) {
                showFieldError(validationError);
                createToast(toastContainer, validationError, 'error');
                currentFile = null;
                clearPreview();
                return false;
            }

            clearFieldError();
            currentFile = file;
            syncInputFile(file);

            if (previewImage && previewPanel) {
                previewObjectUrl = URL.createObjectURL(file);
                previewImage.src = previewObjectUrl;
                previewPanel.classList.remove('hidden');
            }

            if (fileName) {
                fileName.textContent = file.name;
            }

            if (fileSize) {
                fileSize.textContent = formatBytes(file.size);
            }

            return true;
        }

        function pushHistory(data) {
            var best = data && data.bestMatch ? data.bestMatch : null;
            if (!best) {
                return;
            }

            var entries = loadHistory();
            entries.unshift({
                label: (Array.isArray(best.commonNames) && best.commonNames.length > 0 ? best.commonNames[0] : best.scientificName) || 'Resultat',
                scientificName: best.scientificName || '--',
                confidence: Number(best.confidence || toPercent(best.score || 0)).toFixed(1),
                createdAt: new Date().toISOString()
            });

            saveHistory(entries.slice(0, MAX_HISTORY_ITEMS));
            renderHistory();
        }

        function renderHistory() {
            if (!historyBlock || !historyList) {
                return;
            }

            var entries = loadHistory();
            if (!entries.length) {
                historyBlock.classList.add('hidden');
                historyList.innerHTML = '';
                return;
            }

            historyBlock.classList.remove('hidden');
            historyList.innerHTML = entries.map(function (entry) {
                var confidence = toPercent(entry.confidence || 0);
                return [
                    '<div class="rounded-xl border border-slate-200 bg-white px-3 py-2 flex items-center justify-between gap-3">',
                    '<div class="min-w-0">',
                    '<p class="text-sm font-semibold text-slate-900 truncate">', escapeHtml(entry.label || '-'), '</p>',
                    '<p class="text-xs text-slate-500 truncate">', escapeHtml(entry.scientificName || '-'), '</p>',
                    '</div>',
                    '<div class="text-right">',
                    '<p class="text-xs font-semibold text-slate-700">', confidence.toFixed(1), '%</p>',
                    '<p class="text-[11px] text-slate-400">', escapeHtml(formatDate(entry.createdAt)), '</p>',
                    '</div>',
                    '</div>'
                ].join('');
            }).join('');
        }

        function renderResult(data) {
            if (!data) {
                return;
            }

            var suggestions = Array.isArray(data.suggestions) ? data.suggestions : [];
            var diseases = Array.isArray(data.diseases) ? data.diseases : [];

            var scoreValue = function (item) {
                if (!item) {
                    return 0;
                }

                var raw = item.confidence || item.score || 0;
                var number = Number(raw);
                return Number.isFinite(number) ? number : 0;
            };

            suggestions = suggestions.slice().sort(function (a, b) {
                return scoreValue(b) - scoreValue(a);
            });

            diseases = diseases.slice().sort(function (a, b) {
                return scoreValue(b) - scoreValue(a);
            }).slice(0, 3);

            var best = suggestions.length > 0 ? suggestions[0] : (data.bestMatch || null);

            if (resultEmpty) {
                resultEmpty.classList.add('hidden');
            }

            if (resultContent) {
                resultContent.classList.remove('hidden');
            }

            if (best) {
                var displayName = Array.isArray(best.commonNames) && best.commonNames.length > 0
                    ? best.commonNames[0]
                    : best.scientificName;
                var scorePercent = toPercent(best.confidence || best.score || 0);

                if (topName) {
                    topName.textContent = displayName || '-';
                }

                if (topScientific) {
                    topScientific.textContent = best.scientificName || '-';
                }

                if (topMeta) {
                    topMeta.textContent = 'Famille: ' + (best.family || 'N/A') + ' - Genre: ' + (best.genus || 'N/A');
                }

                if (topScore) {
                    topScore.textContent = scorePercent.toFixed(1) + '%';
                }

                if (topScoreBar) {
                    topScoreBar.style.width = scorePercent.toFixed(1) + '%';
                }

                if (topImage) {
                    if (best.imageUrl) {
                        topImage.src = best.imageUrl;
                        topImage.classList.remove('hidden');
                    } else {
                        topImage.removeAttribute('src');
                        topImage.classList.add('hidden');
                    }
                }
            }

            if (suggestionsList) {
                var suggestionsCard = suggestionsList.closest ? suggestionsList.closest('article') : null;
                if (suggestionsCard) {
                    suggestionsCard.classList.add('hidden');
                }
                suggestionsList.innerHTML = '';
            }

            if (diseasesCard && diseasesList) {
                if (!diseases.length) {
                    var diseasesRequested = detectDiseasesCheckbox ? Boolean(detectDiseasesCheckbox.checked) : true;
                    if (!diseasesRequested) {
                        diseasesCard.classList.add('hidden');
                        diseasesList.innerHTML = '';
                    } else {
                        diseasesCard.classList.remove('hidden');
                        diseasesList.innerHTML = '<p class="text-sm text-amber-900">Aucun diagnostic maladie retourne. Verifiez que le microservice IA est demarre et accessible.</p>';
                        createToast(toastContainer, 'Diagnostic maladies indisponible (microservice IA).', 'error');
                    }
                } else {
                    diseasesCard.classList.remove('hidden');
                    diseasesList.innerHTML = diseases.map(buildDiseaseHtml).join('');
                }
            }

            if (remainingRequests) {
                if (data.remainingRequests === null || typeof data.remainingRequests === 'undefined') {
                    remainingRequests.textContent = 'N/A';
                } else {
                    remainingRequests.textContent = String(data.remainingRequests);
                }
            }
        }

        function onDragOver(event) {
            event.preventDefault();
            dropzone.classList.add('is-dragover');
        }

        function onDragLeave(event) {
            event.preventDefault();
            if (!dropzone.contains(event.relatedTarget)) {
                dropzone.classList.remove('is-dragover');
            }
        }

        dropzone.addEventListener('click', function (event) {
            // If the native file input received the click, let the browser handle it once.
            if (event.target === fileInput) {
                return;
            }

            fileInput.click();
        });

        fileInput.addEventListener('click', function (event) {
            // Prevent bubbling to dropzone click handler which can reopen the picker.
            event.stopPropagation();
        });

        dropzone.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                fileInput.click();
            }
        });

        dropzone.addEventListener('dragenter', onDragOver);
        dropzone.addEventListener('dragover', onDragOver);
        dropzone.addEventListener('dragleave', onDragLeave);

        dropzone.addEventListener('drop', function (event) {
            event.preventDefault();
            dropzone.classList.remove('is-dragover');

            var files = event.dataTransfer && event.dataTransfer.files ? event.dataTransfer.files : null;
            var file = files && files.length > 0 ? files[0] : null;
            if (!file) {
                return;
            }

            applyFile(file);
        });

        fileInput.addEventListener('change', function () {
            var file = fileInput.files && fileInput.files.length > 0 ? fileInput.files[0] : null;
            if (!file) {
                return;
            }

            applyFile(file);
        });

        clearHistoryButton && clearHistoryButton.addEventListener('click', function () {
            saveHistory([]);
            renderHistory();
            createToast(toastContainer, 'Historique supprime.', 'success');
        });

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            setAlert('', 'success');
            clearFieldError();

            var selectedFile = fileInput.files && fileInput.files.length > 0
                ? fileInput.files[0]
                : currentFile;

            var validationError = validateFile(selectedFile);
            if (validationError) {
                showFieldError(validationError);
                createToast(toastContainer, validationError, 'error');
                return;
            }

            var formData = new FormData(form);
            var formDataImage = formData.get(fileInput.name);
            var hasEmptyFilePlaceholder = typeof File !== 'undefined'
                && formDataImage instanceof File
                && formDataImage.size === 0
                && formDataImage.name === '';

            if ((!formDataImage || hasEmptyFilePlaceholder) && selectedFile) {
                formData.set(fileInput.name, selectedFile, selectedFile.name);
            }

            setLoading(true);

            try {
                var response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                var payload = await response.json().catch(function () {
                    return null;
                });

                if (!response.ok || !payload || !payload.success) {
                    throw new Error(payload && payload.error ? payload.error : 'Analyse impossible.');
                }

                renderResult(payload.data);
                pushHistory(payload.data);
                setAlert('Analyse terminee avec succes.', 'success');
                createToast(toastContainer, 'Analyse terminee.', 'success');
            } catch (error) {
                var message = error && error.message ? error.message : 'Erreur reseau pendant l analyse.';
                setAlert(message, 'error');
                createToast(toastContainer, message, 'error');
            } finally {
                setLoading(false);
            }
        });

        renderHistory();
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof window.initPlantNetModule === 'function') {
            window.initPlantNetModule(document);
        }
    });
})();
