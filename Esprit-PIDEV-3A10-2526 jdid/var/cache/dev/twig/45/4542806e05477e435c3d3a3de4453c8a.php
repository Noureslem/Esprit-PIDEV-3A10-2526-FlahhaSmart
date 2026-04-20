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
class __TwigTemplate_c22ad6960536da1f26bbaf8983aa2e50 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/client.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/client.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
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

        yield "Dashboard Client — FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 3
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

        yield "Mon espace client";
        
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

";
        // line 13
        yield "<ul class=\"nav nav-tabs mb-4\" id=\"clientTab\" role=\"tablist\">
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link active\" id=\"orders-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#orders\" type=\"button\" role=\"tab\">
            🛍️ Mes commandes
        </button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"shop-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#shop\" type=\"button\" role=\"tab\">
            🛒 Boutique
        </button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"cart-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#cart\" type=\"button\" role=\"tab\">
            🛍️ Mon panier 
            <span class=\"badge bg-success cart-count\">";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 27, $this->source); })()), "session", [], "any", false, false, false, 27), "get", ["cart"], "method", false, false, false, 27)), "html", null, true);
        yield "</span>
        </button>
    </li>
</ul>

<div class=\"tab-content\" id=\"clientTabContent\">
    ";
        // line 34
        yield "    <div class=\"tab-pane fade show active\" id=\"orders\" role=\"tabpanel\">
        <div class=\"card\">
            <div class=\"card-header bg-white border-0 pt-3 pb-0\">
                <h5 class=\"mb-0\">Historique de mes commandes</h5>
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
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["commandes"]) || array_key_exists("commandes", $context) ? $context["commandes"] : (function () { throw new RuntimeError('Variable "commandes" does not exist.', 52, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 53
            yield "                            <tr>
                                <td><strong>";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "reference", [], "any", false, false, false, 54), "html", null, true);
            yield "</strong></td>
                                <td class=\"text-muted small\">";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "date_commande", [], "any", false, false, false, 55), "d/m/Y"), "html", null, true);
            yield "</td>
                                <td>
                                    <span class=\"badge ";
            // line 57
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["c"], "statut", [], "any", false, false, false, 57) == "Delivré")) {
                yield "bg-success
                                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 58
$context["c"], "statut", [], "any", false, false, false, 58) == "En Cours")) {
                yield "bg-warning text-dark
                                        ";
            } else {
                // line 59
                yield "bg-secondary";
            }
            yield "\">
                                        ";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "statut", [], "any", false, false, false, 60), "html", null, true);
            yield "
                                    </span>
                                </td>
                                <td>";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "mode_paiement", [], "any", false, false, false, 63), "html", null, true);
            yield "</td>
                                <td><strong>";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "montant_total", [], "any", false, false, false, 64), "html", null, true);
            yield " DT</strong></td>
                            </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 66
        if (!$context['_iterated']) {
            // line 67
            yield "                            <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucune commande</td></tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['c'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 77
        yield "    <div class=\"tab-pane fade\" id=\"shop\" role=\"tabpanel\">
        ";
        // line 78
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\ShopController::index", ["request" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 78, $this->source); })()), "request", [], "any", false, false, false, 78)]));
        yield "
    </div>

    ";
        // line 82
        yield "    <div class=\"tab-pane fade\" id=\"cart\" role=\"tabpanel\">
        ";
        // line 83
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\CartController::index"));
        yield "
    </div>
</div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 89
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 90
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
    // Optionnel : mise à jour dynamique du badge panier (à adapter si besoin)
    document.addEventListener('DOMContentLoaded', function() {
        // Exemple : si vous faites des actions AJAX dans le panier,
        // vous pourriez rafraîchir le badge ici.
    });
</script>
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
        return array (  291 => 90,  278 => 89,  262 => 83,  259 => 82,  253 => 78,  250 => 77,  241 => 69,  234 => 67,  232 => 66,  225 => 64,  221 => 63,  215 => 60,  210 => 59,  205 => 58,  201 => 57,  196 => 55,  192 => 54,  189 => 53,  184 => 52,  164 => 34,  155 => 27,  139 => 13,  133 => 9,  129 => 8,  125 => 6,  112 => 5,  89 => 3,  66 => 2,  43 => 1,);
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

{# Onglets pour naviguer entre commandes, boutique et panier #}
<ul class=\"nav nav-tabs mb-4\" id=\"clientTab\" role=\"tablist\">
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link active\" id=\"orders-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#orders\" type=\"button\" role=\"tab\">
            🛍️ Mes commandes
        </button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"shop-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#shop\" type=\"button\" role=\"tab\">
            🛒 Boutique
        </button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"cart-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#cart\" type=\"button\" role=\"tab\">
            🛍️ Mon panier 
            <span class=\"badge bg-success cart-count\">{{ app.session.get('cart')|length }}</span>
        </button>
    </li>
</ul>

<div class=\"tab-content\" id=\"clientTabContent\">
    {# Onglet Commandes #}
    <div class=\"tab-pane fade show active\" id=\"orders\" role=\"tabpanel\">
        <div class=\"card\">
            <div class=\"card-header bg-white border-0 pt-3 pb-0\">
                <h5 class=\"mb-0\">Historique de mes commandes</h5>
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
    </div>

    {# Onglet Boutique #}
    <div class=\"tab-pane fade\" id=\"shop\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\ShopController::index', {request: app.request})) }}
    </div>

    {# Onglet Panier #}
    <div class=\"tab-pane fade\" id=\"cart\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\CartController::index')) }}
    </div>
</div>

{% endblock %}

{% block javascripts %}
{{ parent() }}
<script>
    // Optionnel : mise à jour dynamique du badge panier (à adapter si besoin)
    document.addEventListener('DOMContentLoaded', function() {
        // Exemple : si vous faites des actions AJAX dans le panier,
        // vous pourriez rafraîchir le badge ici.
    });
</script>
{% endblock %}", "dashboard/client.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\dashboard\\client.html.twig");
    }
}
