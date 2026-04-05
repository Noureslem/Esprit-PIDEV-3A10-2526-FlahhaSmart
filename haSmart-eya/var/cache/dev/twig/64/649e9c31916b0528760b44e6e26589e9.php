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

/* dashboard/client.html.twig */
class __TwigTemplate_212968887c3047eaa82e928f5579fd01 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/client.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Dashboard Client — FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield "Mon espace client";
        
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
        yield "
<div class=\"mb-4\">
    <h4>Bonjour, ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 8, $this->source); })()), "fullName", [], "any", false, false, false, 8), "html", null, true);
        yield " 👋</h4>
    <p class=\"text-muted\">";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 9, $this->source); })()), "email", [], "any", false, false, false, 9), "html", null, true);
        yield "</p>
</div>

<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Mes commandes</h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>Référence</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["commandes"]) || array_key_exists("commandes", $context) ? $context["commandes"] : (function () { throw new RuntimeError('Variable "commandes" does not exist.', 29, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 30
            yield "                    <tr>
                        <td><strong>";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "reference", [], "any", false, false, false, 31), "html", null, true);
            yield "</strong></td>
                        <td class=\"text-muted small\">";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "date_commande", [], "any", false, false, false, 32), "d/m/Y"), "html", null, true);
            yield "</td>
                        <td>
                            <span class=\"badge ";
            // line 34
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["c"], "statut", [], "any", false, false, false, 34) == "Delivré")) {
                yield "bg-success
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 35
$context["c"], "statut", [], "any", false, false, false, 35) == "En Cours")) {
                yield "bg-warning text-dark
                                ";
            } else {
                // line 36
                yield "bg-secondary";
            }
            yield "\">
                                ";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "statut", [], "any", false, false, false, 37), "html", null, true);
            yield "
                            </span>
                        </td>
                        <td>";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "mode_paiement", [], "any", false, false, false, 40), "html", null, true);
            yield "</td>
                        <td><strong>";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "montant_total", [], "any", false, false, false, 41), "html", null, true);
            yield " DT</strong></td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 43
        if (!$context['_iterated']) {
            // line 44
            yield "                    <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucune commande</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['c'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "                </tbody>
            </table>
        </div>
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
        return "dashboard/client.html.twig";
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
        return array (  191 => 46,  184 => 44,  182 => 43,  175 => 41,  171 => 40,  165 => 37,  160 => 36,  155 => 35,  151 => 34,  146 => 32,  142 => 31,  139 => 30,  134 => 29,  111 => 9,  107 => 8,  103 => 6,  93 => 5,  76 => 3,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Dashboard Client — FlahaSmart{% endblock %}
{% block page_title %}Mon espace client{% endblock %}

{% block body %}

<div class=\"mb-4\">
    <h4>Bonjour, {{ user.fullName }} 👋</h4>
    <p class=\"text-muted\">{{ user.email }}</p>
</div>

<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Mes commandes</h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>Référence</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                {% for c in commandes %}
                    <tr>
                        <td><strong>{{ c.reference }}</strong></td>
                        <td class=\"text-muted small\">{{ c.date_commande|date('d/m/Y') }}</td>
                        <td>
                            <span class=\"badge {% if c.statut == 'Delivré' %}bg-success
                                {% elseif c.statut == 'En Cours' %}bg-warning text-dark
                                {% else %}bg-secondary{% endif %}\">
                                {{ c.statut }}
                            </span>
                        </td>
                        <td>{{ c.mode_paiement }}</td>
                        <td><strong>{{ c.montant_total }} DT</strong></td>
                    </tr>
                {% else %}
                    <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucune commande</td></tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

{% endblock %}
", "dashboard/client.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\dashboard\\client.html.twig");
    }
}
