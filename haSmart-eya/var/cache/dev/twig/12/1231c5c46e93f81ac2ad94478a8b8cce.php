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

/* consultant/index.html.twig */
class __TwigTemplate_939e81b8d6f7b4b962d421c642a8d4b2 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "consultant/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "consultant/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Consultant IA - FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"row justify-content-center\">
    <div class=\"col-md-8\">
        <div class=\"card shadow-sm\">
            <div class=\"card-header bg-white text-center border-0\">
                <h1 class=\"h3 mb-0\">🤖 Consultation IA</h1>
                <p class=\"text-muted small mb-0\">deepseek-r1:1.5b</p>
            </div>
            <div class=\"card-body\">
                <form method=\"post\">
                    <div class=\"mb-3\">
                        <label for=\"question\" class=\"form-label fw-bold\">Votre question :</label>
                        <textarea name=\"question\" id=\"question\" class=\"form-control\" rows=\"4\" required>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["question"]) || array_key_exists("question", $context) ? $context["question"] : (function () { throw new RuntimeError('Variable "question" does not exist.', 17, $this->source); })()), "html", null, true);
        yield "</textarea>
                    </div>
                    <button type=\"submit\" class=\"btn btn-primary w-100\">Consulter</button>
                </form>

                ";
        // line 22
        if ((($tmp =  !(null === (isset($context["answer"]) || array_key_exists("answer", $context) ? $context["answer"] : (function () { throw new RuntimeError('Variable "answer" does not exist.', 22, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 23
            yield "                <hr>
                <div class=\"mt-4\">
                    <h5 class=\"fw-bold\">Réponse :</h5>
                    <div class=\"alert alert-light border rounded-3 p-3\" style=\"background-color: #f8f9fa;\">
                        ";
            // line 27
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["answer"]) || array_key_exists("answer", $context) ? $context["answer"] : (function () { throw new RuntimeError('Variable "answer" does not exist.', 27, $this->source); })()), "html", null, true));
            yield "
                    </div>
                </div>
                ";
        } elseif ((($tmp =  !(null ===         // line 30
(isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 30, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 31
            yield "                <div class=\"alert alert-danger mt-4\">
                    ";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 32, $this->source); })()), "html", null, true);
            yield "
                </div>
                ";
        }
        // line 35
        yield "            </div>
        </div>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "consultant/index.html.twig";
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
        return array (  146 => 35,  140 => 32,  137 => 31,  135 => 30,  129 => 27,  123 => 23,  121 => 22,  113 => 17,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Consultant IA - FlahaSmart{% endblock %}

{% block body %}
<div class=\"row justify-content-center\">
    <div class=\"col-md-8\">
        <div class=\"card shadow-sm\">
            <div class=\"card-header bg-white text-center border-0\">
                <h1 class=\"h3 mb-0\">🤖 Consultation IA</h1>
                <p class=\"text-muted small mb-0\">deepseek-r1:1.5b</p>
            </div>
            <div class=\"card-body\">
                <form method=\"post\">
                    <div class=\"mb-3\">
                        <label for=\"question\" class=\"form-label fw-bold\">Votre question :</label>
                        <textarea name=\"question\" id=\"question\" class=\"form-control\" rows=\"4\" required>{{ question }}</textarea>
                    </div>
                    <button type=\"submit\" class=\"btn btn-primary w-100\">Consulter</button>
                </form>

                {% if answer is not null %}
                <hr>
                <div class=\"mt-4\">
                    <h5 class=\"fw-bold\">Réponse :</h5>
                    <div class=\"alert alert-light border rounded-3 p-3\" style=\"background-color: #f8f9fa;\">
                        {{ answer|nl2br }}
                    </div>
                </div>
                {% elseif error is not null %}
                <div class=\"alert alert-danger mt-4\">
                    {{ error }}
                </div>
                {% endif %}
            </div>
        </div>
    </div>
</div>
{% endblock %}", "consultant/index.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\consultant\\index.html.twig");
    }
}
