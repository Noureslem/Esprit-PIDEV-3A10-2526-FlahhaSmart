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

/* admin/admin_user_form.html.twig */
class __TwigTemplate_45837eaabbeab0ab8e138bf21668a6ee extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_user_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_user_form.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 2, $this->source); })()), "html", null, true);
        yield " — FlahaSmart";
        
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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 3, $this->source); })()), "html", null, true);
        
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
        yield "<div class=\"row justify-content-center\">
    <div class=\"col-lg-7\">

        <div class=\"card p-4\">

            ";
        // line 11
        if ((($tmp = (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 11, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 12
            yield "            ";
            // line 13
            yield "            <div class=\"d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded\">
                <div style=\"font-size:2.5rem;\">👤</div>
                <div>
                    <div class=\"fw-bold fs-5\">";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 16, $this->source); })()), "fullName", [], "any", false, false, false, 16), "html", null, true);
            yield "</div>
                    <div class=\"text-muted small\">";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 17, $this->source); })()), "email", [], "any", false, false, false, 17), "html", null, true);
            yield "</div>
                    <span class=\"badge badge-";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 18, $this->source); })()), "role", [], "any", false, false, false, 18), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 18, $this->source); })()), "role", [], "any", false, false, false, 18), "html", null, true);
            yield "</span>
                    ";
            // line 19
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 19, $this->source); })()), "actif", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 20
                yield "                        <span class=\"badge bg-success ms-1\">Actif</span>
                    ";
            } else {
                // line 22
                yield "                        <span class=\"badge bg-danger ms-1\">Inactif</span>
                    ";
            }
            // line 24
            yield "                </div>
            </div>
            ";
        }
        // line 27
        yield "
            ";
        // line 28
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), 'form_start');
        yield "

            <div class=\"row g-3\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "nom", [], "any", false, false, false, 32), 'label');
        yield "</label>
                    ";
        // line 33
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), "nom", [], "any", false, false, false, 33), 'widget');
        yield "
                    ";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "nom", [], "any", false, false, false, 34), 'errors');
        yield "
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "prenom", [], "any", false, false, false, 37), 'label');
        yield "</label>
                    ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "prenom", [], "any", false, false, false, 38), 'widget');
        yield "
                </div>
            </div>

            <div class=\"mt-3\">
                <label class=\"form-label fw-semibold\">";
        // line 43
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), "email", [], "any", false, false, false, 43), 'label');
        yield "</label>
                ";
        // line 44
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), "email", [], "any", false, false, false, 44), 'widget');
        yield "
                ";
        // line 45
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 45, $this->source); })()), "email", [], "any", false, false, false, 45), 'errors');
        yield "
            </div>

            <div class=\"row g-3 mt-1\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "telephone", [], "any", false, false, false, 50), 'label');
        yield "</label>
                    ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "telephone", [], "any", false, false, false, 51), 'widget');
        yield "
                </div>
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "ville", [], "any", false, false, false, 54), 'label');
        yield "</label>
                    ";
        // line 55
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 55, $this->source); })()), "ville", [], "any", false, false, false, 55), 'widget');
        yield "
                </div>
            </div>

            <div class=\"row g-3 mt-1\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">";
        // line 61
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 61, $this->source); })()), "role", [], "any", false, false, false, 61), 'label');
        yield "</label>
                    ";
        // line 62
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), "role", [], "any", false, false, false, 62), 'widget');
        yield "
                </div>
                <div class=\"col-md-6 d-flex align-items-end pb-1\">
                    <div class=\"form-check\">
                        ";
        // line 66
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), "actif", [], "any", false, false, false, 66), 'widget');
        yield "
                        <label class=\"form-check-label fw-semibold\" for=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "actif", [], "any", false, false, false, 67), "vars", [], "any", false, false, false, 67), "id", [], "any", false, false, false, 67), "html", null, true);
        yield "\">
                            Compte actif
                        </label>
                    </div>
                </div>
            </div>

            <hr class=\"my-4\">

            <div>
                <label class=\"form-label fw-semibold\">";
        // line 77
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), "plainPassword", [], "any", false, false, false, 77), 'label');
        yield "</label>
                ";
        // line 78
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), "plainPassword", [], "any", false, false, false, 78), 'widget');
        yield "
                ";
        // line 79
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 79, $this->source); })()), "plainPassword", [], "any", false, false, false, 79), 'errors');
        yield "
            </div>

            <div class=\"d-flex gap-2 mt-4\">
                <button type=\"submit\" class=\"btn btn-success px-4 fw-semibold\">
                    <i class=\"bi bi-check-circle\"></i>
                    ";
        // line 85
        yield (((($tmp = (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 85, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Enregistrer") : ("Créer l'utilisateur"));
        yield "
                </button>
                <a href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" class=\"btn btn-outline-secondary\">
                    <i class=\"bi bi-arrow-left\"></i> Retour
                </a>
            </div>

            ";
        // line 92
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 92, $this->source); })()), 'form_end');
        yield "
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
        return "admin/admin_user_form.html.twig";
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
        return array (  303 => 92,  295 => 87,  290 => 85,  281 => 79,  277 => 78,  273 => 77,  260 => 67,  256 => 66,  249 => 62,  245 => 61,  236 => 55,  232 => 54,  226 => 51,  222 => 50,  214 => 45,  210 => 44,  206 => 43,  198 => 38,  194 => 37,  188 => 34,  184 => 33,  180 => 32,  173 => 28,  170 => 27,  165 => 24,  161 => 22,  157 => 20,  155 => 19,  149 => 18,  145 => 17,  141 => 16,  136 => 13,  134 => 12,  132 => 11,  125 => 6,  112 => 5,  89 => 3,  65 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}{{ title }} — FlahaSmart{% endblock %}
{% block page_title %}{{ title }}{% endblock %}

