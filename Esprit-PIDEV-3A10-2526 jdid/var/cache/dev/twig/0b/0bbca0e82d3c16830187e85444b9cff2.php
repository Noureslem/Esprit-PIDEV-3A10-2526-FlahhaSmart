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

/* front/client/index.html.twig */
class __TwigTemplate_e1543b53978c242f0377d9d28be9016a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/client/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/client/index.html.twig"));

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

        yield "Boutique des Produits";
        
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
        yield "    <div class=\"text-center mb-5 mt-3\">
        <h1 class=\"text-success fw-bold display-5\"><i class=\"fa-solid fa-store me-3\"></i>Nos Produits Récoltés</h1>
        <p class=\"text-muted fs-5\">Parcourez notre catalogue et découvrez nos variétés exclusives directement des producteurs.</p>
    </div>

    <div class=\"row justify-content-center mb-5\">
        <div class=\"col-md-8 col-lg-6\">
            <div class=\"input-group input-group-lg shadow-sm\" style=\"border-radius: 50px; overflow:hidden;\">
                <span class=\"input-group-text bg-white border-0 text-success px-4\"><i class=\"fa-solid fa-search\"></i></span>
                <input type=\"text\" class=\"form-control border-0 js-search-input\" placeholder=\"Rechercher une variété, un produit...\">
            </div>
        </div>
    </div>

    <div class=\"row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4 mb-5\">
        ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stocks"]) || array_key_exists("stocks", $context) ? $context["stocks"] : (function () { throw new RuntimeError('Variable "stocks" does not exist.', 19, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["stock"]) {
            // line 20
            yield "            <div class=\"col js-filterable-card\">
                <div class=\"card h-100 border-0 shadow-sm custom-hover-card\" style=\"border-radius: 16px; transition: transform 0.3s, box-shadow 0.3s;\">
                    <div class=\"card-body text-center p-4\">
                        <div class=\"mb-3\">
                            <span class=\"badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success border-opacity-25\">
                                ";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "statut", [], "any", true, true, false, 25)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "statut", [], "any", false, false, false, 25), "standard")) : ("standard"))), "html", null, true);
            yield "
                            </span>
                        </div>
                        <div class=\"display-1 text-success mb-3 opacity-25\">
                            <i class=\"fa-brands fa-pagelines\"></i>
                        </div>
                        <h3 class=\"card-title fw-bold text-dark mb-1\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "typeProduit", [], "any", true, true, false, 31)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "typeProduit", [], "any", false, false, false, 31), "?")) : ("?")), "html", null, true);
            yield "</h3>
                        <h6 class=\"text-muted mb-3\">";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "variete", [], "any", true, true, false, 32)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "variete", [], "any", false, false, false, 32), "Variété inconnue")) : ("Variété inconnue")), "html", null, true);
            yield "</h6>
                        <hr class=\"w-50 mx-auto text-success opacity-25\">
                        <p class=\"small text-secondary mb-0\">
                            <strong><i class=\"fa-solid fa-hat-cowboy me-1\"></i> Producteur :</strong><br>
                            ";
            // line 36
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 36), "nom", [], "any", false, false, false, 36) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 36), "prenom", [], "any", false, false, false, 36)), "html", null, true)) : ("Coopérative"));
            yield "
                        </p>
                    </div>
                    <div class=\"card-footer bg-transparent border-0 pb-4 text-center\">
                        <a href=\"";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("client_produit_show", ["idProduit" => CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 40)]), "html", null, true);
            yield "\" class=\"btn btn-success rounded-pill px-4 shadow-sm w-75\">
                            Voir Détails <i class=\"fa-solid fa-arrow-right ms-1\"></i>
                        </a>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 46
        if (!$context['_iterated']) {
            // line 47
            yield "            <div class=\"col-12 text-center py-5\">
                <i class=\"fa-solid fa-basket-shopping text-muted fa-4x mb-3 opacity-25\"></i>
                <h4 class=\"text-muted\">La vitrine est actuellement vide.</h4>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['stock'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        yield "    </div>

    <style>
        .custom-hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15) !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.js-search-input');
            const cards = document.querySelectorAll('.js-filterable-card');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        card.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }
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
        return "front/client/index.html.twig";
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
        return array (  179 => 52,  169 => 47,  167 => 46,  156 => 40,  149 => 36,  142 => 32,  138 => 31,  129 => 25,  122 => 20,  117 => 19,  100 => 4,  87 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Boutique des Produits{% endblock %}
{% block body %}
    <div class=\"text-center mb-5 mt-3\">
        <h1 class=\"text-success fw-bold display-5\"><i class=\"fa-solid fa-store me-3\"></i>Nos Produits Récoltés</h1>
        <p class=\"text-muted fs-5\">Parcourez notre catalogue et découvrez nos variétés exclusives directement des producteurs.</p>
    </div>

    <div class=\"row justify-content-center mb-5\">
        <div class=\"col-md-8 col-lg-6\">
            <div class=\"input-group input-group-lg shadow-sm\" style=\"border-radius: 50px; overflow:hidden;\">
                <span class=\"input-group-text bg-white border-0 text-success px-4\"><i class=\"fa-solid fa-search\"></i></span>
                <input type=\"text\" class=\"form-control border-0 js-search-input\" placeholder=\"Rechercher une variété, un produit...\">
            </div>
        </div>
    </div>

    <div class=\"row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4 mb-5\">
        {% for stock in stocks %}
            <div class=\"col js-filterable-card\">
                <div class=\"card h-100 border-0 shadow-sm custom-hover-card\" style=\"border-radius: 16px; transition: transform 0.3s, box-shadow 0.3s;\">
                    <div class=\"card-body text-center p-4\">
                        <div class=\"mb-3\">
                            <span class=\"badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success border-opacity-25\">
                                {{ stock.statut|default('standard')|capitalize }}
                            </span>
                        </div>
                        <div class=\"display-1 text-success mb-3 opacity-25\">
                            <i class=\"fa-brands fa-pagelines\"></i>
                        </div>
                        <h3 class=\"card-title fw-bold text-dark mb-1\">{{ stock.typeProduit|default('?') }}</h3>
                        <h6 class=\"text-muted mb-3\">{{ stock.variete|default('Variété inconnue') }}</h6>
                        <hr class=\"w-50 mx-auto text-success opacity-25\">
                        <p class=\"small text-secondary mb-0\">
                            <strong><i class=\"fa-solid fa-hat-cowboy me-1\"></i> Producteur :</strong><br>
                            {{ stock.user ? stock.user.nom ~ ' ' ~ stock.user.prenom : 'Coopérative' }}
                        </p>
                    </div>
                    <div class=\"card-footer bg-transparent border-0 pb-4 text-center\">
                        <a href=\"{{ path('client_produit_show', {'idProduit': stock.idProduit}) }}\" class=\"btn btn-success rounded-pill px-4 shadow-sm w-75\">
                            Voir Détails <i class=\"fa-solid fa-arrow-right ms-1\"></i>
                        </a>
                    </div>
                </div>
            </div>
        {% else %}
            <div class=\"col-12 text-center py-5\">
                <i class=\"fa-solid fa-basket-shopping text-muted fa-4x mb-3 opacity-25\"></i>
                <h4 class=\"text-muted\">La vitrine est actuellement vide.</h4>
            </div>
        {% endfor %}
    </div>

    <style>
        .custom-hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15) !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.js-search-input');
            const cards = document.querySelectorAll('.js-filterable-card');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        card.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }
        });
    </script>
{% endblock %}", "front/client/index.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\front\\client\\index.html.twig");
    }
}
