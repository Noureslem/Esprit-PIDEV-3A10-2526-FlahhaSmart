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

/* order/stats_amount.html.twig */
class __TwigTemplate_131819942a3910db48fb21abacb8a35a extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "order/stats_amount.html.twig"));

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

        yield "Statistiques des montants";
        
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
        <h1 class=\"h3 mb-0\">💰 Statistiques des montants</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["max"]) || array_key_exists("max", $context) ? $context["max"] : (function () { throw new RuntimeError('Variable "max" does not exist.', 14, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Montant max</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["min"]) || array_key_exists("min", $context) ? $context["min"] : (function () { throw new RuntimeError('Variable "min" does not exist.', 20, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Montant min</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avg"]) || array_key_exists("avg", $context) ? $context["avg"] : (function () { throw new RuntimeError('Variable "avg" does not exist.', 26, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Montant moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 32, $this->source); })()), 2, ",", " "), "html", null, true);
        yield " €</div>
                    <div class=\"stats-label\">Total</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Répartition par tranche de montant</h3>
        <div class=\"mt-3\">
            <div class=\"row\">
                ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["ranges"]) || array_key_exists("ranges", $context) ? $context["ranges"] : (function () { throw new RuntimeError('Variable "ranges" does not exist.', 41, $this->source); })()));
        foreach ($context['_seq'] as $context["range"] => $context["count"]) {
            // line 42
            yield "                <div class=\"col-md-3 mb-2\">
                    <strong>";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["range"], "html", null, true);
            yield "</strong> : ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
            yield " commande(s)
                    <div class=\"progress mt-1\" style=\"height: 20px;\">
                        <div class=\"progress-bar\" style=\"width: ";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 45, $this->source); })()))) * 100)), "html", null, true);
            yield "%\"></div>
                    </div>
                    <small>";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((($context["count"] / Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 47, $this->source); })()))) * 100), 1), "html", null, true);
            yield "%</small>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['range'], $context['count'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        yield "            </div>
        </div>

        <h3 class=\"h5 mt-4\">Top 10 commandes par montant</h3>
        <div class=\"mt-2\">
            <ul class=\"list-group\">
                ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["top"]) || array_key_exists("top", $context) ? $context["top"] : (function () { throw new RuntimeError('Variable "top" does not exist.', 56, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 57
            yield "                <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                    ";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "reference", [], "any", false, false, false, 58), "html", null, true);
            yield "
                    <span class=\"badge bg-success rounded-pill\">";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "montantTotal", [], "any", false, false, false, 59), 2, ",", " "), "html", null, true);
            yield " €</span>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        yield "            </ul>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"";
        // line 66
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_index");
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
        return "order/stats_amount.html.twig";
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
        return array (  196 => 66,  190 => 62,  181 => 59,  177 => 58,  174 => 57,  170 => 56,  162 => 50,  153 => 47,  148 => 45,  141 => 43,  138 => 42,  134 => 41,  122 => 32,  113 => 26,  104 => 20,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Statistiques des montants{% endblock %}

{% block body %}
<div class=\"card\">
    <div class=\"card-header bg-white\">
        <h1 class=\"h3 mb-0\">💰 Statistiques des montants</h1>
    </div>
    <div class=\"card-body\">
        <div class=\"row mb-4\">
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ max|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Montant max</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ min|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Montant min</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ avg|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Montant moyen</div>
                </div>
            </div>
            <div class=\"col-md-3\">
                <div class=\"stats-card\">
                    <div class=\"stats-value\">{{ total|number_format(2, ',', ' ') }} €</div>
                    <div class=\"stats-label\">Total</div>
                </div>
            </div>
        </div>

        <h3 class=\"h5\">Répartition par tranche de montant</h3>
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

        <h3 class=\"h5 mt-4\">Top 10 commandes par montant</h3>
        <div class=\"mt-2\">
            <ul class=\"list-group\">
                {% for order in top %}
                <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                    {{ order.reference }}
                    <span class=\"badge bg-success rounded-pill\">{{ order.montantTotal|number_format(2, ',', ' ') }} €</span>
                </li>
                {% endfor %}
            </ul>
        </div>
    </div>
    <div class=\"card-footer\">
        <a href=\"{{ path('app_order_index') }}\" class=\"btn btn-secondary\">Retour</a>
    </div>
</div>
{% endblock %}", "order/stats_amount.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\order\\stats_amount.html.twig");
    }
}
