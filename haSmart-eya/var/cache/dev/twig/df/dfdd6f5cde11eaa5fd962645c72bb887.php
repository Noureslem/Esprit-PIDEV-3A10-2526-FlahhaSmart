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

/* order/stats_fees.html.twig */
class __TwigTemplate_a6cf3f3dbbf5b4bfd3d2bb994fb156d9 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "order/stats_fees.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "order/stats_fees.html.twig"));

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

        yield "Statistiques des frais";
        
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
        yield "<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">🚚 Statistiques des frais de livraison</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 14, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Frais max</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["min"]) || array_key_exists("min", $context) ? $context["min"] : (function () { throw new RuntimeError('Variable "min" does not exist.', 20, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Frais min</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avg"]) || array_key_exists("avg", $context) ? $context["avg"] : (function () { throw new RuntimeError('Variable "avg" does not exist.', 26, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Frais moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 32, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Total frais</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Quartiles</h3>
        <div class=\"mt-2\">
            <ul class=\"list-group mb-4\">
                <li class=\"list-group-item\">Q1 (25%) : ";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["q1"]) || array_key_exists("q1", $context) ? $context["q1"] : (function () { throw new RuntimeError('Variable "q1" does not exist.', 41, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</li>
                <li class=\"list-group-item\">Médiane (50%) : ";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["median"]) || array_key_exists("median", $context) ? $context["median"] : (function () { throw new RuntimeError('Variable "median" does not exist.', 42, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</li>
                <li class=\"list-group-item\">Q3 (75%) : ";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["q3"]) || array_key_exists("q3", $context) ? $context["q3"] : (function () { throw new RuntimeError('Variable "q3" does not exist.', 43, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</li>
            </ul>
        </div>

        <h3 class=\"h5\">Répartition par tranche de frais</h3>
        <div class=\"mt-3\">
            <div class=\"row\">
                ";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["ranges"]) || array_key_exists("ranges", $context) ? $context["ranges"] : (function () { throw new RuntimeError('Variable "ranges" does not exist.', 50, $this->source); })()));
        foreach ($context['_seq'] as $context["range"] => $context["count"]) {
            // line 51
            yield "                <div class=\"col-md-3 mb-2\">
                    <strong>";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["range"], "html", null, true);
            yield "</strong> : ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
            yield " commande(s)
                    <div class=\"progress mt-1\" style=\"height: 20px;\">
                        <div class=\"progress-bar\" style=\"width: ";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 54, $this->source); })()))) * 100)), "html", null, true);
            yield "%\"></div>
                    </div>
                    <small>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 56, $this->source); })()))) * 100), 1), "html", null, true);
            yield "%</small>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['range'], $context['count'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        yield "            </div>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"";
        // line 63
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_index");
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
        return "order/stats_fees.html.twig";
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
        return array (  201 => 63,  195 => 59,  186 => 56,  181 => 54,  174 => 52,  171 => 51,  167 => 50,  157 => 43,  153 => 42,  149 => 41,  137 => 32,  128 => 26,  119 => 20,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Statistiques des frais{% endblock %}

{% block body %}
<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">🚚 Statistiques des frais de livraison</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ max|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Frais max</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ min|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Frais min</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ avg|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Frais moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ total|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Total frais</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Quartiles</h3>
        <div class=\"mt-2\">
            <ul class=\"list-group mb-4\">
                <li class=\"list-group-item\">Q1 (25%) : {{ q1|number_format(2, ',', ' ') }} €</li>
                <li class=\"list-group-item\">Médiane (50%) : {{ median|number_format(2, ',', ' ') }} €</li>
                <li class=\"list-group-item\">Q3 (75%) : {{ q3|number_format(2, ',', ' ') }} €</li>
            </ul>
        </div>

        <h3 class=\"h5\">Répartition par tranche de frais</h3>
        <div class=\"mt-3\">
            <div class=\"row\">
                {% for range, count in ranges %}
                <div class=\"col-md-3 mb-2\">
                    <strong>{{ range }}</strong> : {{ count }} commande(s)
                    <div class=\"progress mt-1\" style=\"height: 20px;\">
                        <div class=\"progress-bar\" style=\"width: {{ (count / orders|length * 100)|round }}%\"></div>
                    </div>
                    <small>{{ (count / orders|length * 100)|round(1) }}%</small>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"{{ path('app_order_index') }}\" class=\"btn btn-secondary\">Retour</a>
    </div>
</div>
{% endblock %}", "order/stats_fees.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\order\\stats_fees.html.twig");
    }
}
