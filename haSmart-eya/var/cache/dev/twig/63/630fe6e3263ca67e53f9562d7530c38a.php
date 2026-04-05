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

/* admin/admin_users.html.twig */
class __TwigTemplate_8d7ce1e0d257ca23685e586387a98cef extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_users.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Gestion Utilisateurs — FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield "Gestion des Utilisateurs";
        
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
        yield "
";
        // line 8
        yield "<div class=\"row g-3 mb-4\">
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a3c34;--c2:#2e7d52;\">
            <div class=\"fs-2 fw-bold\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 11, $this->source); })()), "total", [], "any", false, false, false, 11), "html", null, true);
        yield "</div>
            <div class=\"opacity-75 small\">Total</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#c05000;--c2:#e07020;\">
            <div class=\"fs-2 fw-bold\">";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 17, $this->source); })()), "admins", [], "any", false, false, false, 17), "html", null, true);
        yield "</div>
            <div class=\"opacity-75 small\">Admins</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a6e35;--c2:#3aad74;\">
            <div class=\"fs-2 fw-bold\">";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 23, $this->source); })()), "agriculteurs", [], "any", false, false, false, 23), "html", null, true);
        yield "</div>
            <div class=\"opacity-75 small\">Agriculteurs</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a4fa0;--c2:#2196f3;\">
            <div class=\"fs-2 fw-bold\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 29, $this->source); })()), "clients", [], "any", false, false, false, 29), "html", null, true);
        yield "</div>
            <div class=\"opacity-75 small\">Clients</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#66bb6a;\">
            <div class=\"fs-2 fw-bold\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()), "actifs", [], "any", false, false, false, 35), "html", null, true);
        yield "</div>
            <div class=\"opacity-75 small\">Actifs</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2 d-flex align-items-center justify-content-center\">
        <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_new");
        yield "\" class=\"btn btn-success w-100 py-3 fw-semibold\">
            <i class=\"bi bi-person-plus\"></i><br>Ajouter
        </a>
    </div>
</div>

";
        // line 47
        yield "<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-2 align-items-end\">
            <div class=\"col-md-5\">
                <label class=\"form-label small fw-semibold\">Recherche</label>
                <input type=\"text\" name=\"search\" value=\"";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 52, $this->source); })()), "html", null, true);
        yield "\"
                       class=\"form-control\" placeholder=\"Nom, prénom ou email...\">
            </div>
            <div class=\"col-md-3\">
                <label class=\"form-label small fw-semibold\">Rôle</label>
                <select name=\"role\" class=\"form-select\">
                    <option value=\"\">Tous les rôles</option>
                    <option value=\"ADMINISTRATEUR\" ";
        // line 59
        yield ((((isset($context["role"]) || array_key_exists("role", $context) ? $context["role"] : (function () { throw new RuntimeError('Variable "role" does not exist.', 59, $this->source); })()) == "ADMINISTRATEUR")) ? ("selected") : (""));
        yield ">Administrateur</option>
                    <option value=\"AGRICULTEUR\"    ";
        // line 60
        yield ((((isset($context["role"]) || array_key_exists("role", $context) ? $context["role"] : (function () { throw new RuntimeError('Variable "role" does not exist.', 60, $this->source); })()) == "AGRICULTEUR")) ? ("selected") : (""));
        yield ">Agriculteur</option>
                    <option value=\"CLIENT\"         ";
        // line 61
        yield ((((isset($context["role"]) || array_key_exists("role", $context) ? $context["role"] : (function () { throw new RuntimeError('Variable "role" does not exist.', 61, $this->source); })()) == "CLIENT")) ? ("selected") : (""));
        yield ">Client</option>
                </select>
            </div>
            <div class=\"col-md-2\">
                <button type=\"submit\" class=\"btn btn-primary w-100\">
                    <i class=\"bi bi-search\"></i> Filtrer
                </button>
            </div>
            <div class=\"col-md-2\">
                <a href=\"";
        // line 70
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" class=\"btn btn-outline-secondary w-100\">
                    <i class=\"bi bi-x-circle\"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

