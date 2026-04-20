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

/* base.html.twig */
class __TwigTemplate_8cfbfcc77d26e1eaf78b893dedac6930 extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'page_title' => [$this, 'block_page_title'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css\">
    <style>
        :root { --sidebar-w: 250px; }
        body { background: #f0f2f5; }
        .sidebar {
            position: fixed; top: 0; left: 0; height: 100vh;
            width: var(--sidebar-w); background: #1a3c34;
            color: #fff; display: flex; flex-direction: column;
            z-index: 100; overflow-y: auto;
        }
        .sidebar .brand { padding: 1.5rem 1rem; font-size: 1.3rem; font-weight: 700; color: #7fd1ae; }
        .sidebar .user-info { padding: .75rem 1rem; background: rgba(255,255,255,.07); margin: 0 .75rem .75rem; border-radius: 10px; }
        .sidebar .user-info small { color: #90b8a8; display: block; font-size: .7rem; }
        .sidebar .nav-link { color: #c4ddd5; padding: .55rem 1rem; border-radius: 8px; margin: 2px .5rem; display: flex; align-items: center; gap: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(127,209,174,.2); color: #fff; }
        .sidebar .nav-link i { width: 20px; text-align: center; }
        .sidebar .nav-section { font-size: .65rem; text-transform: uppercase; letter-spacing: .1em; color: #6a9e8e; padding: .6rem 1.5rem .2rem; }
        .main { margin-left: var(--sidebar-w); padding: 1.5rem 2rem; min-height: 100vh; }
        .topbar { background: #fff; border-radius: 12px; padding: .75rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
        .card { border: none; border-radius: 14px; box-shadow: 0 1px 6px rgba(0,0,0,.07); }
        .stat-card { background: linear-gradient(135deg, var(--c1), var(--c2)); color: #fff; border-radius: 14px; padding: 1.25rem; }
        .badge-role { font-size: .7rem; padding: .3em .7em; border-radius: 20px; font-weight: 600; }
        .badge-ADMINISTRATEUR { background: #fde8d8; color: #c05000; }
        .badge-AGRICULTEUR    { background: #dff5e3; color: #1a6e35; }
        .badge-CLIENT         { background: #e0eeff; color: #1a4fa0; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: .3s; }
            .main { margin-left: 0; padding: 1rem; }
        }
    </style>
    ";
        // line 39
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 40
        yield "</head>
<body>

";
        // line 44
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 44, $this->source); })()), "user", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 45
            yield "<div class=\"sidebar\">
    <div class=\"brand\">🌱 FlahaSmart</div>

    <div class=\"user-info\">
        <strong>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 49, $this->source); })()), "user", [], "any", false, false, false, 49), "fullName", [], "any", false, false, false, 49), "html", null, true);
            yield "</strong>
        <small>";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 50, $this->source); })()), "user", [], "any", false, false, false, 50), "email", [], "any", false, false, false, 50), "html", null, true);
            yield "</small>
        <span class=\"badge badge-";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 51, $this->source); })()), "user", [], "any", false, false, false, 51), "role", [], "any", false, false, false, 51), "html", null, true);
            yield " mt-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 51, $this->source); })()), "user", [], "any", false, false, false, 51), "role", [], "any", false, false, false, 51), "html", null, true);
            yield "</span>
    </div>

    <nav class=\"mt-2\">
        ";
            // line 55
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 56
                yield "            <span class=\"nav-section\">Administration</span>
            <a class=\"nav-link ";
                // line 57
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "request", [], "any", false, false, false, 57), "attributes", [], "any", false, false, false, 57), "get", ["_route"], "method", false, false, false, 57) == "dashboard_admin")) {
                    yield "active";
                }
                yield "\"
               href=\"";
                // line 58
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_admin");
                yield "\">
                <i class=\"bi bi-speedometer2\"></i> Dashboard
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-people\"></i> Utilisateurs
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-box-seam\"></i> Articles
            </a>
            <a class=\"nav-link\" href=\"";
                // line 67
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_stock_index");
                yield "\">
                <i class=\"fa-solid fa-boxes-stacked\"></i> Stocks Produits
            </a>
            <a class=\"nav-link\" href=\"";
                // line 70
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_consommation_index");
                yield "\">
                <i class=\"fa-solid fa-chart-pie\"></i> Consommations
            </a>
        ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_AGRICULTEUR")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 74
                yield "            <span class=\"nav-section\">Agriculteur</span>
            ";
                // line 76
                yield "            <a class=\"nav-link ";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 76, $this->source); })()), "request", [], "any", false, false, false, 76), "attributes", [], "any", false, false, false, 76), "get", ["_route"], "method", false, false, false, 76) == "dashboard_agriculteur")) {
                    yield "active";
                }
                yield "\"
               href=\"";
                // line 77
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_agriculteur");
                yield "\">
                <i class=\"bi bi-house\"></i> Mes commandes
            </a>

            <a class=\"nav-link ";
                // line 81
                if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 81, $this->source); })()), "request", [], "any", false, false, false, 81), "attributes", [], "any", false, false, false, 81), "get", ["_route"], "method", false, false, false, 81)) && is_string($_v1 = "app_article_") && str_starts_with($_v0, $_v1))) {
                    yield "active";
                }
                yield "\" 
               href=\"";
                // line 82
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
                yield "\">
                <i class=\"bi bi-box\"></i> Mes articles
            </a>
            <a class=\"nav-link\" href=\"";
                // line 85
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("agriculteur_stock_index");
                yield "\">
                <i class=\"bi bi-box-seam\"></i> Produits
            </a>
            <a class=\"nav-link\" href=\"";
                // line 88
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("agriculteur_consommation_index");
                yield "\">
                <i class=\"bi bi-box-seam\"></i> Consommations
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-chat-dots\"></i> Forum
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-droplet\"></i> Stock produit
            </a>
        ";
            } else {
                // line 98
                yield "            <span class=\"nav-section\">Client</span>
            <a class=\"nav-link ";
                // line 99
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 99, $this->source); })()), "request", [], "any", false, false, false, 99), "attributes", [], "any", false, false, false, 99), "get", ["_route"], "method", false, false, false, 99) == "dashboard_client")) {
                    yield "active";
                }
                yield "\"
               href=\"";
                // line 100
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_client");
                yield "\">
                <i class=\"bi bi-house\"></i> Accueil
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-bag\"></i> Mes commandes
            </a>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"";
                // line 106
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("client_produit_index");
                yield "\"> <i class=\"fa-solid fa-leaf me-1\"></i>Nos Produits</a></li>
        ";
            }
            // line 108
            yield "
        <span class=\"nav-section\">Compte</span>
        <a class=\"nav-link ";
            // line 110
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 110, $this->source); })()), "request", [], "any", false, false, false, 110), "attributes", [], "any", false, false, false, 110), "get", ["_route"], "method", false, false, false, 110) == "app_profile")) {
                yield "active";
            }
            yield "\" 
           href=\"";
            // line 111
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
            yield "\">
            <i class=\"bi bi-person-gear\"></i> Profil
        </a>
        <a class=\"nav-link text-danger\" href=\"";
            // line 114
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\">
            <i class=\"bi bi-box-arrow-right\"></i> Déconnexion
        </a>
    </nav>
