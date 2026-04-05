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

/* dashboard/accueil.html.twig */
class __TwigTemplate_3644ceace2aeec9355a3bbc886900d96 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/accueil.html.twig"));

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

        yield "Accueil - FlahaSmart";
        
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
        yield "<div class=\"container py-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-8\">
            <div class=\"card p-4\">
                <h1 class=\"mb-3\">Bienvenue sur FlahaSmart</h1>
                <p class=\"lead\">Vous êtes connecté. Choisissez votre espace selon votre rôle :</p>

                <div class=\"list-group\">
                    ";
        // line 14
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 15
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_admin");
            yield "\" class=\"list-group-item list-group-item-action\">
                            <strong>Administration</strong> — Accéder au dashboard admin
                        </a>
                    ";
        }
        // line 19
        yield "
                    ";
        // line 20
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_AGRICULTEUR")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_agriculteur");
            yield "\" class=\"list-group-item list-group-item-action\">
                            <strong>Agriculteur</strong> — Voir votre tableau de bord
                        </a>
                    ";
        }
        // line 25
        yield "
                    ";
        // line 26
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_CLIENT")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 27
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_client");
            yield "\" class=\"list-group-item list-group-item-action\">
                            <strong>Client</strong> — Voir votre espace client
                        </a>
                    ";
        }
        // line 31
        yield "                </div>

                <div class=\"mt-4\">
                    <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"btn btn-outline-secondary\">Se déconnecter</a>
                </div>
            </div>
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
        return "dashboard/accueil.html.twig";
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
        return array (  136 => 34,  131 => 31,  123 => 27,  121 => 26,  118 => 25,  110 => 21,  108 => 20,  105 => 19,  97 => 15,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Accueil - FlahaSmart{% endblock %}

{% block body %}
<div class=\"container py-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-8\">
            <div class=\"card p-4\">
                <h1 class=\"mb-3\">Bienvenue sur FlahaSmart</h1>
                <p class=\"lead\">Vous êtes connecté. Choisissez votre espace selon votre rôle :</p>

                <div class=\"list-group\">
                    {% if is_granted('ROLE_ADMIN') %}
                        <a href=\"{{ path('dashboard_admin') }}\" class=\"list-group-item list-group-item-action\">
                            <strong>Administration</strong> — Accéder au dashboard admin
                        </a>
                    {% endif %}

                    {% if is_granted('ROLE_AGRICULTEUR') %}
                        <a href=\"{{ path('dashboard_agriculteur') }}\" class=\"list-group-item list-group-item-action\">
                            <strong>Agriculteur</strong> — Voir votre tableau de bord
                        </a>
                    {% endif %}

                    {% if is_granted('ROLE_CLIENT') %}
                        <a href=\"{{ path('dashboard_client') }}\" class=\"list-group-item list-group-item-action\">
                            <strong>Client</strong> — Voir votre espace client
                        </a>
                    {% endif %}
                </div>

                <div class=\"mt-4\">
                    <a href=\"{{ path('app_logout') }}\" class=\"btn btn-outline-secondary\">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "dashboard/accueil.html.twig", "C:\\xampp\\htdocs\\haSmart-eya\\src\\templates\\dashboard\\accueil.html.twig");
    }
}
