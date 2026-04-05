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

/* order/index.html.twig */
class __TwigTemplate_7c69a8422c6b551700b3e6777264e5ea extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "order/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "order/index.html.twig"));

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

        yield "Commandes - FlahaSmart";
        
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
        yield "<div class=\"d-flex justify-content-between align-items-center mb-4\">
    <h1 class=\"h3\">Liste des commandes</h1>
    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_new");
        yield "\" class=\"btn btn-primary\">+ Ajouter une commande</a>
</div>

<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher par référence\" value=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 15, $this->source); })()), "html", null, true);
        yield "\">
            </div>
            <div class=\"col-md-4\">
                <select name=\"sort\" class=\"form-select\">
                    <option value=\"id\" ";
        // line 19
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 19, $this->source); })()) == "id")) {
            yield "selected";
        }
        yield ">Trier par défaut (ID)</option>
                    <option value=\"date_desc\" ";
        // line 20
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 20, $this->source); })()) == "date_desc")) {
            yield "selected";
        }
        yield ">Date plus récente</option>
                    <option value=\"date_asc\" ";
        // line 21
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 21, $this->source); })()) == "date_asc")) {
            yield "selected";
        }
        yield ">Date plus ancienne</option>
                    <option value=\"amount_asc\" ";
        // line 22
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 22, $this->source); })()) == "amount_asc")) {
            yield "selected";
        }
        yield ">Montant croissant</option>
                    <option value=\"amount_desc\" ";
        // line 23
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 23, $this->source); })()) == "amount_desc")) {
            yield "selected";
        }
        yield ">Montant décroissant</option>
                    <option value=\"ref_asc\" ";
        // line 24
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 24, $this->source); })()) == "ref_asc")) {
            yield "selected";
        }
        yield ">Référence A-Z</option>
                    <option value=\"ref_desc\" ";
        // line 25
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 25, $this->source); })()) == "ref_desc")) {
            yield "selected";
        }
        yield ">Référence Z-A</option>
                </select>
            </div>
            <div class=\"col-md-2\">
                <button type=\"submit\" class=\"btn btn-primary w-100\">Appliquer</button>
            </div>
        </form>
    </div>
</div>

