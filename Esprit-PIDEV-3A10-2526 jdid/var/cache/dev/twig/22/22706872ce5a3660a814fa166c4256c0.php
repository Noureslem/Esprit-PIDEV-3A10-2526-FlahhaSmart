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

/* shop/show.html.twig */
class __TwigTemplate_c7d2256f9ac411d610c97b2fecd10163 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shop/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shop/show.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 3, $this->source); })()), "nom", [], "any", false, false, false, 3), "html", null, true);
        yield " - FlahaSmart";
        
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
    <nav aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index");
        yield "\">Boutique</a></li>
            <li class=\"breadcrumb-item active\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 10, $this->source); })()), "nom", [], "any", false, false, false, 10), "html", null, true);
        yield "</li>
        </ol>
    </nav>

    <div class=\"row\">
        <div class=\"col-md-5\">
            ";
        // line 16
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 16, $this->source); })()), "imageUrl", [], "any", false, false, false, 16)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 17
            yield "                <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 17, $this->source); })()), "imageUrl", [], "any", false, false, false, 17), "html", null, true);
            yield "\" class=\"img-fluid rounded shadow\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 17, $this->source); })()), "nom", [], "any", false, false, false, 17), "html", null, true);
            yield "\">
            ";
        } else {
            // line 19
            yield "                <div class=\"bg-light rounded d-flex align-items-center justify-content-center\" style=\"height: 300px;\">
                    🌿 <span class=\"text-muted\">Image non disponible</span>
                </div>
            ";
        }
        // line 23
        yield "        </div>
        <div class=\"col-md-7\">
            <h1>";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 25, $this->source); })()), "nom", [], "any", false, false, false, 25), "html", null, true);
        yield "</h1>
            <p class=\"lead\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 26, $this->source); })()), "description", [], "any", false, false, false, 26), "html", null, true);
        yield "</p>
            <hr>
            <div class=\"row mb-3\">
                <div class=\"col-6\">
                    <strong>💰 Prix :</strong> ";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 30, $this->source); })()), "prix", [], "any", false, false, false, 30), "html", null, true);
        yield " €
                </div>
                <div class=\"col-6\">
                    <strong>📦 Stock :</strong> ";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 33, $this->source); })()), "stock", [], "any", false, false, false, 33), "html", null, true);
        yield " unités
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>🏷️ Catégorie :</strong> ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 36, $this->source); })()), "categorie", [], "any", false, false, false, 36), "html", null, true);
        yield "
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>⚖️ Poids :</strong> ";
        // line 39
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "poids", [], "any", true, true, false, 39) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 39, $this->source); })()), "poids", [], "any", false, false, false, 39)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 39, $this->source); })()), "poids", [], "any", false, false, false, 39), "html", null, true)) : ("Non spécifié"));
        yield " ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "unite", [], "any", true, true, false, 39) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 39, $this->source); })()), "unite", [], "any", false, false, false, 39)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 39, $this->source); })()), "unite", [], "any", false, false, false, 39), "html", null, true)) : ("kg"));
        yield "
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>📅 Date d'ajout :</strong> ";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 42, $this->source); })()), "dateAjout", [], "any", false, false, false, 42), "d/m/Y"), "html", null, true);
        yield "
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>👤 Vendeur :</strong> ";
        // line 45
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 45, $this->source); })()), "idUser", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Agriculteur partenaire") : ("FlahaSmart"));
        yield "
                </div>
            </div>
            <hr>
            <form action=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart_add", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 49, $this->source); })()), "id", [], "any", false, false, false, 49)]), "html", null, true);
        yield "\" method=\"get\" class=\"d-flex gap-2\">
                <input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\" max=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 50, $this->source); })()), "stock", [], "any", false, false, false, 50), "html", null, true);
        yield "\" class=\"form-control w-25\">
                <button type=\"submit\" class=\"btn btn-success flex-grow-1\">🛒 Ajouter au panier</button>
            </form>
            <a href=\"";
        // line 53
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index");
        yield "\" class=\"btn btn-secondary mt-2\">← Retour à la boutique</a>
        </div>
    </div>

    <!-- QR Code section -->
    <div class=\"row mt-5\">
        <div class=\"col-12 text-center\">
            <div class=\"card\">
                <div class=\"card-header bg-white\">
                    <strong>📱 Partager cet article</strong>
                </div>
                <div class=\"card-body\">
                    ";
        // line 65
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 65, $this->source); })()), "qrCodeFilename", [], "any", false, false, false, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 66
            yield "                        <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/qrcodes/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 66, $this->source); })()), "qrCodeFilename", [], "any", false, false, false, 66))), "html", null, true);
            yield "\" alt=\"QR Code\" style=\"width: 180px;\">
                        <p class=\"mt-2\">Scannez ce QR code pour partager l'article facilement.</p>
                    ";
        } else {
            // line 69
            yield "                        <p class=\"text-muted\">QR code non disponible.</p>
                    ";
        }
        // line 71
        yield "                </div>
            </div>
        </div>
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
        return "shop/show.html.twig";
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
        return array (  227 => 71,  223 => 69,  216 => 66,  214 => 65,  199 => 53,  193 => 50,  189 => 49,  182 => 45,  176 => 42,  168 => 39,  162 => 36,  156 => 33,  150 => 30,  143 => 26,  139 => 25,  135 => 23,  129 => 19,  121 => 17,  119 => 16,  110 => 10,  106 => 9,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ article.nom }} - FlahaSmart{% endblock %}