";
        // line 79
        yield "<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
        <h5 class=\"mb-0\">
            Utilisateurs
            <span class=\"badge bg-secondary ms-2\">";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 83, $this->source); })())), "html", null, true);
        yield "</span>
        </h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover align-middle mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Ville</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Inscription</th>
                        <th class=\"text-center\">Actions</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 103
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 103, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 104
            yield "                    <tr>
                        <td class=\"text-muted small\">";
            // line 105
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 105), "html", null, true);
            yield "</td>
                        <td>
                            <div class=\"fw-semibold\">";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "prenom", [], "any", false, false, false, 107), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 107), "html", null, true);
            yield "</div>
                        </td>
                        <td class=\"text-muted small\">";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "email", [], "any", false, false, false, 109), "html", null, true);
            yield "</td>
                        <td class=\"text-muted small\">";
            // line 110
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "telephone", [], "any", true, true, false, 110) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["u"], "telephone", [], "any", false, false, false, 110)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "telephone", [], "any", false, false, false, 110), "html", null, true)) : ("—"));
            yield "</td>
                        <td class=\"text-muted small\">";
            // line 111
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "ville", [], "any", true, true, false, 111) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["u"], "ville", [], "any", false, false, false, 111)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "ville", [], "any", false, false, false, 111), "html", null, true)) : ("—"));
            yield "</td>
                        <td>
                            <span class=\"badge badge-";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 113), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 113), "html", null, true);
            yield "</span>
                        </td>
                        <td>
                            ";
            // line 116
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "actif", [], "any", false, false, false, 116)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 117
                yield "                                <span class=\"badge bg-success-subtle text-success\">Actif</span>
                            ";
            } else {
                // line 119
                yield "                                <span class=\"badge bg-danger-subtle text-danger\">Inactif</span>
                            ";
            }
            // line 121
            yield "                        </td>
                        <td class=\"text-muted small\">";
            // line 122
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "dateCreation", [], "any", false, false, false, 122), "d/m/Y"), "html", null, true);
            yield "</td>
                        <td class=\"text-center\">
                            <div class=\"d-flex gap-1 justify-content-center\">

                                ";
            // line 127
            yield "                                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 127)]), "html", null, true);
            yield "\"
                                   class=\"btn btn-sm btn-outline-primary\" title=\"Modifier\">
                                    <i class=\"bi bi-pencil\"></i>
                                </a>

                                ";
            // line 133
            yield "                                <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_toggle", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 133)]), "html", null, true);
            yield "\">
                                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 134
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("toggle" . CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 134))), "html", null, true);
            yield "\">
                                    <button type=\"submit\"
                                            class=\"btn btn-sm ";
            // line 136
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "actif", [], "any", false, false, false, 136)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("btn-outline-warning") : ("btn-outline-success"));
            yield "\"
                                            title=\"";
            // line 137
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "actif", [], "any", false, false, false, 137)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Désactiver") : ("Activer"));
            yield "\">
                                        <i class=\"bi ";
            // line 138
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "actif", [], "any", false, false, false, 138)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bi-toggle-on") : ("bi-toggle-off"));
            yield "\"></i>
                                    </button>
                                </form>

                                ";
            // line 143
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "email", [], "any", false, false, false, 143) != CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 143, $this->source); })()), "user", [], "any", false, false, false, 143), "userIdentifier", [], "any", false, false, false, 143))) {
                // line 144
                yield "                                <form method=\"post\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 144)]), "html", null, true);
                yield "\"
                                      onsubmit=\"return confirm('Supprimer ";
                // line 145
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "prenom", [], "any", false, false, false, 145), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 145), "html", null, true);
                yield " ?')\">
                                    <input type=\"hidden\" name=\"_token\" value=\"";
                // line 146
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 146))), "html", null, true);
                yield "\">
                                    <button type=\"submit\" class=\"btn btn-sm btn-outline-danger\" title=\"Supprimer\">
                                        <i class=\"bi bi-trash\"></i>
                                    </button>
                                </form>
                                ";
            }
            // line 152
            yield "
                            </div>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 156
        if (!$context['_iterated']) {
            // line 157
            yield "                    <tr>
                        <td colspan=\"9\" class=\"text-center text-muted py-4\">
                            <i class=\"bi bi-people fs-2 d-block mb-2\"></i>
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        yield "                </tbody>
            </table>
        </div>
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
        return "admin/admin_users.html.twig";
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
        return array (  381 => 164,  369 => 157,  367 => 156,  359 => 152,  350 => 146,  344 => 145,  339 => 144,  336 => 143,  329 => 138,  325 => 137,  321 => 136,  316 => 134,  311 => 133,  302 => 127,  295 => 122,  292 => 121,  288 => 119,  284 => 117,  282 => 116,  274 => 113,  269 => 111,  265 => 110,  261 => 109,  254 => 107,  249 => 105,  246 => 104,  241 => 103,  218 => 83,  212 => 79,  201 => 70,  189 => 61,  185 => 60,  181 => 59,  171 => 52,  164 => 47,  155 => 40,  147 => 35,  138 => 29,  129 => 23,  120 => 17,  111 => 11,  106 => 8,  103 => 6,  93 => 5,  76 => 3,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Gestion Utilisateurs — FlahaSmart{% endblock %}
{% block page_title %}Gestion des Utilisateurs{% endblock %}

{% block body %}

{# ── Stats ── #}
<div class=\"row g-3 mb-4\">
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a3c34;--c2:#2e7d52;\">
            <div class=\"fs-2 fw-bold\">{{ stats.total }}</div>
            <div class=\"opacity-75 small\">Total</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#c05000;--c2:#e07020;\">
            <div class=\"fs-2 fw-bold\">{{ stats.admins }}</div>
            <div class=\"opacity-75 small\">Admins</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a6e35;--c2:#3aad74;\">
            <div class=\"fs-2 fw-bold\">{{ stats.agriculteurs }}</div>
            <div class=\"opacity-75 small\">Agriculteurs</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#1a4fa0;--c2:#2196f3;\">
            <div class=\"fs-2 fw-bold\">{{ stats.clients }}</div>
            <div class=\"opacity-75 small\">Clients</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2\">
        <div class=\"stat-card\" style=\"--c1:#2e7d52;--c2:#66bb6a;\">
            <div class=\"fs-2 fw-bold\">{{ stats.actifs }}</div>
            <div class=\"opacity-75 small\">Actifs</div>
        </div>
    </div>
    <div class=\"col-6 col-xl-2 d-flex align-items-center justify-content-center\">
        <a href=\"{{ path('admin_user_new') }}\" class=\"btn btn-success w-100 py-3 fw-semibold\">
            <i class=\"bi bi-person-plus\"></i><br>Ajouter
        </a>
    </div>
</div>

{# ── Filtres ── #}
<div class=\"card mb-4\">
    <div class=\"card-body\">
        <form method=\"get\" class=\"row g-2 align-items-end\">
            <div class=\"col-md-5\">
                <label class=\"form-label small fw-semibold\">Recherche</label>
                <input type=\"text\" name=\"search\" value=\"{{ search }}\"
                       class=\"form-control\" placeholder=\"Nom, prénom ou email...\">
            </div>
            <div class=\"col-md-3\">
                <label class=\"form-label small fw-semibold\">Rôle</label>
                <select name=\"role\" class=\"form-select\">
                    <option value=\"\">Tous les rôles</option>
                    <option value=\"ADMINISTRATEUR\" {{ role == 'ADMINISTRATEUR' ? 'selected' : '' }}>Administrateur</option>
                    <option value=\"AGRICULTEUR\"    {{ role == 'AGRICULTEUR'    ? 'selected' : '' }}>Agriculteur</option>
                    <option value=\"CLIENT\"         {{ role == 'CLIENT'         ? 'selected' : '' }}>Client</option>
                </select>
            </div>
            <div class=\"col-md-2\">
                <button type=\"submit\" class=\"btn btn-primary w-100\">
                    <i class=\"bi bi-search\"></i> Filtrer
                </button>
            </div>
            <div class=\"col-md-2\">
                <a href=\"{{ path('admin_users') }}\" class=\"btn btn-outline-secondary w-100\">
                    <i class=\"bi bi-x-circle\"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

{# ── Table ── #}
<div class=\"card\">
    <div class=\"card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center\">
        <h5 class=\"mb-0\">
            Utilisateurs
            <span class=\"badge bg-secondary ms-2\">{{ users|length }}</span>
        </h5>
    </div>
    <div class=\"card-body p-0\">
        <div class=\"table-responsive\">
            <table class=\"table table-hover align-middle mb-0\">
                <thead class=\"table-light\">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Ville</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Inscription</th>
                        <th class=\"text-center\">Actions</th>
                    </tr>
                </thead>
                <tbody>
                {% for u in users %}
                    <tr>
                        <td class=\"text-muted small\">{{ u.id }}</td>
                        <td>
                            <div class=\"fw-semibold\">{{ u.prenom }} {{ u.nom }}</div>
                        </td>
                        <td class=\"text-muted small\">{{ u.email }}</td>
                        <td class=\"text-muted small\">{{ u.telephone ?? '—' }}</td>
                        <td class=\"text-muted small\">{{ u.ville ?? '—' }}</td>
                        <td>
                            <span class=\"badge badge-{{ u.role }}\">{{ u.role }}</span>
                        </td>
                        <td>
                            {% if u.actif %}
                                <span class=\"badge bg-success-subtle text-success\">Actif</span>
                            {% else %}
                                <span class=\"badge bg-danger-subtle text-danger\">Inactif</span>
                            {% endif %}
                        </td>
                        <td class=\"text-muted small\">{{ u.dateCreation|date('d/m/Y') }}</td>
                        <td class=\"text-center\">
                            <div class=\"d-flex gap-1 justify-content-center\">

                                {# Modifier #}
                                <a href=\"{{ path('admin_user_edit', {id: u.id}) }}\"
                                   class=\"btn btn-sm btn-outline-primary\" title=\"Modifier\">
                                    <i class=\"bi bi-pencil\"></i>
                                </a>

                                {# Activer / Désactiver #}
                                <form method=\"post\" action=\"{{ path('admin_user_toggle', {id: u.id}) }}\">
                                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('toggle' ~ u.id) }}\">
                                    <button type=\"submit\"
                                            class=\"btn btn-sm {{ u.actif ? 'btn-outline-warning' : 'btn-outline-success' }}\"
                                            title=\"{{ u.actif ? 'Désactiver' : 'Activer' }}\">
                                        <i class=\"bi {{ u.actif ? 'bi-toggle-on' : 'bi-toggle-off' }}\"></i>
                                    </button>
                                </form>

                                {# Supprimer #}
                                {% if u.email != app.user.userIdentifier %}
                                <form method=\"post\" action=\"{{ path('admin_user_delete', {id: u.id}) }}\"
                                      onsubmit=\"return confirm('Supprimer {{ u.prenom }} {{ u.nom }} ?')\">
                                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ u.id) }}\">
                                    <button type=\"submit\" class=\"btn btn-sm btn-outline-danger\" title=\"Supprimer\">
                                        <i class=\"bi bi-trash\"></i>
                                    </button>
                                </form>
                                {% endif %}

                            </div>
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"9\" class=\"text-center text-muted py-4\">
                            <i class=\"bi bi-people fs-2 d-block mb-2\"></i>
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

{% endblock %}
", "admin/admin_users.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\admin\\admin_users.html.twig");
    }
}