{% block body %}
<div class=\"row justify-content-center\">
    <div class=\"col-lg-7\">

        <div class=\"card p-4\">

            {% if user %}
            {# Infos résumé en haut pour la modif #}
            <div class=\"d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded\">
                <div style=\"font-size:2.5rem;\">👤</div>
                <div>
                    <div class=\"fw-bold fs-5\">{{ user.fullName }}</div>
                    <div class=\"text-muted small\">{{ user.email }}</div>
                    <span class=\"badge badge-{{ user.role }}\">{{ user.role }}</span>
                    {% if user.actif %}
                        <span class=\"badge bg-success ms-1\">Actif</span>
                    {% else %}
                        <span class=\"badge bg-danger ms-1\">Inactif</span>
                    {% endif %}
                </div>
            </div>
            {% endif %}

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

            <div class=\"row g-3 mt-1\">
                <div class=\"col-md-6\">
                    <label class=\"form-label fw-semibold\">{{ form_label(form.role) }}</label>
                    {{ form_widget(form.role) }}
                </div>
                <div class=\"col-md-6 d-flex align-items-end pb-1\">
                    <div class=\"form-check\">
                        {{ form_widget(form.actif) }}
                        <label class=\"form-check-label fw-semibold\" for=\"{{ form.actif.vars.id }}\">
                            Compte actif
                        </label>
                    </div>
                </div>
            </div>

            <hr class=\"my-4\">

            <div>
                <label class=\"form-label fw-semibold\">{{ form_label(form.plainPassword) }}</label>
                {{ form_widget(form.plainPassword) }}
                {{ form_errors(form.plainPassword) }}
            </div>

            <div class=\"d-flex gap-2 mt-4\">
                <button type=\"submit\" class=\"btn btn-success px-4 fw-semibold\">
                    <i class=\"bi bi-check-circle\"></i>
                    {{ user ? 'Enregistrer' : 'Créer l\\'utilisateur' }}
                </button>
                <a href=\"{{ path('admin_users') }}\" class=\"btn btn-outline-secondary\">
                    <i class=\"bi bi-arrow-left\"></i> Retour
                </a>
            </div>

            {{ form_end(form) }}
        </div>

    </div>
</div>
{% endblock %}
", "admin/admin_user_form.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\admin\\admin_user_form.html.twig");
    }
}
