<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* price_estimator/index.html.twig */
class __TwigTemplate_1a7c8a88dedca800e9493a3405e340bf extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "price_estimator/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Estimation de prix - FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"row justify-content-center\">
    <div class=\"col-lg-7\">
        <div class=\"card shadow-lg border-0 overflow-hidden\">
            <div class=\"card-header bg-gradient text-white p-4\" style=\"background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);\">
                <h1 class=\"h3 mb-0 text-center\">
                    💰 Estimation de prix par IA
                </h1>
                <p class=\"text-center mb-0 opacity-75 small mt-2\">
                    Prenez une photo du produit, notre IA estime son prix en dinars tunisiens
                </p>
            </div>
            <div class=\"card-body p-4\">
                ";
        // line 19
        yield "                ";
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 19, $this->source); })()), 'form_start', ["attr" => ["id" => "upload-form"]]);
        yield "
                
                <div class=\"upload-area border-2 border-dashed rounded-4 p-5 text-center bg-light\" id=\"drop-zone\">
                    ";
        // line 23
        yield "                    <input type=\"file\" 
                           id=\"price_estimator_image\" 
                           name=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\FormExtension']->getFieldName(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "image", [], "any", false, false, false, 25)), "html", null, true);
        yield "\" 
                           accept=\"image/jpeg,image/png,image/jpg,image/webp\"
                           style=\"display: none;\" />
                    
                    <div id=\"upload-prompt\">
                        <div class=\"display-1 text-muted mb-3\">📸</div>
                        <h5 class=\"fw-bold\">Glissez-déposez votre image ici</h5>
                        <p class=\"text-muted mb-3\">ou</p>
                        <button type=\"button\" class=\"btn btn-outline-success btn-lg px-4\" id=\"browse-btn\">
                            Parcourir
                        </button>
                        <p class=\"small text-muted mt-3\">JPEG, PNG, WEBP - Max 5 Mo</p>
                    </div>
                    
                    <div id=\"preview-container\" style=\"display: none;\">
                        <img id=\"image-preview\" src=\"#\" alt=\"Aperçu\" class=\"img-fluid rounded-3 mb-3\" style=\"max-height: 250px;\">
                        <div>
                            <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"change-btn\">
                                Changer d'image
                            </button>
                        </div>
                    </div>
                </div>
                
                ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), "image", [], "any", false, false, false, 49), 'errors');
        yield "
                
                <div class=\"d-grid mt-4\">
                    <button type=\"submit\" class=\"btn btn-success btn-lg\" id=\"submit-btn\" disabled>
                        <span class=\"spinner-border spinner-border-sm d-none me-2\" role=\"status\" id=\"loading-spinner\"></span>
                        Estimer le prix
                    </button>
                </div>
                
                ";
        // line 58
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), 'form_end');
        yield "

                ";
        // line 60
        if ((($tmp =  !(null === (isset($context["estimatedPrice"]) || array_key_exists("estimatedPrice", $context) ? $context["estimatedPrice"] : (function () { throw new RuntimeError('Variable "estimatedPrice" does not exist.', 60, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 61
            yield "                <div class=\"mt-5\">
                    <div class=\"alert alert-success border-0 rounded-4 p-4 shadow-sm\" style=\"background: linear-gradient(145deg, #e8f5e9, #c8e6c9);\">
                        <div class=\"row align-items-center\">
                            <div class=\"col-3 text-center\">
                                <span class=\"display-1\">💰</span>
                            </div>
                            <div class=\"col-9\">
                                <p class=\"text-muted mb-1\">Prix estimé</p>
                                <h2 class=\"display-5 fw-bold text-success mb-0\">";
            // line 69
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((isset($context["estimatedPrice"]) || array_key_exists("estimatedPrice", $context) ? $context["estimatedPrice"] : (function () { throw new RuntimeError('Variable "estimatedPrice" does not exist.', 69, $this->source); })())), "html", null, true);
            yield "</h2>
                                <small class=\"text-secondary\">en dinars tunisiens (TND)</small>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        // line 76
        yield "
                ";
        // line 77
        if ((($tmp =  !(null === (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 77, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 78
            yield "                <div class=\"alert alert-danger mt-4 rounded-4\">
                    <i class=\"bi bi-exclamation-triangle-fill me-2\"></i> ";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 79, $this->source); })()), "html", null, true);
            yield "
                </div>
                ";
        }
        // line 82
        yield "            </div>
        </div>
    </div>
</div>

<style>
.upload-area {
    border-color: #dee2e6 !important;
    transition: all 0.2s;
    cursor: pointer;
}
.upload-area:hover, .upload-area.dragover {
    border-color: #2e7d32 !important;
    background-color: #f1f8e9;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('price_estimator_image');
    const dropZone = document.getElementById('drop-zone');
    const uploadPrompt = document.getElementById('upload-prompt');
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('image-preview');
    const submitBtn = document.getElementById('submit-btn');
    const browseBtn = document.getElementById('browse-btn');
    const changeBtn = document.getElementById('change-btn');
    const spinner = document.getElementById('loading-spinner');
    const form = document.getElementById('upload-form');

    // Browse button triggers file dialog
    browseBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Handle file selection
    function handleFile(file) {
        if (!file) return;
        
        // Validate type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Type de fichier non supporté. Utilisez JPEG, PNG ou WEBP.');
            return;
        }
        
        // Validate size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Fichier trop volumineux. Maximum 5 Mo.');
            return;
        }

        previewImg.src = URL.createObjectURL(file);
        uploadPrompt.style.display = 'none';
        previewContainer.style.display = 'block';
        submitBtn.disabled = false;
    }

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            handleFile(fileInput.files[0]);
        }
    });

    // Change image button resets
    changeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadPrompt.style.display = 'block';
        previewContainer.style.display = 'none';
        previewImg.src = '#';
        submitBtn.disabled = true;
    });

    // Drag & drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    dropZone.addEventListener('dragover', () => dropZone.classList.add('dragover'));
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    
    dropZone.addEventListener('drop', function(e) {
        dropZone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            // Assign dropped file to the hidden input
            fileInput.files = files;
            // Manually trigger change event
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    });

    // Click on drop zone (not on buttons) triggers browse
    dropZone.addEventListener('click', function(e) {
        if (!e.target.closest('button')) {
            fileInput.click();
        }
    });

    // Show loading spinner on submit
    form.addEventListener('submit', function() {
        if (!submitBtn.disabled) {
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
        }
    });
});
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "price_estimator/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  190 => 82,  184 => 79,  181 => 78,  179 => 77,  176 => 76,  166 => 69,  156 => 61,  154 => 60,  149 => 58,  137 => 49,  110 => 25,  106 => 23,  99 => 19,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Estimation de prix - FlahaSmart{% endblock %}

