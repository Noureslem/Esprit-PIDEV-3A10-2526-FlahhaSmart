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

/* profile/index.html.twig */
class __TwigTemplate_c8b833cd6664cbbfa9cb2d681044c6cf extends Template
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
        // line 2
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 2);
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

        yield "Mon Profil — FlahaSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield "Mon Profil";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        yield "<div class=\"row g-4\">

    ";
        // line 10
        yield "    <div class=\"col-lg-4\">
        <div class=\"card p-4 text-center\">
            <div style=\"font-size:4rem;\">👤</div>
            <h4 class=\"fw-bold mt-2\">";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 13, $this->source); })()), "fullName", [], "any", false, false, false, 13), "html", null, true);
        yield "</h4>
            <p class=\"text-muted mb-1\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 14, $this->source); })()), "email", [], "any", false, false, false, 14), "html", null, true);
        yield "</p>
            <span class=\"badge badge-";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 15, $this->source); })()), "role", [], "any", false, false, false, 15), "html", null, true);
        yield " fs-6 px-3 py-2\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 15, $this->source); })()), "role", [], "any", false, false, false, 15), "html", null, true);
        yield "</span>

            <hr>

            <div class=\"text-start\">
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Téléphone</small>
                    <strong>";
        // line 22
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telephone", [], "any", true, true, false, 22) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 22, $this->source); })()), "telephone", [], "any", false, false, false, 22)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 22, $this->source); })()), "telephone", [], "any", false, false, false, 22), "html", null, true)) : ("—"));
        yield "</strong>
                </div>
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Ville</small>
                    <strong>";
        // line 26
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "ville", [], "any", true, true, false, 26) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 26, $this->source); })()), "ville", [], "any", false, false, false, 26)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 26, $this->source); })()), "ville", [], "any", false, false, false, 26), "html", null, true)) : ("—"));
        yield "</strong>
                </div>
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Membre depuis</small>
                    <strong>";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 30, $this->source); })()), "dateCreation", [], "any", false, false, false, 30), "d/m/Y"), "html", null, true);
        yield "</strong>
                </div>
                <div>
                    <small class=\"text-muted d-block\">Statut</small>
                    ";
        // line 34
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 34, $this->source); })()), "actif", [], "any", false, false, false, 34)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 35
            yield "                        <span class=\"badge bg-success\">Actif</span>
                    ";
        } else {
            // line 37
            yield "                        <span class=\"badge bg-danger\">Inactif</span>
                    ";
        }
        // line 39
        yield "                </div>
            </div>
        </div>
    </div>

    ";
        // line 45
        yield "    <div class=\"col-lg-8\">
        <div class=\"card p-4\">
            <h5 class=\"fw-bold mb-4\">✏️ Modifier mes informations</h5>

            ";
        // line 49
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), 'form_start');
        yield "

            <div class=\"row g-3\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 53
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "nom", [], "any", false, false, false, 53), 'label');
        yield "</label>
                    ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "nom", [], "any", false, false, false, 54), 'widget');
        yield "
                    ";
        // line 55
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 55, $this->source); })()), "nom", [], "any", false, false, false, 55), 'errors');
        yield "
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "prenom", [], "any", false, false, false, 58), 'label');
        yield "</label>
                    ";
        // line 59
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 59, $this->source); })()), "prenom", [], "any", false, false, false, 59), 'widget');
        yield "
                </div>
            </div>

            <div class=\"mt-3\">
                <label class=\"form-label fw-semibold\">";
        // line 64
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 64, $this->source); })()), "email", [], "any", false, false, false, 64), 'label');
        yield "</label>
                ";
        // line 65
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 65, $this->source); })()), "email", [], "any", false, false, false, 65), 'widget');
        yield "
                ";
        // line 66
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), "email", [], "any", false, false, false, 66), 'errors');
        yield "
            </div>

            <div class=\"row g-3 mt-1\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 71
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), "telephone", [], "any", false, false, false, 71), 'label');
        yield "</label>
                    ";
        // line 72
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "telephone", [], "any", false, false, false, 72), 'widget');
        yield "
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 75
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), "ville", [], "any", false, false, false, 75), 'label');
        yield "</label>
                    ";
        // line 76
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 76, $this->source); })()), "ville", [], "any", false, false, false, 76), 'widget');
        yield "
                </div>
            </div>

            ";
        // line 81
        yield "
            <hr class=\"my-4\">
            <h6 class=\"fw-bold mb-3\">🔒 Changer le mot de passe</h6>
            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold\">";
        // line 85
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), "newPassword", [], "any", false, false, false, 85), "first", [], "any", false, false, false, 85), 'label');
        yield "</label>
                ";
        // line 86
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 86, $this->source); })()), "newPassword", [], "any", false, false, false, 86), "first", [], "any", false, false, false, 86), 'widget');
        yield "
            </div>
            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold\">";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 89, $this->source); })()), "newPassword", [], "any", false, false, false, 89), "second", [], "any", false, false, false, 89), 'label');
        yield "</label>
                ";
        // line 90
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "newPassword", [], "any", false, false, false, 90), "second", [], "any", false, false, false, 90), 'widget');
        yield "
                ";
        // line 91
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 91, $this->source); })()), "newPassword", [], "any", false, false, false, 91), 'errors');
        yield "
            </div>
            <small class=\"text-muted\">Laisser vide pour conserver le mot de passe actuel</small>

            <div class=\"mt-4\">
                <button type=\"submit\" class=\"btn btn-success px-4 py-2 fw-semibold\">
                    <i class=\"bi bi-check-circle\"></i> Enregistrer les modifications
                </button>
            </div>

            ";
        // line 101
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), 'form_end');
        yield "
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
        return "profile/index.html.twig";
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
        return array (  283 => 101,  270 => 91,  266 => 90,  262 => 89,  256 => 86,  252 => 85,  246 => 81,  239 => 76,  235 => 75,  229 => 72,  225 => 71,  217 => 66,  213 => 65,  209 => 64,  201 => 59,  197 => 58,  191 => 55,  187 => 54,  183 => 53,  176 => 49,  170 => 45,  163 => 39,  159 => 37,  155 => 35,  153 => 34,  146 => 30,  139 => 26,  132 => 22,  120 => 15,  116 => 14,  112 => 13,  107 => 10,  103 => 7,  93 => 6,  76 => 4,  59 => 3,  42 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/profile/index.html.twig #}
{% extends 'base.html.twig' %}
{% block title %}Mon Profil — FlahaSmart{% endblock %}
{% block page_title %}Mon Profil{% endblock %}

{% block body %}
<div class=\"row g-4\">

    {# ── Carte infos gauche ── #}
    <div class=\"col-lg-4\">
        <div class=\"card p-4 text-center\">
            <div style=\"font-size:4rem;\">👤</div>
            <h4 class=\"fw-bold mt-2\">{{ user.fullName }}</h4>
            <p class=\"text-muted mb-1\">{{ user.email }}</p>
            <span class=\"badge badge-{{ user.role }} fs-6 px-3 py-2\">{{ user.role }}</span>

            <hr>

            <div class=\"text-start\">
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Téléphone</small>
                    <strong>{{ user.telephone ?? '—' }}</strong>
                </div>
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Ville</small>
                    <strong>{{ user.ville ?? '—' }}</strong>
                </div>
                <div class=\"mb-2\">
                    <small class=\"text-muted d-block\">Membre depuis</small>
                    <strong>{{ user.dateCreation|date('d/m/Y') }}</strong>
                </div>
                <div>
                    <small class=\"text-muted d-block\">Statut</small>
                    {% if user.actif %}
                        <span class=\"badge bg-success\">Actif</span>
                    {% else %}
                        <span class=\"badge bg-danger\">Inactif</span>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>

    {# ── Formulaire modification droite ── #}
    <div class=\"col-lg-8\">
        <div class=\"card p-4\">
            <h5 class=\"fw-bold mb-4\">✏️ Modifier mes informations</h5>

            {{ form_start(form) }}

            <div class=\"row g-3\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">{{ form_label(form.nom) }}</label>
                    {{ form_widget(form.nom) }}
                    {{ form_errors(form.nom) }}
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">{{ form_label(form.prenom) }}</label>
                    {{ form_widget(form.prenom) }}
                </div>
            </div>

            <div class=\"mt-3\">
                <label class=\"form-label fw-semibold\">{{ form_label(form.email) }}</label>
                {{ form_widget(form.email) }}
                {{ form_errors(form.email) }}
            </div>

            <div class=\"row g-3 mt-1\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">{{ form_label(form.telephone) }}</label>
                    {{ form_widget(form.telephone) }}
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">{{ form_label(form.ville) }}</label>
                    {{ form_widget(form.ville) }}
                </div>
            </div>

            {# PAS DE CHAMP ADRESSE ICI #}

            <hr class=\"my-4\">
            <h6 class=\"fw-bold mb-3\">🔒 Changer le mot de passe</h6>
            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold\">{{ form_label(form.newPassword.first) }}</label>
                {{ form_widget(form.newPassword.first) }}
            </div>
            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold\">{{ form_label(form.newPassword.second) }}</label>
                {{ form_widget(form.newPassword.second) }}
                {{ form_errors(form.newPassword) }}
            </div>
            <small class=\"text-muted\">Laisser vide pour conserver le mot de passe actuel</small>

            <div class=\"mt-4\">
                <button type=\"submit\" class=\"btn btn-success px-4 py-2 fw-semibold\">
                    <i class=\"bi bi-check-circle\"></i> Enregistrer les modifications
                </button>
            </div>

            {{ form_end(form) }}
        </div>
    </div>

</div>
{% endblock %}", "profile/index.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\profile\\index.html.twig");
    }
}