</div>
";
        }
        // line 120
        yield "
";
        // line 122
        yield "<div class=\"";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 122, $this->source); })()), "user", [], "any", false, false, false, 122)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "main";
        } else {
            yield "container py-5";
        }
        yield "\">
    ";
        // line 123
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 123, $this->source); })()), "user", [], "any", false, false, false, 123)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 124
            yield "    <div class=\"topbar\">
        <div>
            <strong>";
            // line 126
            yield from $this->unwrap()->yieldBlock('page_title', $context, $blocks);
            yield "</strong>
        </div>
        <div class=\"d-flex align-items-center gap-3\">
            <span class=\"text-muted small\">";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "d/m/Y H:i"), "html", null, true);
            yield "</span>
            <span class=\"badge bg-secondary\">";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 130, $this->source); })()), "user", [], "any", false, false, false, 130), "role", [], "any", false, false, false, 130), "html", null, true);
            yield "</span>
        </div>
    </div>
    ";
        }
        // line 134
        yield "
    ";
        // line 135
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 135, $this->source); })()), "flashes", [], "any", false, false, false, 135));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 136
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 137
                yield "            <div class=\"alert alert-";
                yield ((($context["label"] == "error")) ? ("danger") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true)));
                yield " alert-dismissible fade show\" role=\"alert\">
                ";
                // line 138
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 142
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        yield "
    ";
        // line 144
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 145
        yield "</div>

