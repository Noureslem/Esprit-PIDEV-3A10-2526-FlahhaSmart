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

/* article/stats_price.html.twig */
class __TwigTemplate_0eda7b8939f2ad9d74b47b3ec6c7a520 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/stats_price.html.twig"));

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

        yield "Statistiques des prix";
        
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
        yield "<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">📊 Statistiques des prix</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 14, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Prix maximum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["min"]) || array_key_exists("min", $context) ? $context["min"] : (function () { throw new RuntimeError('Variable "min" does not exist.', 20, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Prix minimum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avg"]) || array_key_exists("avg", $context) ? $context["avg"] : (function () { throw new RuntimeError('Variable "avg" does not exist.', 26, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Prix moyen</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Prix des articles (du plus bas au plus haut)</h3>
        <div class=\"mt-3\">
            ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 34, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 35
            yield "            <div class=\"mb-2\">
                <strong>";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "nom", [], "any", false, false, false, 36), "html", null, true);
            yield "</strong> - ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "prix", [], "any", false, false, false, 36), 2, ",", " "), "html", null, true);
            yield " €
                <div class=\"progress mt-1\" style=\"height: 20px;\">
                    <div class=\"progress-bar\" style=\"width: ";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "prix", [], "any", false, false, false, 38) / (isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 38, $this->source); })())) * 100)), "html", null, true);
            yield "%\">
                        ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "prix", [], "any", false, false, false, 39) / (isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 39, $this->source); })())) * 100)), "html", null, true);
            yield "%
                    </div>
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\" class=\"btn btn-secondary\">Retour</a>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/stats_price.html.twig";
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
        return array (  158 => 47,  153 => 44,  142 => 39,  138 => 38,  131 => 36,  128 => 35,  124 => 34,  113 => 26,  104 => 20,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Statistiques des prix{% endblock %}

{% block body %}
<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">📊 Statistiques des prix</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ max|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Prix maximum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ min|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Prix minimum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ avg|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Prix moyen</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Prix des articles (du plus bas au plus haut)</h3>
        <div class=\"mt-3\">
            {% for article in articles %}
            <div class=\"mb-2\">
                <strong>{{ article.nom }}</strong> - {{ article.prix|number_format(2, ',', ' ') }} €
                <div class=\"progress mt-1\" style=\"height: 20px;\">
                    <div class=\"progress-bar\" style=\"width: {{ (article.prix / max * 100)|round }}%\">
                        {{ (article.prix / max * 100)|round }}%
                    </div>
                </div>
            </div>
            {% endfor %}
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"{{ path('app_article_index') }}\" class=\"btn btn-secondary\">Retour</a>
    </div>
</div>
{% endblock %}", "article/stats_price.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\article\\stats_price.html.twig");
    }
}