<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"table table-hover mb-0\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Mode paiement</th>
                    <th>Adresse</th>
                    <th>Montant (€)</th>
                    <th>Frais (€)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 52, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 53
            yield "                <tr>
                    <td>";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 54), "html", null, true);
            yield "</td>
                    <td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "reference", [], "any", false, false, false, 55), "html", null, true);
            yield "</td>
                    <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "dateCommande", [], "any", false, false, false, 56), "d/m/Y"), "html", null, true);
            yield "</td>
                    <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "statut", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                    <td>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "modePaiement", [], "any", false, false, false, 58), "html", null, true);
            yield "</td>
                    <td>";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["order"], "adresseLivraison", [], "any", false, false, false, 59), 0, 40), "html", null, true);
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["order"], "adresseLivraison", [], "any", false, false, false, 59)) > 40)) {
                yield "...";
            }
            yield "</td>
                    <td>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "montantTotal", [], "any", false, false, false, 60), 2, ",", " "), "html", null, true);
            yield "</td>
                    <td>";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "fraisLivraison", [], "any", false, false, false, 61), 2, ",", " "), "html", null, true);
            yield "</td>
                    <td>
                        <a href=\"";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 63)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 64)]), "html", null, true);
            yield "\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cette commande ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 65))), "html", null, true);
            yield "\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 70
        if (!$context['_iterated']) {
            // line 71
            yield "                <tr><td colspan=\"9\" class=\"text-center\">Aucune commande trouvée</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        yield "            </tbody>
        </table>
    </div>
</div>

<div class=\"row mt-4\">
    <div class=\"col-md-6\">
        <a href=\"";
        // line 80
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_stats_amount");
        yield "\" class=\"btn btn-outline-success w-100\">💰 Statistiques des montants</a>
    </div>
    <div class=\"col-md-6\">
        <a href=\"";
        // line 83
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_order_stats_fees");
        yield "\" class=\"btn btn-outline-success w-100\">🚚 Statistiques des frais</a>
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
        return "order/index.html.twig";
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
        return array (  275 => 83,  269 => 80,  260 => 73,  253 => 71,  251 => 70,  241 => 65,  237 => 64,  233 => 63,  228 => 61,  224 => 60,  217 => 59,  213 => 58,  209 => 57,  205 => 56,  201 => 55,  197 => 54,  194 => 53,  189 => 52,  157 => 25,  151 => 24,  145 => 23,  139 => 22,  133 => 21,  127 => 20,  121 => 19,  114 => 15,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Commandes - FlahaSmart{% endblock %}

{% block body %}
<div class=\"d-flex justify-content-between align-items-center mb-4\">
    <h1 class=\"h3\">Liste des commandes</h1>
    <a href=\"{{ path('app_order_new') }}\" class=\"btn btn-primary\">+ Ajouter une commande</a>
</div>

<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher par référence\" value=\"{{ search }}\">
            </div>
            <div class=\"col-md-4\">
                <select name=\"sort\" class=\"form-select\">
                    <option value=\"id\" {% if sort == 'id' %}selected{% endif %}>Trier par défaut (ID)</option>
                    <option value=\"date_desc\" {% if sort == 'date_desc' %}selected{% endif %}>Date plus récente</option>
                    <option value=\"date_asc\" {% if sort == 'date_asc' %}selected{% endif %}>Date plus ancienne</option>
                    <option value=\"amount_asc\" {% if sort == 'amount_asc' %}selected{% endif %}>Montant croissant</option>
                    <option value=\"amount_desc\" {% if sort == 'amount_desc' %}selected{% endif %}>Montant décroissant</option>
                    <option value=\"ref_asc\" {% if sort == 'ref_asc' %}selected{% endif %}>Référence A-Z</option>
                    <option value=\"ref_desc\" {% if sort == 'ref_desc' %}selected{% endif %}>Référence Z-A</option>
                </select>
            </div>
            <div class=\"col-md-2\">
                <button type=\"submit\" class=\"btn btn-primary w-100\">Appliquer</button>
            </div>
        </form>
    </div>
</div>

<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"table table-hover mb-0\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Mode paiement</th>
                    <th>Adresse</th>
                    <th>Montant (€)</th>
                    <th>Frais (€)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for order in orders %}
                <tr>
                    <td>{{ order.id }}</td>
                    <td>{{ order.reference }}</td>
                    <td>{{ order.dateCommande|date('d/m/Y') }}</td>
                    <td>{{ order.statut }}</td>
                    <td>{{ order.modePaiement }}</td>
                    <td>{{ order.adresseLivraison|slice(0, 40) }}{% if order.adresseLivraison|length > 40 %}...{% endif %}</td>
                    <td>{{ order.montantTotal|number_format(2, ',', ' ') }}</td>
                    <td>{{ order.fraisLivraison|number_format(2, ',', ' ') }}</td>
                    <td>
                        <a href=\"{{ path('app_order_edit', {id: order.id}) }}\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"{{ path('app_order_delete', {id: order.id}) }}\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cette commande ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ order.id) }}\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                {% else %}
                <tr><td colspan=\"9\" class=\"text-center\">Aucune commande trouvée</td></tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>

<div class=\"row mt-4\">
    <div class=\"col-md-6\">
        <a href=\"{{ path('app_order_stats_amount') }}\" class=\"btn btn-outline-success w-100\">💰 Statistiques des montants</a>
    </div>
    <div class=\"col-md-6\">
        <a href=\"{{ path('app_order_stats_fees') }}\" class=\"btn btn-outline-success w-100\">🚚 Statistiques des frais</a>
    </div>
</div>
{% endblock %}", "order/index.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\order\\index.html.twig");
    }
}