<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
";
        // line 148
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 149
        yield "</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
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

        yield "FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 39
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 126
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

        yield "Tableau de bord";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 144
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 148
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  442 => 148,  420 => 144,  397 => 126,  375 => 39,  352 => 6,  340 => 149,  338 => 148,  333 => 145,  331 => 144,  328 => 143,  322 => 142,  312 => 138,  307 => 137,  302 => 136,  298 => 135,  295 => 134,  288 => 130,  284 => 129,  278 => 126,  274 => 124,  272 => 123,  263 => 122,  260 => 120,  251 => 114,  245 => 111,  239 => 110,  235 => 108,  230 => 106,  221 => 100,  215 => 99,  212 => 98,  199 => 88,  193 => 85,  187 => 82,  181 => 81,  174 => 77,  167 => 76,  164 => 74,  157 => 70,  151 => 67,  139 => 58,  133 => 57,  130 => 56,  128 => 55,  119 => 51,  115 => 50,  111 => 49,  105 => 45,  103 => 44,  98 => 40,  96 => 39,  60 => 6,  53 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{% block title %}FlahaSmart{% endblock %}</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css\">
    <style>
        :root { --sidebar-w: 250px; }
        body { background: #f0f2f5; }
        .sidebar {
            position: fixed; top: 0; left: 0; height: 100vh;
            width: var(--sidebar-w); background: #1a3c34;
            color: #fff; display: flex; flex-direction: column;
            z-index: 100; overflow-y: auto;
        }
        .sidebar .brand { padding: 1.5rem 1rem; font-size: 1.3rem; font-weight: 700; color: #7fd1ae; }
        .sidebar .user-info { padding: .75rem 1rem; background: rgba(255,255,255,.07); margin: 0 .75rem .75rem; border-radius: 10px; }
        .sidebar .user-info small { color: #90b8a8; display: block; font-size: .7rem; }
        .sidebar .nav-link { color: #c4ddd5; padding: .55rem 1rem; border-radius: 8px; margin: 2px .5rem; display: flex; align-items: center; gap: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(127,209,174,.2); color: #fff; }
        .sidebar .nav-link i { width: 20px; text-align: center; }
        .sidebar .nav-section { font-size: .65rem; text-transform: uppercase; letter-spacing: .1em; color: #6a9e8e; padding: .6rem 1.5rem .2rem; }
        .main { margin-left: var(--sidebar-w); padding: 1.5rem 2rem; min-height: 100vh; }
        .topbar { background: #fff; border-radius: 12px; padding: .75rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
        .card { border: none; border-radius: 14px; box-shadow: 0 1px 6px rgba(0,0,0,.07); }
        .stat-card { background: linear-gradient(135deg, var(--c1), var(--c2)); color: #fff; border-radius: 14px; padding: 1.25rem; }
        .badge-role { font-size: .7rem; padding: .3em .7em; border-radius: 20px; font-weight: 600; }
        .badge-ADMINISTRATEUR { background: #fde8d8; color: #c05000; }
        .badge-AGRICULTEUR    { background: #dff5e3; color: #1a6e35; }
        .badge-CLIENT         { background: #e0eeff; color: #1a4fa0; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: .3s; }
            .main { margin-left: 0; padding: 1rem; }
        }
    </style>
    {% block stylesheets %}{% endblock %}
</head>
<body>

{# AFFICHER LA SIDEBAR SEULEMENT SI L'UTILISATEUR EST CONNECTÉ #}
{% if app.user %}
<div class=\"sidebar\">
    <div class=\"brand\">🌱 FlahaSmart</div>

    <div class=\"user-info\">
        <strong>{{ app.user.fullName }}</strong>
        <small>{{ app.user.email }}</small>
        <span class=\"badge badge-{{ app.user.role }} mt-1\">{{ app.user.role }}</span>
    </div>

    <nav class=\"mt-2\">
        {% if is_granted('ROLE_ADMIN') %}
            <span class=\"nav-section\">Administration</span>
            <a class=\"nav-link {% if app.request.attributes.get('_route') == 'dashboard_admin' %}active{% endif %}\"
               href=\"{{ path('dashboard_admin') }}\">
                <i class=\"bi bi-speedometer2\"></i> Dashboard
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-people\"></i> Utilisateurs
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-box-seam\"></i> Articles
            </a>
            <a class=\"nav-link\" href=\"{{ path('admin_stock_index') }}\">
                <i class=\"fa-solid fa-boxes-stacked\"></i> Stocks Produits
            </a>
            <a class=\"nav-link\" href=\"{{ path('admin_consommation_index') }}\">
                <i class=\"fa-solid fa-chart-pie\"></i> Consommations
            </a>
        {% elseif is_granted('ROLE_AGRICULTEUR') %}
            <span class=\"nav-section\">Agriculteur</span>
            {# MODIFICATION ICI : \"Accueil\" → \"Mes commandes\" #}
            <a class=\"nav-link {% if app.request.attributes.get('_route') == 'dashboard_agriculteur' %}active{% endif %}\"
               href=\"{{ path('dashboard_agriculteur') }}\">
                <i class=\"bi bi-house\"></i> Mes commandes
            </a>

            <a class=\"nav-link {% if app.request.attributes.get('_route') starts with 'app_article_' %}active{% endif %}\" 
               href=\"{{ path('app_article_index') }}\">
                <i class=\"bi bi-box\"></i> Mes articles
            </a>
            <a class=\"nav-link\" href=\"{{ path('agriculteur_stock_index') }}\">
                <i class=\"bi bi-box-seam\"></i> Produits
            </a>
            <a class=\"nav-link\" href=\"{{ path('agriculteur_consommation_index') }}\">
                <i class=\"bi bi-box-seam\"></i> Consommations
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-chat-dots\"></i> Forum
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-droplet\"></i> Stock produit
            </a>
        {% else %}
            <span class=\"nav-section\">Client</span>
            <a class=\"nav-link {% if app.request.attributes.get('_route') == 'dashboard_client' %}active{% endif %}\"
               href=\"{{ path('dashboard_client') }}\">
                <i class=\"bi bi-house\"></i> Accueil
            </a>
            <a class=\"nav-link\" href=\"#\">
                <i class=\"bi bi-bag\"></i> Mes commandes
            </a>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"{{ path('client_produit_index') }}\"> <i class=\"fa-solid fa-leaf me-1\"></i>Nos Produits</a></li>
        {% endif %}

        <span class=\"nav-section\">Compte</span>
        <a class=\"nav-link {% if app.request.attributes.get('_route') == 'app_profile' %}active{% endif %}\" 
           href=\"{{ path('app_profile') }}\">
            <i class=\"bi bi-person-gear\"></i> Profil
        </a>
        <a class=\"nav-link text-danger\" href=\"{{ path('app_logout') }}\">
            <i class=\"bi bi-box-arrow-right\"></i> Déconnexion
        </a>
    </nav>
</div>
{% endif %}

{# CONTENEUR PRINCIPAL #}
<div class=\"{% if app.user %}main{% else %}container py-5{% endif %}\">
    {% if app.user %}
    <div class=\"topbar\">
        <div>
            <strong>{% block page_title %}Tableau de bord{% endblock %}</strong>
        </div>
        <div class=\"d-flex align-items-center gap-3\">
            <span class=\"text-muted small\">{{ \"now\"|date(\"d/m/Y H:i\") }}</span>
            <span class=\"badge bg-secondary\">{{ app.user.role }}</span>
        </div>
    </div>
    {% endif %}

    {% for label, messages in app.flashes %}
        {% for message in messages %}
            <div class=\"alert alert-{{ label == 'error' ? 'danger' : label }} alert-dismissible fade show\" role=\"alert\">
                {{ message }}
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        {% endfor %}
    {% endfor %}

    {% block body %}{% endblock %}
</div>

<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
{% block javascripts %}{% endblock %}
</body>
</html>", "base.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\base.html.twig");
    }
}
