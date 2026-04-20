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

/* back_agriculteur/produit/stock/index.html.twig */
class __TwigTemplate_efd32c2ff2027f8722d2922c05b68ae1 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_agriculteur/produit/stock/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_agriculteur/produit/stock/index.html.twig"));

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

        yield "Stocks - Agriculteur";
        
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
        yield "    <h3 class=\"text-dark fw-bold mb-4\" style=\"font-size: 1.5rem;\">Liste des stocks</h3>

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
            </div>
        </div>
        <div class=\"col-md-3 mt-2 mt-md-0 text-md-end\">
            <a href=\"";
        // line 24
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("agriculteur_stock_new");
        yield "\" class=\"btn btn-success btn-sm shadow-sm fw-bold\"><i class=\"fa-solid fa-plus me-1\"></i> Nouveau stock</a>
        </div>
    </div>

    <div class=\"table-responsive bg-white rounded shadow-sm border\">
        <table class=\"table table-hover table-custom mb-0\">
            <thead>
                <tr>
                    <th scope=\"col\">ID</th>
                    <th scope=\"col\">Type de Produit</th>
                    <th scope=\"col\">Variété</th>
                    <th scope=\"col\">Date début</th>
                    <th scope=\"col\">Date fin est.</th>
                    <th scope=\"col\">Agriculteur</th>
                    <th scope=\"col\">Statut</th>
                    <th scope=\"col\" class=\"text-end\">Actions</th>
                </tr>
            </thead>
            <tbody id=\"stock-table-body\">
            ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stocks"]) || array_key_exists("stocks", $context) ? $context["stocks"] : (function () { throw new RuntimeError('Variable "stocks" does not exist.', 43, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["stock"]) {
            // line 44
            yield "                <tr class=\"js-filterable-row\" data-id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 44), "html", null, true);
            yield "\" data-name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "typeProduit", [], "any", false, false, false, 44), "html", null, true);
            yield "\" data-variete=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "variete", [], "any", false, false, false, 44), "html", null, true);
            yield "\" data-agriculteur=\"";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 44), "nom", [], "any", false, false, false, 44), "html", null, true)) : (""));
            yield "\">
                    <td class=\"fw-bold\">";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 45), "html", null, true);
            yield "</td>
                    <td class=\"type-produit\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "typeProduit", [], "any", false, false, false, 46), "html", null, true);
            yield "</td>
                    <td class=\"variete\">";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "variete", [], "any", false, false, false, 47), "html", null, true);
            yield "</td>
                    <td class=\"date-debut\">";
            // line 48
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "dateDebut", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "dateDebut", [], "any", false, false, false, 48), "d/m/Y"), "html", null, true)) : ("--"));
            yield "</td>
                    <td class=\"date-fin\">";
            // line 49
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "dateFinEstimee", [], "any", false, false, false, 49)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "dateFinEstimee", [], "any", false, false, false, 49), "d/m/Y"), "html", null, true)) : ("--"));
            yield "</td>
                    <td class=\"agriculteur\">";
            // line 50
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "user", [], "any", false, false, false, 50), "nom", [], "any", false, false, false, 50), "html", null, true)) : ("--"));
            yield "</td>
                    <td class=\"statut\">
                        <span class=\"badge ";
            // line 52
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "statut", [], "any", false, false, false, 52) == "en cours")) {
                yield "bg-primary";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "statut", [], "any", false, false, false, 52) == "terminé")) {
                yield "bg-success";
            } else {
                yield "bg-secondary";
            }
            yield "\" style=\"font-size: 0.70rem;\">
                            ";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "statut", [], "any", false, false, false, 53)), "html", null, true);
            yield "
                        </span>
                    </td>
                    <td class=\"text-end\">
                        <div class=\"d-flex justify-content-end gap-1\">
                            <a href=\"";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("agriculteur_stock_edit", ["idProduit" => CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 58)]), "html", null, true);
            yield "\" class=\"btn btn-outline-primary btn-action\">Modifier</a>
                            <form method=\"post\" action=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("agriculteur_stock_delete", ["idProduit" => CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 59)]), "html", null, true);
            yield "\" onsubmit=\"return confirm('Supprimer ce stock définitivement ?');\" style=\"display:inline-block; margin:0;\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["stock"], "idProduit", [], "any", false, false, false, 60))), "html", null, true);
            yield "\">
                                <button class=\"btn btn-outline-danger btn-action\">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 66
        if (!$context['_iterated']) {
            // line 67
            yield "                <tr class=\"no-data-row\">
                    <td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucun stock trouvé.</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['stock'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
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
            const sortSelect = document.querySelector('.js-sort-select');
            const tbody = document.getElementById('stock-table-body');
            
            // Stocker toutes les lignes originales au chargement
            let allRows = [];
            const originalRows = Array.from(document.querySelectorAll('.js-filterable-row'));
            
            // Sauvegarder les lignes originales
            originalRows.forEach(row => {
                allRows.push(row.cloneNode(true));
            });
            
            // Si aucune donnée, on garde le message
            if (originalRows.length === 0) {
                return;
            }
            
            // Fonction pour obtenir la valeur de tri selon le type
            function getSortValue(row, sortType) {
                switch(sortType) {
                    case 'name_asc':
                    case 'name_desc':
                        const typeProduit = row.querySelector('.type-produit');
                        return typeProduit ? typeProduit.textContent.toLowerCase() : '';
                    default: // 'default' - tri par ID
                        const idCell = row.querySelector('.fw-bold');
                        return idCell ? parseInt(idCell.textContent) || 0 : 0;
                }
            }
            
            // Fonction pour vérifier si une ligne correspond à la recherche
            function matchesSearch(row, searchTerm) {
                if (!searchTerm) return true;
                const text = row.textContent.toLowerCase();
                return text.includes(searchTerm);
            }
            
            // Fonction pour trier les lignes
            function sortRows(rows, sortType) {
                const sortedRows = [...rows];
                
                sortedRows.sort((a, b) => {
                    let valueA = getSortValue(a, sortType);
                    let valueB = getSortValue(b, sortType);
                    
                    if (sortType === 'name_asc') {
                        return valueA.localeCompare(valueB);
                    } else if (sortType === 'name_desc') {
                        return valueB.localeCompare(valueA);
                    } else { // 'default' - tri par ID
                        return valueA - valueB;
                    }
                });
                
                return sortedRows;
            }
            
            // Fonction pour mettre à jour l'affichage
            function updateDisplay() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
                const sortType = sortSelect ? sortSelect.value : 'default';
                
                // 1. Filtrer les lignes (toujours à partir des originales)
                let filteredRows = allRows.filter(row => matchesSearch(row, searchTerm));
                
                // 2. Trier les lignes filtrées
                const sortedRows = sortRows(filteredRows, sortType);
                
                // 3. Vider le tbody
                tbody.innerHTML = '';
                
                // 4. Ajouter les lignes triées
                if (sortedRows.length === 0) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.className = 'no-data-row';
                    emptyRow.innerHTML = '<td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucun stock trouvé.</td>';
                    tbody.appendChild(emptyRow);
                } else {
                    sortedRows.forEach(row => {
                        tbody.appendChild(row.cloneNode(true));
                    });
                    
                    // Réattacher les événements de confirmation pour les formulaires de suppression
                    document.querySelectorAll('#stock-table-body form').forEach(form => {
                        form.onsubmit = function() {
                            return confirm('Supprimer ce stock définitivement ?');
                        };
                    });
                }
            }
            
            // Événements
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    updateDisplay();
                });
            }
            
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    updateDisplay();
                });
            }
            
            // Initialisation
            updateDisplay();
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
        return "back_agriculteur/produit/stock/index.html.twig";
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
        return array (  233 => 71,  224 => 67,  222 => 66,  211 => 60,  207 => 59,  203 => 58,  195 => 53,  185 => 52,  180 => 50,  176 => 49,  172 => 48,  168 => 47,  164 => 46,  160 => 45,  149 => 44,  144 => 43,  122 => 24,  100 => 4,  87 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Stocks - Agriculteur{% endblock %}
{% block body %}
    <h3 class=\"text-dark fw-bold mb-4\" style=\"font-size: 1.5rem;\">Liste des stocks</h3>

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
            </div>
        </div>
        <div class=\"col-md-3 mt-2 mt-md-0 text-md-end\">
            <a href=\"{{ path('agriculteur_stock_new') }}\" class=\"btn btn-success btn-sm shadow-sm fw-bold\"><i class=\"fa-solid fa-plus me-1\"></i> Nouveau stock</a>
        </div>
    </div>

    <div class=\"table-responsive bg-white rounded shadow-sm border\">
        <table class=\"table table-hover table-custom mb-0\">
            <thead>
                <tr>
                    <th scope=\"col\">ID</th>
                    <th scope=\"col\">Type de Produit</th>
                    <th scope=\"col\">Variété</th>
                    <th scope=\"col\">Date début</th>
                    <th scope=\"col\">Date fin est.</th>
                    <th scope=\"col\">Agriculteur</th>
                    <th scope=\"col\">Statut</th>
                    <th scope=\"col\" class=\"text-end\">Actions</th>
                </tr>
            </thead>
            <tbody id=\"stock-table-body\">
            {% for stock in stocks %}
                <tr class=\"js-filterable-row\" data-id=\"{{ stock.idProduit }}\" data-name=\"{{ stock.typeProduit }}\" data-variete=\"{{ stock.variete }}\" data-agriculteur=\"{{ stock.user ? stock.user.nom : '' }}\">
                    <td class=\"fw-bold\">{{ stock.idProduit }}</td>
                    <td class=\"type-produit\">{{ stock.typeProduit }}</td>
                    <td class=\"variete\">{{ stock.variete }}</td>
                    <td class=\"date-debut\">{{ stock.dateDebut ? stock.dateDebut|date('d/m/Y') : '--' }}</td>
                    <td class=\"date-fin\">{{ stock.dateFinEstimee ? stock.dateFinEstimee|date('d/m/Y') : '--' }}</td>
                    <td class=\"agriculteur\">{{ stock.user ? stock.user.nom : '--' }}</td>
                    <td class=\"statut\">
                        <span class=\"badge {% if stock.statut == 'en cours' %}bg-primary{% elseif stock.statut == 'terminé' %}bg-success{% else %}bg-secondary{% endif %}\" style=\"font-size: 0.70rem;\">
                            {{ stock.statut|capitalize }}
                        </span>
                    </td>
                    <td class=\"text-end\">
                        <div class=\"d-flex justify-content-end gap-1\">
                            <a href=\"{{ path('agriculteur_stock_edit', {'idProduit': stock.idProduit}) }}\" class=\"btn btn-outline-primary btn-action\">Modifier</a>
                            <form method=\"post\" action=\"{{ path('agriculteur_stock_delete', {'idProduit': stock.idProduit}) }}\" onsubmit=\"return confirm('Supprimer ce stock définitivement ?');\" style=\"display:inline-block; margin:0;\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ stock.idProduit) }}\">
                                <button class=\"btn btn-outline-danger btn-action\">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            {% else %}
                <tr class=\"no-data-row\">
                    <td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucun stock trouvé.</td>
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
            const sortSelect = document.querySelector('.js-sort-select');
            const tbody = document.getElementById('stock-table-body');
            
            // Stocker toutes les lignes originales au chargement
            let allRows = [];
            const originalRows = Array.from(document.querySelectorAll('.js-filterable-row'));
            
            // Sauvegarder les lignes originales
            originalRows.forEach(row => {
                allRows.push(row.cloneNode(true));
            });
            
            // Si aucune donnée, on garde le message
            if (originalRows.length === 0) {
                return;
            }
            
            // Fonction pour obtenir la valeur de tri selon le type
            function getSortValue(row, sortType) {
                switch(sortType) {
                    case 'name_asc':
                    case 'name_desc':
                        const typeProduit = row.querySelector('.type-produit');
                        return typeProduit ? typeProduit.textContent.toLowerCase() : '';
                    default: // 'default' - tri par ID
                        const idCell = row.querySelector('.fw-bold');
                        return idCell ? parseInt(idCell.textContent) || 0 : 0;
                }
            }
            
            // Fonction pour vérifier si une ligne correspond à la recherche
            function matchesSearch(row, searchTerm) {
                if (!searchTerm) return true;
                const text = row.textContent.toLowerCase();
                return text.includes(searchTerm);
            }
            
            // Fonction pour trier les lignes
            function sortRows(rows, sortType) {
                const sortedRows = [...rows];
                
                sortedRows.sort((a, b) => {
                    let valueA = getSortValue(a, sortType);
                    let valueB = getSortValue(b, sortType);
                    
                    if (sortType === 'name_asc') {
                        return valueA.localeCompare(valueB);
                    } else if (sortType === 'name_desc') {
                        return valueB.localeCompare(valueA);
                    } else { // 'default' - tri par ID
                        return valueA - valueB;
                    }
                });
                
                return sortedRows;
            }
            
            // Fonction pour mettre à jour l'affichage
            function updateDisplay() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
                const sortType = sortSelect ? sortSelect.value : 'default';
                
                // 1. Filtrer les lignes (toujours à partir des originales)
                let filteredRows = allRows.filter(row => matchesSearch(row, searchTerm));
                
                // 2. Trier les lignes filtrées
                const sortedRows = sortRows(filteredRows, sortType);
                
                // 3. Vider le tbody
                tbody.innerHTML = '';
                
                // 4. Ajouter les lignes triées
                if (sortedRows.length === 0) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.className = 'no-data-row';
                    emptyRow.innerHTML = '<td colspan=\"8\" class=\"text-center py-4 text-muted\">Aucun stock trouvé.</td>';
                    tbody.appendChild(emptyRow);
                } else {
                    sortedRows.forEach(row => {
                        tbody.appendChild(row.cloneNode(true));
                    });
                    
                    // Réattacher les événements de confirmation pour les formulaires de suppression
                    document.querySelectorAll('#stock-table-body form').forEach(form => {
                        form.onsubmit = function() {
                            return confirm('Supprimer ce stock définitivement ?');
                        };
                    });
                }
            }
            
            // Événements
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    updateDisplay();
                });
            }
            
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    updateDisplay();
                });
            }
            
            // Initialisation
            updateDisplay();
        });
    </script>
{% endblock %}", "back_agriculteur/produit/stock/index.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\back_agriculteur\\produit\\stock\\index.html.twig");
    }
}
