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

/* dashboard/agriculteur.html.twig */
class __TwigTemplate_a343cddc6ae9d87ce8029a2c53edaff5 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/agriculteur.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/agriculteur.html.twig"));

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

        yield "Dashboard Agriculteur — FlahaSmart";
        
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

        yield "Mon espace agriculteur";
        
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
    <p class=\"text-muted mb-0\">";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 9, $this->source); })()), "ville", [], "any", false, false, false, 9), "html", null, true);
        yield "</p>

    <div class=\"mt-3 d-flex gap-2 flex-wrap\">
        <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_index");
        yield "\" class=\"btn btn-outline-primary\">
            🛒 Voir toutes les commandes
        </a>
        <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_todo_index");
        yield "\" class=\"btn btn-outline-success\">
            ✅ Voir toutes les tâches (Todo)
        </a>
        <a href=\"";
        // line 18
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\" class=\"btn btn-outline-secondary\">
            📦 Retour aux articles
        </a>
        ";
        // line 22
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_calendar");
        yield "\" class=\"btn btn-outline-info\">
            📅 Calendrier
        </a>
        <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_price_estimator");
        yield "\" class=\"btn btn-outline-warning\">
            💰 Estimateur de prix
        </a>
    </div>
</div>

<ul class=\"nav nav-tabs mb-4\" id=\"agriculteurTab\" role=\"tablist\">
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link active\" id=\"articles-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#articles\" type=\"button\" role=\"tab\">📦 Mes articles</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"commandes-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#commandes\" type=\"button\" role=\"tab\">🛒 Commandes</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"todo-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#todo\" type=\"button\" role=\"tab\">✅ Tâches (Todo)</button>
    </li>
    ";
        // line 42
        yield "    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"calendar-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#calendar\" type=\"button\" role=\"tab\">📅 Calendrier</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"estimator-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#estimator\" type=\"button\" role=\"tab\">💰 Estimateur prix</button>
    </li>
</ul>

