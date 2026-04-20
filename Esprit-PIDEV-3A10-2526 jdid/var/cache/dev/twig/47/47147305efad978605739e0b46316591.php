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

/* back_admin/produit/consommation/index.html.twig */
class __TwigTemplate_1b8a3bcea32f5f18f38ca06147805593 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_admin/produit/consommation/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_admin/produit/consommation/index.html.twig"));

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

        yield "Consommations - Admin";
        
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
        yield "    <h3 class=\"text-dark fw-bold mb-4\" style=\"font-size: 1.5rem;\">Liste des consommations</h3>

        <div class=\"row mb-3 align-items-center\">
        <div class=\"col-md-5\">
            <div class=\"input-group input-group-sm shadow-sm\">
                <span class=\"input-group-text bg-white border-end-0 text-success\"><i class=\"fa-solid fa-magnifying-glass\"></i></span>
                <input type=\"text\" class=\"form-control border-start-0 ps-0 js-search-input\" placeholder=\"Rechercher...\" style=\"font-size: 0.85rem;\">
            </div>
        </div>
        <div class=\"col-md-4 mt-2 mt-md-0\">
            <div class=\"input-group input-group-sm shadow-sm\">
                <span class=\"input-group-text bg-white border-end-0 text-success\"><i class=\"fa-solid fa-filter\"></i></span>
                <select class=\"form-select border-start-0 js-sort-select\" style=\"font-size: 0.85rem;\">
                    <option value=\"default\">Trier par défaut (ID)</option>
                    <option value=\"name_asc\">Nom (A-Z)</option>
                    <option value=\"name_desc\">Nom (Z-A)</option>
                </select>
                <button class=\"btn btn-success\" style=\"font-size: 0.85rem;\">Appliquer</button>
            </div>
        </div>
        <div class=\"col-md-3 mt-2 mt-md-0 text-md-end\">
            <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_consommation_new");
        yield "\" class=\"btn btn-success btn-sm shadow-sm fw-bold\"><i class=\"fa-solid fa-plus me-1\"></i> Nouvelle conso</a>
        </div>
    </div>

    <div class=\"table-responsive bg-white rounded shadow-sm border\">
        <table class=\"table table-hover table-custom mb-0\">
            <thead>
                <tr>
                    <th scope=\"col\">ID</th>
                    <th scope=\"col\">Produit Lié</th>
                    <th scope=\"col\">Surface</th>
                    <th scope=\"col\">Qté Utilisée</th>
                    <th scope=\"col\">Unité</th>
                    <th scope=\"col\">Date Récolte</th>
                    <th scope=\"col\">Date Utilisation</th>
                    <th scope=\"col\" class=\"text-end\">Actions</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["consommations"]) || array_key_exists("consommations", $context) ? $context["consommations"] : (function () { throw new RuntimeError('Variable "consommations" does not exist.', 44, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["conso"]) {
            // line 45
            yield "                <tr class=\"js-filterable-row\">
                    <td class=\"fw-bold\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "idProduit", [], "any", false, false, false, 46), "html", null, true);
            yield "</td>
                    <td><span class=\"text-success fw-bold\">";
            // line 47
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "stockProduit", [], "any", false, false, false, 47)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "stockProduit", [], "any", false, false, false, 47), "typeProduit", [], "any", false, false, false, 47), "html", null, true)) : ("--"));
            yield "</span></td>
                    <td>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "surface", [], "any", false, false, false, 48), "html", null, true);
            yield "</td>
                    <td>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "quantiteUtilisee", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                    <td>";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "unite", [], "any", false, false, false, 50), "html", null, true);
            yield "</td>
                    <td>";
            // line 51
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateRecolte", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateRecolte", [], "any", false, false, false, 51), "d/m/Y"), "html", null, true)) : ("--"));
            yield "</td>
                    <td>";
            // line 52
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateUtilisation", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "dateUtilisation", [], "any", false, false, false, 52), "d/m/Y"), "html", null, true)) : ("--"));
            yield "</td>
                    <td class=\"text-end\">
                        <div class=\"d-flex justify-content-end gap-1\">
                            <a href=\"";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_consommation_edit", ["idProduit" => CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "idProduit", [], "any", false, false, false, 55)]), "html", null, true);
            yield "\" class=\"btn btn-outline-primary btn-action\">Modifier</a>
                            <form method=\"post\" action=\"";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_consommation_delete", ["idProduit" => CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "idProduit", [], "any", false, false, false, 56)]), "html", null, true);
            yield "\" onsubmit=\"return confirm('Confirmer la suppression ?');\" style=\"display:inline-block; margin:0;\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["conso"], "idProduit", [], "any", false, false, false, 57))), "html", null, true);
            yield "\">
                                <button class=\"btn btn-outline-danger btn-action\">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 63
        if (!$context['_iterated']) {
            // line 64
            yield "                <tr>
                    <td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucune consommation enregistrée.</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['conso'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "            </tbody>
        </table>
    </div>

    <style>
        .table-custom th {
            background-color: #eaf3ed !important;
            color: #198754;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #198754;
        }
        .table-custom td {
            font-size: 0.85rem;
            color: #444;
            vertical-align: middle;
        }
        .btn-action {
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.js-search-input');
            const rows = document.querySelectorAll('.js-filterable-row');
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
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
        return "back_admin/produit/consommation/index.html.twig";
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
        return array (  213 => 68,  204 => 64,  202 => 63,  191 => 57,  187 => 56,  183 => 55,  177 => 52,  173 => 51,  169 => 50,  165 => 49,  161 => 48,  157 => 47,  153 => 46,  150 => 45,  145 => 44,  123 => 25,  100 => 4,  87 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Consommations - Admin{% endblock %}
{% block body %}
    <h3 class=\"text-dark fw-bold mb-4\" style=\"font-size: 1.5rem;\">Liste des consommations</h3>

        <div class=\"row mb-3 align-items-center\">
        <div class=\"col-md-5\">
            <div class=\"input-group input-group-sm shadow-sm\">
                <span class=\"input-group-text bg-white border-end-0 text-success\"><i class=\"fa-solid fa-magnifying-glass\"></i></span>
                <input type=\"text\" class=\"form-control border-start-0 ps-0 js-search-input\" placeholder=\"Rechercher...\" style=\"font-size: 0.85rem;\">
            </div>
        </div>
        <div class=\"col-md-4 mt-2 mt-md-0\">
            <div class=\"input-group input-group-sm shadow-sm\">
                <span class=\"input-group-text bg-white border-end-0 text-success\"><i class=\"fa-solid fa-filter\"></i></span>
                <select class=\"form-select border-start-0 js-sort-select\" style=\"font-size: 0.85rem;\">
                    <option value=\"default\">Trier par défaut (ID)</option>
                    <option value=\"name_asc\">Nom (A-Z)</option>
                    <option value=\"name_desc\">Nom (Z-A)</option>
                </select>
                <button class=\"btn btn-success\" style=\"font-size: 0.85rem;\">Appliquer</button>
            </div>
        </div>
        <div class=\"col-md-3 mt-2 mt-md-0 text-md-end\">
            <a href=\"{{ path('admin_consommation_new') }}\" class=\"btn btn-success btn-sm shadow-sm fw-bold\"><i class=\"fa-solid fa-plus me-1\"></i> Nouvelle conso</a>
        </div>
    </div>

    <div class=\"table-responsive bg-white rounded shadow-sm border\">
        <table class=\"table table-hover table-custom mb-0\">
            <thead>
                <tr>
                    <th scope=\"col\">ID</th>
                    <th scope=\"col\">Produit Lié</th>
                    <th scope=\"col\">Surface</th>
                    <th scope=\"col\">Qté Utilisée</th>
                    <th scope=\"col\">Unité</th>
                    <th scope=\"col\">Date Récolte</th>
                    <th scope=\"col\">Date Utilisation</th>
                    <th scope=\"col\" class=\"text-end\">Actions</th>
                </tr>
            </thead>
            <tbody>
            {% for conso in consommations %}
                <tr class=\"js-filterable-row\">
                    <td class=\"fw-bold\">{{ conso.idProduit }}</td>
                    <td><span class=\"text-success fw-bold\">{{ conso.stockProduit ? conso.stockProduit.typeProduit : '--' }}</span></td>
                    <td>{{ conso.surface }}</td>
                    <td>{{ conso.quantiteUtilisee }}</td>
                    <td>{{ conso.unite }}</td>
                    <td>{{ conso.dateRecolte ? conso.dateRecolte|date('d/m/Y') : '--' }}</td>
                    <td>{{ conso.dateUtilisation ? conso.dateUtilisation|date('d/m/Y') : '--' }}</td>
                    <td class=\"text-end\">
                        <div class=\"d-flex justify-content-end gap-1\">
                            <a href=\"{{ path('admin_consommation_edit', {'idProduit': conso.idProduit}) }}\" class=\"btn btn-outline-primary btn-action\">Modifier</a>
                            <form method=\"post\" action=\"{{ path('admin_consommation_delete', {'idProduit': conso.idProduit}) }}\" onsubmit=\"return confirm('Confirmer la suppression ?');\" style=\"display:inline-block; margin:0;\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ conso.idProduit) }}\">
                                <button class=\"btn btn-outline-danger btn-action\">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucune consommation enregistrée.</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>

    <style>
        .table-custom th {
            background-color: #eaf3ed !important;
            color: #198754;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #198754;
        }
        .table-custom td {
            font-size: 0.85rem;
            color: #444;
            vertical-align: middle;
        }
        .btn-action {
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.js-search-input');
            const rows = document.querySelectorAll('.js-filterable-row');
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }
        });
    </script>
{% endblock %}", "back_admin/produit/consommation/index.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\back_admin\\produit\\consommation\\index.html.twig");
    }
}
