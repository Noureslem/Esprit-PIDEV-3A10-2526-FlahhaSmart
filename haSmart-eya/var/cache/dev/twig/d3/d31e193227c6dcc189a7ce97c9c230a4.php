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

/* dashboard/admin.html.twig */
class __TwigTemplate_f3db9062be0d6a9013f82f1c3990a0cd extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/admin.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/admin.html.twig"));

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

        yield "Dashboard Admin — FlahaSmart";
        
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

        yield "Dashboard Administrateur";
        
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
";
        // line 8
        yield "<div class=\"row g-3 mb-4\">
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#3aad74;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 13, $this->source); })()), "users", [], "any", false, false, false, 13), "html", null, true);
        yield "</div>
                    <div class=\"opacity-75\">Utilisateurs</div>
                </div>
                <span style=\"font-size:2rem;\">👤</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#1565a8;--c2:#2196f3;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 24, $this->source); })()), "articles", [], "any", false, false, false, 24), "html", null, true);
        yield "</div>
                    <div class=\"opacity-75\">Articles</div>
                </div>
                <span style=\"font-size:2rem;\">📦</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#6a1fb5;--c2:#ab47bc;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()), "commandes", [], "any", false, false, false, 35), "html", null, true);
        yield "</div>
                    <div class=\"opacity-75\">Commandes</div>
                </div>
                <span style=\"font-size:2rem;\">🛒</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#bf6a00;--c2:#f9a825;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 46, $this->source); })()), "threads", [], "any", false, false, false, 46), "html", null, true);
        yield "</div>
                    <div class=\"opacity-75\">Threads forum</div>
                </div>
                <span style=\"font-size:2rem;\">💬</span>
            </div>
        </div>
    </div>
</div>

";
        // line 56
        yield "<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Derniers utilisateurs inscrits</h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["lastUsers"]) || array_key_exists("lastUsers", $context) ? $context["lastUsers"] : (function () { throw new RuntimeError('Variable "lastUsers" does not exist.', 74, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 75
            yield "                    <tr>
                        <td class=\"text-muted\">";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id_user", [], "any", false, false, false, 76), "html", null, true);
            yield "</td>
                        <td><strong>";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "prenom", [], "any", false, false, false, 77), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 77), "html", null, true);
            yield "</strong></td>
                        <td>";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "email", [], "any", false, false, false, 78), "html", null, true);
            yield "</td>
                        <td><span class=\"badge badge-";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 79), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 79), "html", null, true);
            yield "</span></td>
                        <td>
                            ";
            // line 81
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "actif", [], "any", false, false, false, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 82
                yield "                                <span class=\"badge bg-success-subtle text-success\">Actif</span>
                            ";
            } else {
                // line 84
                yield "                                <span class=\"badge bg-danger-subtle text-danger\">Inactif</span>
                            ";
            }
            // line 86
            yield "                        </td>
                        <td class=\"text-muted small\">";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "date_creation", [], "any", false, false, false, 87), "d/m/Y"), "html", null, true);
            yield "</td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 89
        if (!$context['_iterated']) {
            // line 90
            yield "                    <tr><td colspan=\"6\" class=\"text-center text-muted py-3\">Aucun utilisateur</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        yield "                </tbody>
            </table>
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
        return "dashboard/admin.html.twig";
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
        return array (  266 => 92,  259 => 90,  257 => 89,  250 => 87,  247 => 86,  243 => 84,  239 => 82,  237 => 81,  230 => 79,  226 => 78,  220 => 77,  216 => 76,  213 => 75,  208 => 74,  188 => 56,  176 => 46,  162 => 35,  148 => 24,  134 => 13,  127 => 8,  124 => 6,  111 => 5,  88 => 3,  65 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Dashboard Admin — FlahaSmart{% endblock %}
{% block page_title %}Dashboard Administrateur{% endblock %}

{% block body %}

{# ── Stat cards ────────────────────────────────────────────────────────── #}
<div class=\"row g-3 mb-4\">
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#3aad74;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">{{ stats.users }}</div>
                    <div class=\"opacity-75\">Utilisateurs</div>
                </div>
                <span style=\"font-size:2rem;\">👤</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#1565a8;--c2:#2196f3;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">{{ stats.articles }}</div>
                    <div class=\"opacity-75\">Articles</div>
                </div>
                <span style=\"font-size:2rem;\">📦</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#6a1fb5;--c2:#ab47bc;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">{{ stats.commandes }}</div>
                    <div class=\"opacity-75\">Commandes</div>
                </div>
                <span style=\"font-size:2rem;\">🛒</span>
            </div>
        </div>
    </div>
    <div class=\"col-sm-6 col-xl-3\">
        <div class=\"stat-card\" style=\"--c1:#bf6a00;--c2:#f9a825;\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <div class=\"fs-1 fw-bold\">{{ stats.threads }}</div>
                    <div class=\"opacity-75\">Threads forum</div>
                </div>
                <span style=\"font-size:2rem;\">💬</span>
            </div>
        </div>
    </div>
</div>

{# ── Derniers utilisateurs ─────────────────────────────────────────────── #}
<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0\">
        <h5 class=\"mb-0\">Derniers utilisateurs inscrits</h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                {% for u in lastUsers %}
                    <tr>
                        <td class=\"text-muted\">{{ u.id_user }}</td>
                        <td><strong>{{ u.prenom }} {{ u.nom }}</strong></td>
                        <td>{{ u.email }}</td>
                        <td><span class=\"badge badge-{{ u.role }}\">{{ u.role }}</span></td>
                        <td>
                            {% if u.actif %}
                                <span class=\"badge bg-success-subtle text-success\">Actif</span>
                            {% else %}
                                <span class=\"badge bg-danger-subtle text-danger\">Inactif</span>
                            {% endif %}
                        </td>
                        <td class=\"text-muted small\">{{ u.date_creation|date('d/m/Y') }}</td>
                    </tr>
                {% else %}
                    <tr><td colspan=\"6\" class=\"text-center text-muted py-3\">Aucun utilisateur</td></tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

{% endblock %}
", "dashboard/admin.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\dashboard\\admin.html.twig");
    }
}
