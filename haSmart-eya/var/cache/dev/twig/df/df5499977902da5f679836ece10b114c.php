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

/* article/stats_weight.html.twig */
class __TwigTemplate_f81b60a62b0a8f357e74bb4e05a94f6c extends Template
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
            'page_title' => [$this, 'block_page_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/stats_weight.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/stats_weight.html.twig"));

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

        yield "Statistiques des poids - FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield "⚖️ Statistiques des poids";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 6
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

        // line 7
        yield "<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">⚖️ Statistiques des poids</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 15, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " kg</div>
                    <div class=\"stats-label\">Poids maximum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["min"]) || array_key_exists("min", $context) ? $context["min"] : (function () { throw new RuntimeError('Variable "min" does not exist.', 21, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " kg</div>
                    <div class=\"stats-label\">Poids minimum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avg"]) || array_key_exists("avg", $context) ? $context["avg"] : (function () { throw new RuntimeError('Variable "avg" does not exist.', 27, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " kg</div>
                    <div class=\"stats-label\">Poids moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 33, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " kg</div>
                    <div class=\"stats-label\">Poids total</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Répartition par tranche de poids</h3>
        <div class=\"mt-3\">
            <div class=\"row\">
                ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["ranges"]) || array_key_exists("ranges", $context) ? $context["ranges"] : (function () { throw new RuntimeError('Variable "ranges" does not exist.', 42, $this->source); })()));
        foreach ($context['_seq'] as $context["range"] => $context["count"]) {
            // line 43
            yield "                <div class=\"col-md-3 mb-2\">
                    <strong>";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["range"], "html", null, true);
            yield "</strong> : ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
            yield " article(s)
                    <div class=\"progress mt-1\" style=\"height: 20px;\">
                        <div class=\"progress-bar\" style=\"width: ";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 46, $this->source); })()))) * 100)), "html", null, true);
            yield "%\"></div>
                    </div>
                    <small>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 48, $this->source); })()))) * 100), 1), "html", null, true);
            yield "%</small>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['range'], $context['count'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        yield "            </div>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\" class=\"btn btn-secondary\">Retour</a>
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
        return "article/stats_weight.html.twig";
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
        return array (  207 => 55,  201 => 51,  192 => 48,  187 => 46,  180 => 44,  177 => 43,  173 => 42,  161 => 33,  152 => 27,  143 => 21,  134 => 15,  124 => 7,  111 => 6,  88 => 4,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Statistiques des poids - FlahaSmart{% endblock %}
{% block page_title %}⚖️ Statistiques des poids{% endblock %}

{% block body %}
<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">⚖️ Statistiques des poids</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ max|number_format(2, ',', ' ') }} kg</div>
                    <div class=\"stats-label\">Poids maximum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ min|number_format(2, ',', ' ') }} kg</div>
                    <div class=\"stats-label\">Poids minimum</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ avg|number_format(2, ',', ' ') }} kg</div>
                    <div class=\"stats-label\">Poids moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ total|number_format(2, ',', ' ') }} kg</div>
                    <div class=\"stats-label\">Poids total</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Répartition par tranche de poids</h3>
        <div class=\"mt-3\">
            <div class=\"row\">
                {% for range, count in ranges %}
                <div class=\"col-md-3 mb-2\">
                    <strong>{{ range }}</strong> : {{ count }} article(s)
                    <div class=\"progress mt-1\" style=\"height: 20px;\">
                        <div class=\"progress-bar\" style=\"width: {{ (count / articles|length * 100)|round }}%\"></div>
                    </div>
                    <small>{{ (count / articles|length * 100)|round(1) }}%</small>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"{{ path('app_article_index') }}\" class=\"btn btn-secondary\">Retour</a>
    </div>
</div>
{% endblock %}", "article/stats_weight.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\article\\stats_weight.html.twig");
    }
}
