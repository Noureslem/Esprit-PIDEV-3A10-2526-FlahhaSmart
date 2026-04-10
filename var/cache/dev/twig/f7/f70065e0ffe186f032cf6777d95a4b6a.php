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

/* article/index.html.twig */
class __TwigTemplate_21e5d5e9beb5d7b15f5c3b3f7200be66 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Articles - FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"d-flex justify-content-between align-items-center mb-4\">
    <h1 class=\"h3\">Liste des articles</h1>
    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_new");
        yield "\" class=\"btn btn-primary\">+ Ajouter un article</a>
</div>

<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher par nom\" value=\"";
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
                    <option value=\"price_asc\" ";
        // line 20
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 20, $this->source); })()) == "price_asc")) {
            yield "selected";
        }
        yield ">Prix croissant</option>
                    <option value=\"price_desc\" ";
        // line 21
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 21, $this->source); })()) == "price_desc")) {
            yield "selected";
        }
        yield ">Prix décroissant</option>
                    <option value=\"date_desc\" ";
        // line 22
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 22, $this->source); })()) == "date_desc")) {
            yield "selected";
        }
        yield ">Date plus récent</option>
                    <option value=\"date_asc\" ";
        // line 23
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 23, $this->source); })()) == "date_asc")) {
            yield "selected";
        }
        yield ">Date plus ancien</option>
                    <option value=\"name_asc\" ";
        // line 24
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 24, $this->source); })()) == "name_asc")) {
            yield "selected";
        }
        yield ">Nom A-Z</option>
                    <option value=\"name_desc\" ";
        // line 25
        if (((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 25, $this->source); })()) == "name_desc")) {
            yield "selected";
        }
        yield ">Nom Z-A</option>
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
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Stock</th>
                    <th>Poids (kg)</th>
                    <th>Unité</th>
                    <th>Date ajout</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 53, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 54
            yield "                <tr>
                    <td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 55), "html", null, true);
            yield "</td>
                    <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "nom", [], "any", false, false, false, 56), "html", null, true);
            yield "</td>
                    <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                    <td>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "description", [], "any", false, false, false, 58), 0, 50), "html", null, true);
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "description", [], "any", false, false, false, 58)) > 50)) {
                yield "...";
            }
            yield "</td>
                    <td>";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "prix", [], "any", false, false, false, 59), 2, ",", " "), "html", null, true);
            yield "</td>
                    <td>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "stock", [], "any", false, false, false, 60), "html", null, true);
            yield "</td>
                    <td>";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "poids", [], "any", false, false, false, 61), 2, ",", " "), "html", null, true);
            yield "</td>
                    <td>";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "unite", [], "any", false, false, false, 62), "html", null, true);
            yield "</td>
                    <td>";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "dateAjout", [], "any", false, false, false, 63), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                    <td>
                        <a href=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 65)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 66)]), "html", null, true);
            yield "\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cet article ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 67))), "html", null, true);
            yield "\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 72
        if (!$context['_iterated']) {
            // line 73
            yield "                <tr><td colspan=\"10\" class=\"text-center\">Aucun article trouvé</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "            </tbody>
        </table>
    </div>
</div>

<div class=\"row mt-4\">
    <div class=\"col-md-6\">
        <a href=\"";
        // line 82
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_stats_price");
        yield "\" class=\"btn btn-outline-success w-100\">📊 Statistiques des prix</a>
    </div>
    <div class=\"col-md-6\">
        <a href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_stats_weight");
        yield "\" class=\"btn btn-outline-success w-100\">⚖️ Statistiques des poids</a>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/index.html.twig";
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
        return array (  265 => 85,  259 => 82,  250 => 75,  243 => 73,  241 => 72,  231 => 67,  227 => 66,  223 => 65,  218 => 63,  214 => 62,  210 => 61,  206 => 60,  202 => 59,  195 => 58,  191 => 57,  187 => 56,  183 => 55,  180 => 54,  175 => 53,  142 => 25,  136 => 24,  130 => 23,  124 => 22,  118 => 21,  112 => 20,  106 => 19,  99 => 15,  89 => 8,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Articles - FlahaSmart{% endblock %}

{% block body %}
<div class=\"d-flex justify-content-between align-items-center mb-4\">
    <h1 class=\"h3\">Liste des articles</h1>
    <a href=\"{{ path('app_article_new') }}\" class=\"btn btn-primary\">+ Ajouter un article</a>
</div>

<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher par nom\" value=\"{{ search }}\">
            </div>
            <div class=\"col-md-4\">
                <select name=\"sort\" class=\"form-select\">
                    <option value=\"id\" {% if sort == 'id' %}selected{% endif %}>Trier par défaut (ID)</option>
                    <option value=\"price_asc\" {% if sort == 'price_asc' %}selected{% endif %}>Prix croissant</option>
                    <option value=\"price_desc\" {% if sort == 'price_desc' %}selected{% endif %}>Prix décroissant</option>
                    <option value=\"date_desc\" {% if sort == 'date_desc' %}selected{% endif %}>Date plus récent</option>
                    <option value=\"date_asc\" {% if sort == 'date_asc' %}selected{% endif %}>Date plus ancien</option>
                    <option value=\"name_asc\" {% if sort == 'name_asc' %}selected{% endif %}>Nom A-Z</option>
                    <option value=\"name_desc\" {% if sort == 'name_desc' %}selected{% endif %}>Nom Z-A</option>
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
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Description</th>
                    <th>Prix (€)</th>
                    <th>Stock</th>
                    <th>Poids (kg)</th>
                    <th>Unité</th>
                    <th>Date ajout</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for article in articles %}
                <tr>
                    <td>{{ article.id }}</td>
                    <td>{{ article.nom }}</td>
                    <td>{{ article.categorie }}</td>
                    <td>{{ article.description|slice(0, 50) }}{% if article.description|length > 50 %}...{% endif %}</td>
                    <td>{{ article.prix|number_format(2, ',', ' ') }}</td>
                    <td>{{ article.stock }}</td>
                    <td>{{ article.poids|number_format(2, ',', ' ') }}</td>
                    <td>{{ article.unite }}</td>
                    <td>{{ article.dateAjout|date('d/m/Y H:i') }}</td>
                    <td>
                        <a href=\"{{ path('app_article_edit', {id: article.id}) }}\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"{{ path('app_article_delete', {id: article.id}) }}\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cet article ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                {% else %}
                <tr><td colspan=\"10\" class=\"text-center\">Aucun article trouvé</td></tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>

<div class=\"row mt-4\">
    <div class=\"col-md-6\">
        <a href=\"{{ path('app_article_stats_price') }}\" class=\"btn btn-outline-success w-100\">📊 Statistiques des prix</a>
    </div>
    <div class=\"col-md-6\">
        <a href=\"{{ path('app_article_stats_weight') }}\" class=\"btn btn-outline-success w-100\">⚖️ Statistiques des poids</a>
    </div>
</div>
{% endblock %}", "article/index.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\article\\index.html.twig");
    }
}
