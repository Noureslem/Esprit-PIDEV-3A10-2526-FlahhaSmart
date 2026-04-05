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

/* dashboard/agriculteur.html.twig */
class __TwigTemplate_7dce2e1f1ec098bbd0f75d9c9a73bc32 extends Template
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
            'page_title' => [$this, 'block_page_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/agriculteur.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/agriculteur.html.twig"));

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

        yield "Dashboard Agriculteur — FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 3
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

        yield "Mon espace agriculteur";
        
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
        yield "
<div class=\"mb-4\">
    <h4>Bonjour, ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 8, $this->source); })()), "fullName", [], "any", false, false, false, 8), "html", null, true);
        yield " 👋</h4>
    <p class=\"text-muted mb-0\">";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 9, $this->source); })()), "ville", [], "any", false, false, false, 9), "html", null, true);
        yield "</p>
</div>

<div class=\"row g-3 mb-4\">
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#3aad74;\">
            <div class=\"fs-1 fw-bold\">";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 15, $this->source); })())), "html", null, true);
        yield "</div>
            <div class=\"opacity-75\">Mes articles</div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#1565a8;--c2:#2196f3;\">
            <div class=\"fs-1 fw-bold\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["threads"]) || array_key_exists("threads", $context) ? $context["threads"] : (function () { throw new RuntimeError('Variable "threads" does not exist.', 21, $this->source); })())), "html", null, true);
        yield "</div>
            <div class=\"opacity-75\">Mes threads</div>
        </div>
    </div>
</div>

";
        // line 28
        yield "<div class=\"card mb-4\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
        <h5 class=\"mb-0\">Mes articles</h5>
        <a href=\"#\" class=\"btn btn-sm btn-success\">+ Ajouter</a>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 46, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 47
            yield "                    <tr>
                        <td><strong>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "nom", [], "any", false, false, false, 48), "html", null, true);
            yield "</strong></td>
                        <td>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "categorie", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                        <td>";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "prix", [], "any", false, false, false, 50), "html", null, true);
            yield " DT</td>
                        <td>
                            <span class=\"badge ";
            // line 52
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["a"], "stock", [], "any", false, false, false, 52) > 10)) {
                yield "bg-success";
            } else {
                yield "bg-warning text-dark";
            }
            yield "\">
                                ";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "stock", [], "any", false, false, false, 53), "html", null, true);
            yield "
                            </span>
                        </td>
                        <td class=\"text-muted small\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "date_ajout", [], "any", false, false, false, 56), "d/m/Y"), "html", null, true);
            yield "</td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 58
        if (!$context['_iterated']) {
            // line 59
            yield "                    <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucun article</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['a'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        yield "                </tbody>
            </table>
        </div>
    </div>
</div>

";
        // line 68
        yield "<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Mes discussions récentes</h5>
    </div>
    <div class=\"card-body\">
        ";
        // line 73
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["threads"]) || array_key_exists("threads", $context) ? $context["threads"] : (function () { throw new RuntimeError('Variable "threads" does not exist.', 73, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 74
            yield "        <div class=\"d-flex gap-3 py-2 border-bottom\">
            <span class=\"badge bg-";
            // line 75
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["t"], "sentiment", [], "any", false, false, false, 75) == "positif")) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["t"], "sentiment", [], "any", false, false, false, 75) == "negatif")) ? ("danger") : ("secondary"))));
            yield " align-self-start mt-1\">
                ";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "sentiment", [], "any", false, false, false, 76), "html", null, true);
            yield "
            </span>
            <div>
                <div class=\"fw-semibold\">";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "titre", [], "any", false, false, false, 79), "html", null, true);
            yield "</div>
                <small class=\"text-muted\">";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["t"], "contenu", [], "any", false, false, false, 80), 0, 80), "html", null, true);
            yield "…</small>
            </div>
        </div>
        ";
            $context['_iterated'] = true;
        }
        // line 83
        if (!$context['_iterated']) {
            // line 84
            yield "            <p class=\"text-muted text-center py-2\">Aucune discussion</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['t'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
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
        return "dashboard/agriculteur.html.twig";
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
        return array (  284 => 86,  277 => 84,  275 => 83,  267 => 80,  263 => 79,  257 => 76,  253 => 75,  250 => 74,  245 => 73,  238 => 68,  230 => 61,  223 => 59,  221 => 58,  214 => 56,  208 => 53,  200 => 52,  195 => 50,  191 => 49,  187 => 48,  184 => 47,  179 => 46,  159 => 28,  150 => 21,  141 => 15,  132 => 9,  128 => 8,  124 => 6,  111 => 5,  88 => 3,  65 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Dashboard Agriculteur — FlahaSmart{% endblock %}
{% block page_title %}Mon espace agriculteur{% endblock %}

{% block body %}

<div class=\"mb-4\">
    <h4>Bonjour, {{ user.fullName }} 👋</h4>
    <p class=\"text-muted mb-0\">{{ user.ville }}</p>
</div>

<div class=\"row g-3 mb-4\">
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#3aad74;\">
            <div class=\"fs-1 fw-bold\">{{ articles|length }}</div>
            <div class=\"opacity-75\">Mes articles</div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#1565a8;--c2:#2196f3;\">
            <div class=\"fs-1 fw-bold\">{{ threads|length }}</div>
            <div class=\"opacity-75\">Mes threads</div>
        </div>
    </div>
</div>

{# Articles #}
<div class=\"card mb-4\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
        <h5 class=\"mb-0\">Mes articles</h5>
        <a href=\"#\" class=\"btn btn-sm btn-success\">+ Ajouter</a>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                {% for a in articles %}
                    <tr>
                        <td><strong>{{ a.nom }}</strong></td>
                        <td>{{ a.categorie }}</td>
                        <td>{{ a.prix }} DT</td>
                        <td>
                            <span class=\"badge {% if a.stock > 10 %}bg-success{% else %}bg-warning text-dark{% endif %}\">
                                {{ a.stock }}
                            </span>
                        </td>
                        <td class=\"text-muted small\">{{ a.date_ajout|date('d/m/Y') }}</td>
                    </tr>
                {% else %}
                    <tr><td colspan=\"5\" class=\"text-center text-muted py-3\">Aucun article</td></tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

{# Threads #}
<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Mes discussions récentes</h5>
    </div>
    <div class=\"card-body\">
        {% for t in threads %}
        <div class=\"d-flex gap-3 py-2 border-bottom\">
            <span class=\"badge bg-{{ t.sentiment == 'positif' ? 'success' : (t.sentiment == 'negatif' ? 'danger' : 'secondary') }} align-self-start mt-1\">
                {{ t.sentiment }}
            </span>
            <div>
                <div class=\"fw-semibold\">{{ t.titre }}</div>
                <small class=\"text-muted\">{{ t.contenu|slice(0, 80) }}…</small>
            </div>
        </div>
        {% else %}
            <p class=\"text-muted text-center py-2\">Aucune discussion</p>
        {% endfor %}
    </div>
</div>

{% endblock %}
", "dashboard/agriculteur.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\dashboard\\agriculteur.html.twig");
    }
}
