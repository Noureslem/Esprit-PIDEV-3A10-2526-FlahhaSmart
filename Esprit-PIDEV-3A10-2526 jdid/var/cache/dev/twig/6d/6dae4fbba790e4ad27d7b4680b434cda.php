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

/* shop/index.html.twig */
class __TwigTemplate_3e040aab84342dc9858ff30732f85cc5 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shop/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shop/index.html.twig"));

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

        yield "Catalogue - FlahaSmart";
        
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
        yield "<div class=\"container\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>🌿 Nos produits agricoles</h1>
        <div>
            <a href=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart_index");
        yield "\" class=\"btn btn-outline-success\">
                🛒 Panier <span class=\"badge bg-success\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 11, $this->source); })()), "session", [], "any", false, false, false, 11), "get", ["cart"], "method", false, false, false, 11)), "html", null, true);
        yield "</span>
            </a>
        </div>
    </div>

    ";
        // line 17
        yield "    <div class=\"row mb-4\">
        <div class=\"col-md-6\">
            <form method=\"get\" class=\"d-flex\">
                <input type=\"text\" name=\"search\" class=\"form-control me-2\" placeholder=\"Rechercher un article...\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 20, $this->source); })()), "html", null, true);
        yield "\">
                <button class=\"btn btn-primary\" type=\"submit\">🔍</button>
            </form>
        </div>
        <div class=\"col-md-6 text-end\">
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-secondary dropdown-toggle\" data-bs-toggle=\"dropdown\">
                    Trier par
                </button>
                <ul class=\"dropdown-menu\">
                    <li><a class=\"dropdown-item\" href=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index", ["sort" => "name_asc", "search" => (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 30, $this->source); })())]), "html", null, true);
        yield "\">Nom A→Z</a></li>
                    <li><a class=\"dropdown-item\" href=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index", ["sort" => "name_desc", "search" => (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 31, $this->source); })())]), "html", null, true);
        yield "\">Nom Z→A</a></li>
                    <li><a class=\"dropdown-item\" href=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index", ["sort" => "price_asc", "search" => (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 32, $this->source); })())]), "html", null, true);
        yield "\">Prix croissant</a></li>
                    <li><a class=\"dropdown-item\" href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index", ["sort" => "price_desc", "search" => (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 33, $this->source); })())]), "html", null, true);
        yield "\">Prix décroissant</a></li>
                    <li><a class=\"dropdown-item\" href=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index", ["sort" => "date_desc", "search" => (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 34, $this->source); })())]), "html", null, true);
        yield "\">Nouveautés</a></li>
                </ul>
            </div>
        </div>
    </div>

    ";
        // line 41
        yield "    <div class=\"row\">
        ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 42, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 43
            yield "        <div class=\"col-md-4 col-lg-3 mb-4\">
            <div class=\"card h-100 shadow-sm\">
                ";
            // line 45
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "imageUrl", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 46
                yield "                    <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "imageUrl", [], "any", false, false, false, 46), "html", null, true);
                yield "\" class=\"card-img-top\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "nom", [], "any", false, false, false, 46), "html", null, true);
                yield "\" style=\"height: 180px; object-fit: cover;\">
                ";
            } else {
                // line 48
                yield "                    <div class=\"card-img-top bg-light d-flex align-items-center justify-content-center\" style=\"height: 180px;\">
                        🌾 <span class=\"text-muted\">Pas d'image</span>
                    </div>
                ";
            }
            // line 52
            yield "                <div class=\"card-body\">
                    <h5 class=\"card-title\">";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "nom", [], "any", false, false, false, 53), "html", null, true);
            yield "</h5>
                    <p class=\"card-text text-truncate\">";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "description", [], "any", false, false, false, 54), "html", null, true);
            yield "</p>
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <span class=\"h5 text-success\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "prix", [], "any", false, false, false, 56), "html", null, true);
            yield " €</span>
                        <small class=\"text-muted\">Stock: ";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "stock", [], "any", false, false, false, 57), "html", null, true);
            yield "</small>
                    </div>
                    <div class=\"mt-2\">
                        <span class=\"badge bg-secondary\">";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 60), "html", null, true);
            yield "</span>
                        ";
            // line 61
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "poids", [], "any", false, false, false, 61)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 62
                yield "                            <span class=\"badge bg-info\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "poids", [], "any", false, false, false, 62), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "unite", [], "any", true, true, false, 62)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "unite", [], "any", false, false, false, 62), "kg")) : ("kg")), "html", null, true);
                yield "</span>
                        ";
            }
            // line 64
            yield "                    </div>
                </div>
                <div class=\"card-footer bg-white border-top-0\">
                    <a href=\"";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 67)]), "html", null, true);
            yield "\" class=\"btn btn-outline-primary w-100 mb-2\">🔍 Détails</a>
                    <a href=\"";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart_add", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 68), "quantity" => 1]), "html", null, true);
            yield "\" class=\"btn btn-success w-100\">➕ Ajouter au panier</a>
                </div>
            </div>
        </div>
        ";
            $context['_iterated'] = true;
        }
        // line 72
        if (!$context['_iterated']) {
            // line 73
            yield "        <div class=\"col-12\">
            <div class=\"alert alert-warning\">Aucun article trouvé.</div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        yield "    </div>
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
        return "shop/index.html.twig";
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
        return array (  254 => 77,  245 => 73,  243 => 72,  234 => 68,  230 => 67,  225 => 64,  217 => 62,  215 => 61,  211 => 60,  205 => 57,  201 => 56,  196 => 54,  192 => 53,  189 => 52,  183 => 48,  175 => 46,  173 => 45,  169 => 43,  164 => 42,  161 => 41,  152 => 34,  148 => 33,  144 => 32,  140 => 31,  136 => 30,  123 => 20,  118 => 17,  110 => 11,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Catalogue - FlahaSmart{% endblock %}

{% block body %}
<div class=\"container\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>🌿 Nos produits agricoles</h1>
        <div>
            <a href=\"{{ path('app_cart_index') }}\" class=\"btn btn-outline-success\">
                🛒 Panier <span class=\"badge bg-success\">{{ app.session.get('cart')|length }}</span>
            </a>
        </div>
    </div>

    {# Barre de recherche et tri #}
    <div class=\"row mb-4\">
        <div class=\"col-md-6\">
            <form method=\"get\" class=\"d-flex\">
                <input type=\"text\" name=\"search\" class=\"form-control me-2\" placeholder=\"Rechercher un article...\" value=\"{{ search }}\">
                <button class=\"btn btn-primary\" type=\"submit\">🔍</button>
            </form>
        </div>
        <div class=\"col-md-6 text-end\">
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-secondary dropdown-toggle\" data-bs-toggle=\"dropdown\">
                    Trier par
                </button>
                <ul class=\"dropdown-menu\">
                    <li><a class=\"dropdown-item\" href=\"{{ path('app_shop_index', {sort: 'name_asc', search: search}) }}\">Nom A→Z</a></li>
                    <li><a class=\"dropdown-item\" href=\"{{ path('app_shop_index', {sort: 'name_desc', search: search}) }}\">Nom Z→A</a></li>
                    <li><a class=\"dropdown-item\" href=\"{{ path('app_shop_index', {sort: 'price_asc', search: search}) }}\">Prix croissant</a></li>
                    <li><a class=\"dropdown-item\" href=\"{{ path('app_shop_index', {sort: 'price_desc', search: search}) }}\">Prix décroissant</a></li>
                    <li><a class=\"dropdown-item\" href=\"{{ path('app_shop_index', {sort: 'date_desc', search: search}) }}\">Nouveautés</a></li>
                </ul>
            </div>
        </div>
    </div>

    {# Grille de cartes #}
    <div class=\"row\">
        {% for article in articles %}
        <div class=\"col-md-4 col-lg-3 mb-4\">
            <div class=\"card h-100 shadow-sm\">
                {% if article.imageUrl %}
                    <img src=\"{{ article.imageUrl }}\" class=\"card-img-top\" alt=\"{{ article.nom }}\" style=\"height: 180px; object-fit: cover;\">
                {% else %}
                    <div class=\"card-img-top bg-light d-flex align-items-center justify-content-center\" style=\"height: 180px;\">
                        🌾 <span class=\"text-muted\">Pas d'image</span>
                    </div>
                {% endif %}
                <div class=\"card-body\">
                    <h5 class=\"card-title\">{{ article.nom }}</h5>
                    <p class=\"card-text text-truncate\">{{ article.description }}</p>
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <span class=\"h5 text-success\">{{ article.prix }} €</span>
                        <small class=\"text-muted\">Stock: {{ article.stock }}</small>
                    </div>
                    <div class=\"mt-2\">
                        <span class=\"badge bg-secondary\">{{ article.categorie }}</span>
                        {% if article.poids %}
                            <span class=\"badge bg-info\">{{ article.poids }} {{ article.unite|default('kg') }}</span>
                        {% endif %}
                    </div>
                </div>
                <div class=\"card-footer bg-white border-top-0\">
                    <a href=\"{{ path('app_shop_show', {id: article.id}) }}\" class=\"btn btn-outline-primary w-100 mb-2\">🔍 Détails</a>
                    <a href=\"{{ path('app_cart_add', {id: article.id, quantity: 1}) }}\" class=\"btn btn-success w-100\">➕ Ajouter au panier</a>
                </div>
            </div>
        </div>
        {% else %}
        <div class=\"col-12\">
            <div class=\"alert alert-warning\">Aucun article trouvé.</div>
        </div>
        {% endfor %}
    </div>
</div>
{% endblock %}", "shop/index.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\shop\\index.html.twig");
    }
}