{% block body %}
<div class=\"row justify-content-center\">
    <div class=\"col-lg-7\">
        <div class=\"card shadow-lg border-0 overflow-hidden\">
            <div class=\"card-header bg-gradient text-white p-4\" style=\"background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);\">
                <h1 class=\"h3 mb-0 text-center\">
                    💰 Estimation de prix par IA
                </h1>
                <p class=\"text-center mb-0 opacity-75 small mt-2\">
                    Prenez une photo du produit, notre IA estime son prix en dinars tunisiens
                </p>
            </div>
            <div class=\"card-body p-4\">
                {# We use form_start to include CSRF token, but manually render the file field #}
                {{ form_start(form, {'attr': {'id': 'upload-form'}}) }}
                
                <div class=\"upload-area border-2 border-dashed rounded-4 p-5 text-center bg-light\" id=\"drop-zone\">
                    {# Hidden file input #}
                    <input type=\"file\" 
                           id=\"price_estimator_image\" 
                           name=\"{{ field_name(form.image) }}\" 
                           accept=\"image/jpeg,image/png,image/jpg,image/webp\"
                           style=\"display: none;\" />
                    
                    <div id=\"upload-prompt\">
                        <div class=\"display-1 text-muted mb-3\">📸</div>
                        <h5 class=\"fw-bold\">Glissez-déposez votre image ici</h5>
                        <p class=\"text-muted mb-3\">ou</p>
                        <button type=\"button\" class=\"btn btn-outline-success btn-lg px-4\" id=\"browse-btn\">
                            Parcourir
                        </button>
                        <p class=\"small text-muted mt-3\">JPEG, PNG, WEBP - Max 5 Mo</p>
                    </div>
                    
                    <div id=\"preview-container\" style=\"display: none;\">
                        <img id=\"image-preview\" src=\"#\" alt=\"Aperçu\" class=\"img-fluid rounded-3 mb-3\" style=\"max-height: 250px;\">
                        <div>
                            <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"change-btn\">
                                Changer d'image
                            </button>
                        </div>
                    </div>
                </div>
                
                {{ form_errors(form.image) }}
                
                <div class=\"d-grid mt-4\">
                    <button type=\"submit\" class=\"btn btn-success btn-lg\" id=\"submit-btn\" disabled>
                        <span class=\"spinner-border spinner-border-sm d-none me-2\" role=\"status\" id=\"loading-spinner\"></span>
                        Estimer le prix
                    </button>
                </div>
                
                {{ form_end(form) }}

                {% if estimatedPrice is not null %}
                <div class=\"mt-5\">
                    <div class=\"alert alert-success border-0 rounded-4 p-4 shadow-sm\" style=\"background: linear-gradient(145deg, #e8f5e9, #c8e6c9);\">
                        <div class=\"row align-items-center\">
                            <div class=\"col-3 text-center\">
                                <span class=\"display-1\">💰</span>
                            </div>
                            <div class=\"col-9\">
                                <p class=\"text-muted mb-1\">Prix estimé</p>
                                <h2 class=\"display-5 fw-bold text-success mb-0\">{{ estimatedPrice|trim }}</h2>
                                <small class=\"text-secondary\">en dinars tunisiens (TND)</small>
                            </div>
                        </div>
                    </div>
                </div>
                {% endif %}

                {% if error is not null %}
                <div class=\"alert alert-danger mt-4 rounded-4\">
                    <i class=\"bi bi-exclamation-triangle-fill me-2\"></i> {{ error }}
                </div>
                {% endif %}
            </div>
        </div>
    </div>
</div>

<style>
.upload-area {
    border-color: #dee2e6 !important;
    transition: all 0.2s;
    cursor: pointer;
}
.upload-area:hover, .upload-area.dragover {
    border-color: #2e7d32 !important;
    background-color: #f1f8e9;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('price_estimator_image');
    const dropZone = document.getElementById('drop-zone');
    const uploadPrompt = document.getElementById('upload-prompt');
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('image-preview');
    const submitBtn = document.getElementById('submit-btn');
    const browseBtn = document.getElementById('browse-btn');
    const changeBtn = document.getElementById('change-btn');
    const spinner = document.getElementById('loading-spinner');
    const form = document.getElementById('upload-form');

    // Browse button triggers file dialog
    browseBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Handle file selection
    function handleFile(file) {
        if (!file) return;
        
        // Validate type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Type de fichier non supporté. Utilisez JPEG, PNG ou WEBP.');
            return;
        }
        
        // Validate size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Fichier trop volumineux. Maximum 5 Mo.');
            return;
        }

        previewImg.src = URL.createObjectURL(file);
        uploadPrompt.style.display = 'none';
        previewContainer.style.display = 'block';
        submitBtn.disabled = false;
    }

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            handleFile(fileInput.files[0]);
        }
    });

    // Change image button resets
    changeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadPrompt.style.display = 'block';
        previewContainer.style.display = 'none';
        previewImg.src = '#';
        submitBtn.disabled = true;
    });

    // Drag & drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    dropZone.addEventListener('dragover', () => dropZone.classList.add('dragover'));
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    
    dropZone.addEventListener('drop', function(e) {
        dropZone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            // Assign dropped file to the hidden input
            fileInput.files = files;
            // Manually trigger change event
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    });

    // Click on drop zone (not on buttons) triggers browse
    dropZone.addEventListener('click', function(e) {
        if (!e.target.closest('button')) {
            fileInput.click();
        }
    });

    // Show loading spinner on submit
    form.addEventListener('submit', function() {
        if (!submitBtn.disabled) {
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
        }
    });
});
</script>
{% endblock %}", "price_estimator/index.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\price_estimator\\index.html.twig");
    }
}
