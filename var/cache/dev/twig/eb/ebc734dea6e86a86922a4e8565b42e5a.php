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
class __TwigTemplate_22c0105240c098b5316a3e972914f668 extends Template
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
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body {
            background-color: #f0f7f0;
        }
        .navbar {
            background-color: #2e7d32;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link.active {
            background-color: #1b5e20;
            border-radius: 5px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .table thead th {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .table-hover tbody tr:hover {
            background-color: #e8f5e9;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2e7d32;
        }
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .progress-bar {
            background-color: #2e7d32;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
            padding: 20px;
        }
    </style>
    ";
        // line 80
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 81
        yield "</head>
<body>
    <nav class=\"navbar navbar-expand-lg\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">🌿 FlahaSmart</a>
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                <ul class=\"navbar-nav ms-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 92
        yield (((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 92, $this->source); })()), "request", [], "any", false, false, false, 92), "get", ["_route"], "method", false, false, false, 92)) && is_string($_v1 = "app_article") && str_starts_with($_v0, $_v1))) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\">Articles</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 95
        yield (((is_string($_v2 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 95, $this->source); })()), "request", [], "any", false, false, false, 95), "get", ["_route"], "method", false, false, false, 95)) && is_string($_v3 = "app_order") && str_starts_with($_v2, $_v3))) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_index");
        yield "\">Commandes</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 98
        yield (((is_string($_v4 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 98, $this->source); })()), "request", [], "any", false, false, false, 98), "get", ["_route"], "method", false, false, false, 98)) && is_string($_v5 = "app_todo") && str_starts_with($_v4, $_v5))) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_todo_index");
        yield "\"> TODO</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 101
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 101, $this->source); })()), "request", [], "any", false, false, false, 101), "get", ["_route"], "method", false, false, false, 101) == "app_consultant")) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_consultant");
        yield "\"> Consultant AI</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 104
        yield (((is_string($_v6 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 104, $this->source); })()), "request", [], "any", false, false, false, 104), "get", ["_route"], "method", false, false, false, 104)) && is_string($_v7 = "app_price_estimator") && str_starts_with($_v6, $_v7))) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_price_estimator");
        yield "\">Prix d'article </a>
                    </li>   
                </ul>
            </div>
        </div>
    </nav>

    <main class=\"container py-4\">
        ";
        // line 112
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 113
        yield "    </main>

    <footer>
        &copy; ";
        // line 116
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " FlahaSmart - Tous droits réservés
    </footer>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js\"></script>
    ";
        // line 120
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 121
        yield "</body>
</html>";
        
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 112
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 120
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

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
        return array (  270 => 120,  254 => 112,  238 => 80,  221 => 6,  212 => 121,  210 => 120,  203 => 116,  198 => 113,  196 => 112,  183 => 104,  175 => 101,  167 => 98,  159 => 95,  151 => 92,  141 => 85,  135 => 81,  133 => 80,  56 => 6,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>{% block title %}FlahaSmart{% endblock %}</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body {
            background-color: #f0f7f0;
        }
        .navbar {
            background-color: #2e7d32;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link.active {
            background-color: #1b5e20;
            border-radius: 5px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .table thead th {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .table-hover tbody tr:hover {
            background-color: #e8f5e9;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2e7d32;
        }
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .progress-bar {
            background-color: #2e7d32;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
            padding: 20px;
        }
    </style>
    {% block stylesheets %}{% endblock %}
</head>
<body>
    <nav class=\"navbar navbar-expand-lg\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"{{ path('app_home') }}\">🌿 FlahaSmart</a>
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                <ul class=\"navbar-nav ms-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link {{ app.request.get('_route') starts with 'app_article' ? 'active' : '' }}\" href=\"{{ path('app_article_index') }}\">Articles</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link {{ app.request.get('_route') starts with 'app_order' ? 'active' : '' }}\" href=\"{{ path('app_order_index') }}\">Commandes</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link {{ app.request.get('_route') starts with 'app_todo' ? 'active' : '' }}\" href=\"{{ path('app_todo_index') }}\"> TODO</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link {{ app.request.get('_route') == 'app_consultant' ? 'active' : '' }}\" href=\"{{ path('app_consultant') }}\"> Consultant AI</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link {{ app.request.get('_route') starts with 'app_price_estimator' ? 'active' : '' }}\" href=\"{{ path('app_price_estimator') }}\">Prix d'article </a>
                    </li>   
                </ul>
            </div>
        </div>
    </nav>

    <main class=\"container py-4\">
        {% block body %}{% endblock %}
    </main>

    <footer>
        &copy; {{ \"now\"|date(\"Y\") }} FlahaSmart - Tous droits réservés
    </footer>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js\"></script>
    {% block javascripts %}{% endblock %}
</body>
</html>", "base.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\base.html.twig");
    }
}