<div class=\"tab-content\" id=\"agriculteurTabContent\">
    ";
        // line 52
        yield "    <div class=\"tab-pane fade show active\" id=\"articles\" role=\"tabpanel\">
        <div class=\"card\">
            <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
                <h5 class=\"mb-0\">Mes articles</h5>
                <a href=\"#\" class=\"btn btn-sm btn-success\">+ Ajouter</a>
            </div>
            <div class=\"card-body p-0\">
                <div class=\"table-responsive\">
                    <table class=\"table table-hover mb-0\">
                        <thead class=\"table-light\">
                            <tr>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        ";
        // line 71
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 71, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 72
            yield "                            <tr>
                                <td><strong>";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "nom", [], "any", false, false, false, 73), "html", null, true);
            yield "</strong></td>
                                <td>";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "categorie", [], "any", false, false, false, 74), "html", null, true);
            yield "</td>
                                <td>";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "prix", [], "any", false, false, false, 75), "html", null, true);
            yield " DT</td>
                                <td>
                                    <span class=\"badge ";
            // line 77
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["a"], "stock", [], "any", false, false, false, 77) > 10)) {
                yield "bg-success";
            } else {
                yield "bg-warning text-dark";
            }
            yield "\">
                                        ";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "stock", [], "any", false, false, false, 78), "html", null, true);
            yield "
                                    </span>
                                </td>
                                <td class=\"text-muted small\">";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "date_ajout", [], "any", false, false, false, 81), "d/m/Y"), "html", null, true);
            yield "</td>
                            </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 83
        if (!$context['_iterated']) {
            // line 84
            yield "                            <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucun article</td></table>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['a'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 94
        yield "    <div class=\"tab-pane fade\" id=\"commandes\" role=\"tabpanel\">
        ";
        // line 95
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\OrderController::index", ["request" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 95, $this->source); })()), "request", [], "any", false, false, false, 95)]));
        yield "
    </div>

    ";
        // line 99
        yield "    <div class=\"tab-pane fade\" id=\"todo\" role=\"tabpanel\">
        ";
        // line 100
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\TodoController::index", ["request" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 100, $this->source); })()), "request", [], "any", false, false, false, 100)]));
        yield "
    </div>

    ";
        // line 104
        yield "    <div class=\"tab-pane fade\" id=\"calendar\" role=\"tabpanel\">
        ";
        // line 105
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\CalendarController::index"));
        yield "
    </div>

    ";
        // line 109
        yield "    <div class=\"tab-pane fade\" id=\"estimator\" role=\"tabpanel\">
        ";
        // line 110
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("App\\Controller\\article\\PriceEstimatorController::index"));
        yield "
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
        return "dashboard/agriculteur.html.twig";
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
        return array (  304 => 110,  301 => 109,  295 => 105,  292 => 104,  286 => 100,  283 => 99,  277 => 95,  274 => 94,  265 => 86,  258 => 84,  256 => 83,  249 => 81,  243 => 78,  235 => 77,  230 => 75,  226 => 74,  222 => 73,  219 => 72,  214 => 71,  193 => 52,  182 => 42,  163 => 25,  156 => 22,  150 => 18,  144 => 15,  138 => 12,  132 => 9,  128 => 8,  124 => 6,  111 => 5,  88 => 3,  65 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Dashboard Agriculteur — FlahaSmart{% endblock %}
{% block page_title %}Mon espace agriculteur{% endblock %}

{% block body %}

<div class=\"mb-4\">
    <h4>Bonjour, {{ user.fullName }} 👋</h4>
    <p class=\"text-muted mb-0\">{{ user.ville }}</p>

    <div class=\"mt-3 d-flex gap-2 flex-wrap\">
        <a href=\"{{ path('app_order_index') }}\" class=\"btn btn-outline-primary\">
            🛒 Voir toutes les commandes
        </a>
        <a href=\"{{ path('app_todo_index') }}\" class=\"btn btn-outline-success\">
            ✅ Voir toutes les tâches (Todo)
        </a>
        <a href=\"{{ path('app_article_index') }}\" class=\"btn btn-outline-secondary\">
            📦 Retour aux articles
        </a>
        {# NOUVEAUX BOUTONS #}
        <a href=\"{{ path('app_calendar') }}\" class=\"btn btn-outline-info\">
            📅 Calendrier
        </a>
        <a href=\"{{ path('app_price_estimator') }}\" class=\"btn btn-outline-warning\">
            💰 Estimateur de prix
        </a>
    </div>
</div>

<ul class=\"nav nav-tabs mb-4\" id=\"agriculteurTab\" role=\"tablist\">
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link active\" id=\"articles-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#articles\" type=\"button\" role=\"tab\">📦 Mes articles</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"commandes-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#commandes\" type=\"button\" role=\"tab\">🛒 Commandes</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"todo-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#todo\" type=\"button\" role=\"tab\">✅ Tâches (Todo)</button>
    </li>
    {# Les onglets Calendrier et Estimateur sont conservés (optionnels) #}
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"calendar-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#calendar\" type=\"button\" role=\"tab\">📅 Calendrier</button>
    </li>
    <li class=\"nav-item\" role=\"presentation\">
        <button class=\"nav-link\" id=\"estimator-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#estimator\" type=\"button\" role=\"tab\">💰 Estimateur prix</button>
    </li>
</ul>

<div class=\"tab-content\" id=\"agriculteurTabContent\">
    {# ONGLET ARTICLES #}
    <div class=\"tab-pane fade show active\" id=\"articles\" role=\"tabpanel\">
        <div class=\"card\">
            <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
                <h5 class=\"mb-0\">Mes articles</h5>
                <a href=\"#\" class=\"btn btn-sm btn-success\">+ Ajouter</a>
            </div>
            <div class=\"card-body p-0\">
                <div class=\"table-responsive\">
                    <table class=\"table table-hover mb-0\">
                        <thead class=\"table-light\">
                            <tr>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        {% for a in articles %}
                            <tr>
                                <td><strong>{{ a.nom }}</strong></td>
                                <td>{{ a.categorie }}</td>
                                <td>{{ a.prix }} DT</td>
                                <td>
                                    <span class=\"badge {% if a.stock > 10 %}bg-success{% else %}bg-warning text-dark{% endif %}\">
                                        {{ a.stock }}
                                    </span>
                                </td>
                                <td class=\"text-muted small\">{{ a.date_ajout|date('d/m/Y') }}</td>
                            </tr>
                        {% else %}
                            <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucun article</td></table>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {# ONGLET COMMANDES #}
    <div class=\"tab-pane fade\" id=\"commandes\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\OrderController::index', {request: app.request})) }}
    </div>

    {# ONGLET TODO #}
    <div class=\"tab-pane fade\" id=\"todo\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\TodoController::index', {request: app.request})) }}
    </div>

    {# ONGLET CALENDRIER #}
    <div class=\"tab-pane fade\" id=\"calendar\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\CalendarController::index')) }}
    </div>

    {# ONGLET ESTIMATEUR DE PRIX #}
    <div class=\"tab-pane fade\" id=\"estimator\" role=\"tabpanel\">
        {{ render(controller('App\\\\Controller\\\\article\\\\PriceEstimatorController::index')) }}
    </div>
</div>

{% endblock %}", "dashboard/agriculteur.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\dashboard\\agriculteur.html.twig");
    }
}