{% block body %}
<div class=\"container\">
    <nav aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"{{ path('app_shop_index') }}\">Boutique</a></li>
            <li class=\"breadcrumb-item active\">{{ article.nom }}</li>
        </ol>
    </nav>

    <div class=\"row\">
        <div class=\"col-md-5\">
            {% if article.imageUrl %}
                <img src=\"{{ article.imageUrl }}\" class=\"img-fluid rounded shadow\" alt=\"{{ article.nom }}\">
            {% else %}
                <div class=\"bg-light rounded d-flex align-items-center justify-content-center\" style=\"height: 300px;\">
                    🌿 <span class=\"text-muted\">Image non disponible</span>
                </div>
            {% endif %}
        </div>
        <div class=\"col-md-7\">
            <h1>{{ article.nom }}</h1>
            <p class=\"lead\">{{ article.description }}</p>
            <hr>
            <div class=\"row mb-3\">
                <div class=\"col-6\">
                    <strong>💰 Prix :</strong> {{ article.prix }} €
                </div>
                <div class=\"col-6\">
                    <strong>📦 Stock :</strong> {{ article.stock }} unités
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>🏷️ Catégorie :</strong> {{ article.categorie }}
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>⚖️ Poids :</strong> {{ article.poids ?? 'Non spécifié' }} {{ article.unite ?? 'kg' }}
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>📅 Date d'ajout :</strong> {{ article.dateAjout|date('d/m/Y') }}
                </div>
                <div class=\"col-6 mt-2\">
                    <strong>👤 Vendeur :</strong> {{ article.idUser ? 'Agriculteur partenaire' : 'FlahaSmart' }}
                </div>
            </div>
            <hr>
            <form action=\"{{ path('app_cart_add', {id: article.id}) }}\" method=\"get\" class=\"d-flex gap-2\">
                <input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\" max=\"{{ article.stock }}\" class=\"form-control w-25\">
                <button type=\"submit\" class=\"btn btn-success flex-grow-1\">🛒 Ajouter au panier</button>
            </form>
            <a href=\"{{ path('app_shop_index') }}\" class=\"btn btn-secondary mt-2\">← Retour à la boutique</a>
        </div>
    </div>

    <!-- QR Code section -->
    <div class=\"row mt-5\">
        <div class=\"col-12 text-center\">
            <div class=\"card\">
                <div class=\"card-header bg-white\">
                    <strong>📱 Partager cet article</strong>
                </div>
                <div class=\"card-body\">
                    {% if article.qrCodeFilename %}
                        <img src=\"{{ asset('uploads/qrcodes/' ~ article.qrCodeFilename) }}\" alt=\"QR Code\" style=\"width: 180px;\">
                        <p class=\"mt-2\">Scannez ce QR code pour partager l'article facilement.</p>
                    {% else %}
                        <p class=\"text-muted\">QR code non disponible.</p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "shop/show.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\shop\\show.html.twig");
    }
}
