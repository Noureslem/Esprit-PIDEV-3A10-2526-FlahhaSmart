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

/* front/client/details.html.twig */
class __TwigTemplate_edbb4a4bac227f04055fac32444d3985 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/client/details.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/client/details.html.twig"));

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

        yield "Détail du produit - ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stock"] ?? null), "typeProduit", [], "any", true, true, false, 2)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 2, $this->source); })()), "typeProduit", [], "any", false, false, false, 2), "Produit")) : ("Produit")), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 3
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

        // line 4
        yield "    <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("client_produit_index");
        yield "\" class=\"text-success fw-bold text-decoration-none d-inline-block mb-4\">
        <i class=\"fa-solid fa-arrow-left me-2\"></i>Retour aux produits
    </a>

    <div class=\"beautiful-card\">
        <div class=\"d-flex justify-content-between align-items-start flex-wrap gap-3\">
            <span class=\"badge bg-success px-3 py-2 rounded-pill fs-6\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["stock"] ?? null), "statut", [], "any", true, true, false, 10)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 10, $this->source); })()), "statut", [], "any", false, false, false, 10), "disponible")) : ("disponible"))), "html", null, true);
        yield "</span>
            ";
        // line 11
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 11, $this->source); })()), "user", [], "any", false, false, false, 11)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 12
            yield "                <small class=\"text-muted\"><i class=\"fa-regular fa-user me-1\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 12, $this->source); })()), "user", [], "any", false, false, false, 12), "nom", [], "any", false, false, false, 12) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 12, $this->source); })()), "user", [], "any", false, false, false, 12), "prenom", [], "any", false, false, false, 12)), "html", null, true);
            yield "</small>
            ";
        }
        // line 14
        yield "        </div>

        <h2 class=\"mt-3 fw-bold text-dark\">";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stock"] ?? null), "typeProduit", [], "any", true, true, false, 16)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 16, $this->source); })()), "typeProduit", [], "any", false, false, false, 16), "?")) : ("?")), "html", null, true);
        yield " - ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stock"] ?? null), "variete", [], "any", true, true, false, 16)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 16, $this->source); })()), "variete", [], "any", false, false, false, 16), "")) : ("")), "html", null, true);
        yield "</h2>
        
        <div class=\"row mt-4\">
            <div class=\"col-md-6\">
                <p><strong><i class=\"fa-regular fa-calendar-alt me-2 text-success\"></i> Date début :</strong><br>
                ";
        // line 21
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 21, $this->source); })()), "dateDebut", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 21, $this->source); })()), "dateDebut", [], "any", false, false, false, 21), "d F Y"), "html", null, true)) : ("Non renseignée"));
        yield "</p>
            </div>
            <div class=\"col-md-6\">
                <p><strong><i class=\"fa-solid fa-tractor me-2 text-success\"></i> Producteur :</strong><br>
                ";
        // line 25
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 25, $this->source); })()), "user", [], "any", false, false, false, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 25, $this->source); })()), "user", [], "any", false, false, false, 25), "nom", [], "any", false, false, false, 25) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["stock"]) || array_key_exists("stock", $context) ? $context["stock"] : (function () { throw new RuntimeError('Variable "stock" does not exist.', 25, $this->source); })()), "user", [], "any", false, false, false, 25), "prenom", [], "any", false, false, false, 25)), "html", null, true)) : ("Coopérative agricole"));
        yield "</p>
            </div>
        </div>
        
        <hr class=\"my-4\">
        
        <h3 class=\"h4 text-success fw-semibold\"><i class=\"fa-solid fa-chart-line me-2\"></i>Historique de Consommation</h3>
        
        ";
        // line 33
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["consommations"]) || array_key_exists("consommations", $context) ? $context["consommations"] : (function () { throw new RuntimeError('Variable "consommations" does not exist.', 33, $this->source); })())) > 0)) {
            // line 34
            yield "            <div class=\"list-group mt-3\">
                ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["consommations"]) || array_key_exists("consommations", $context) ? $context["consommations"] : (function () { throw new RuntimeError('Variable "consommations" does not exist.', 35, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["conso"]) {
                // line 36
                yield "                    <div class=\"list-group-item list-group-item-action border-start border-4 border-success rounded-3 mb-2 shadow-sm\">
                        <div class=\"d-flex flex-wrap justify-content-between align-items-center\">
                            <div>
                                <strong class=\"text-success\">";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "unite", [], "any", true, true, false, 39)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "unite", [], "any", false, false, false, 39), "unité")) : ("unité")), "html", null, true);
                yield "</strong>
                                <span class=\"badge bg-light text-dark ms-2\">";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "surface", [], "any", true, true, false, 40)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "surface", [], "any", false, false, false, 40), 0)) : (0)), "html", null, true);
                yield " m²</span>
                            </div>
                            <div>
                                <i class=\"fa-solid fa-weight-hanging me-1 text-secondary\"></i>
                                Quantité utilisée : <strong>";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "quantiteUtilisee", [], "any", true, true, false, 44)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "quantiteUtilisee", [], "any", false, false, false, 44), 0)) : (0)), "html", null, true);
                yield "</strong>
                            </div>
                            <div class=\"text-muted small\">
                                <i class=\"fa-regular fa-calendar me-1\"></i>
                                Récolté le : ";
                // line 48
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateRecolte", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateRecolte", [], "any", false, false, false, 48), "d/m/Y"), "html", null, true)) : ("—"));
                yield "
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['conso'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            yield "            </div>
        ";
        } else {
            // line 55
            yield "            <div class=\"alert alert-light border rounded-3 mt-3 text-center text-muted py-4\">
                <i class=\"fa-regular fa-clock fa-2x mb-2 opacity-50\"></i>
                <p class=\"mb-0\">Aucune consommation enregistrée pour ce produit.</p>
            </div>
        ";
        }
        // line 60
        yield "    </div>
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
        return "front/client/details.html.twig";
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
        return array (  209 => 60,  202 => 55,  198 => 53,  187 => 48,  180 => 44,  173 => 40,  169 => 39,  164 => 36,  160 => 35,  157 => 34,  155 => 33,  144 => 25,  137 => 21,  127 => 16,  123 => 14,  117 => 12,  115 => 11,  111 => 10,  101 => 4,  88 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Détail du produit - {{ stock.typeProduit|default('Produit') }}{% endblock %}
{% block body %}
    <a href=\"{{ path('client_produit_index') }}\" class=\"text-success fw-bold text-decoration-none d-inline-block mb-4\">
        <i class=\"fa-solid fa-arrow-left me-2\"></i>Retour aux produits
    </a>

    <div class=\"beautiful-card\">
        <div class=\"d-flex justify-content-between align-items-start flex-wrap gap-3\">
            <span class=\"badge bg-success px-3 py-2 rounded-pill fs-6\">{{ stock.statut|default('disponible')|capitalize }}</span>
            {% if stock.user %}
                <small class=\"text-muted\"><i class=\"fa-regular fa-user me-1\"></i> {{ stock.user.nom ~ ' ' ~ stock.user.prenom }}</small>
            {% endif %}
        </div>

        <h2 class=\"mt-3 fw-bold text-dark\">{{ stock.typeProduit|default('?') }} - {{ stock.variete|default('') }}</h2>
        
        <div class=\"row mt-4\">
            <div class=\"col-md-6\">
                <p><strong><i class=\"fa-regular fa-calendar-alt me-2 text-success\"></i> Date début :</strong><br>
                {{ stock.dateDebut ? stock.dateDebut|date('d F Y') : 'Non renseignée' }}</p>
            </div>
            <div class=\"col-md-6\">
                <p><strong><i class=\"fa-solid fa-tractor me-2 text-success\"></i> Producteur :</strong><br>
                {{ stock.user ? stock.user.nom ~ ' ' ~ stock.user.prenom : 'Coopérative agricole' }}</p>
            </div>
        </div>
        
        <hr class=\"my-4\">
        
        <h3 class=\"h4 text-success fw-semibold\"><i class=\"fa-solid fa-chart-line me-2\"></i>Historique de Consommation</h3>
        
        {% if consommations|length > 0 %}
            <div class=\"list-group mt-3\">
                {% for conso in consommations %}
                    <div class=\"list-group-item list-group-item-action border-start border-4 border-success rounded-3 mb-2 shadow-sm\">
                        <div class=\"d-flex flex-wrap justify-content-between align-items-center\">
                            <div>
                                <strong class=\"text-success\">{{ conso.unite|default('unité') }}</strong>
                                <span class=\"badge bg-light text-dark ms-2\">{{ conso.surface|default(0) }} m²</span>
                            </div>
                            <div>
                                <i class=\"fa-solid fa-weight-hanging me-1 text-secondary\"></i>
                                Quantité utilisée : <strong>{{ conso.quantiteUtilisee|default(0) }}</strong>
                            </div>
                            <div class=\"text-muted small\">
                                <i class=\"fa-regular fa-calendar me-1\"></i>
                                Récolté le : {{ conso.dateRecolte ? conso.dateRecolte|date('d/m/Y') : '—' }}
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% else %}
            <div class=\"alert alert-light border rounded-3 mt-3 text-center text-muted py-4\">
                <i class=\"fa-regular fa-clock fa-2x mb-2 opacity-50\"></i>
                <p class=\"mb-0\">Aucune consommation enregistrée pour ce produit.</p>
            </div>
        {% endif %}
    </div>
{% endblock %}", "front/client/details.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\front\\client\\details.html.twig");
    }
}
