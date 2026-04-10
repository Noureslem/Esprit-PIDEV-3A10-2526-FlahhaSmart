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

/* todo/index.html.twig */
class __TwigTemplate_bcc4ce2effcab3da9bf03b5e9a5388bd extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "todo/index.html.twig"));

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

        yield "Todo List";
        
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
    <h1 class=\"h3\">📋 Liste des tâches</h1>
    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_todo_new");
        yield "\" class=\"btn btn-primary\">+ Ajouter une tâche</a>
</div>

<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"table table-hover mb-0\">
            <thead>
                <tr>
                    <th>Consultant</th>
                    <th>Tâche</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["todos"]) || array_key_exists("todos", $context) ? $context["todos"] : (function () { throw new RuntimeError('Variable "todos" does not exist.', 23, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["todo"]) {
            // line 24
            yield "                <tr>
                    <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "nomTache", [], "any", false, false, false, 25), "html", null, true);
            yield "</td>
                    <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "tache", [], "any", false, false, false, 26), "html", null, true);
            yield "</td>
                    <td>
                        <span class=\"badge 
                            ";
            // line 29
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "statut", [], "any", false, false, false, 29) == "TODO")) {
                yield "bg-warning text-dark
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 30
$context["todo"], "statut", [], "any", false, false, false, 30) == "DOING")) {
                yield "bg-info text-dark
                            ";
            } else {
                // line 31
                yield "bg-success";
            }
            yield "\">
                            ";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "statut", [], "any", false, false, false, 32), "html", null, true);
            yield "
                        </span>
                    </td>
                    <td>
                        <a href=\"";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_todo_edit", ["nomTache" => CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "nomTache", [], "any", false, false, false, 36), "tache" => CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "tache", [], "any", false, false, false, 36)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_todo_delete", ["nomTache" => CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "nomTache", [], "any", false, false, false, 37), "tache" => CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "tache", [], "any", false, false, false, 37)]), "html", null, true);
            yield "\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cette tâche ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken((("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "nomTache", [], "any", false, false, false, 38)) . CoreExtension::getAttribute($this->env, $this->source, $context["todo"], "tache", [], "any", false, false, false, 38))), "html", null, true);
            yield "\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 43
        if (!$context['_iterated']) {
            // line 44
            yield "                <tr><td colspan=\"4\" class=\"text-center\">Aucune tâche trouvée</td></tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['todo'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "            </tbody>
        </table>
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
        return "todo/index.html.twig";
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
        return array (  173 => 46,  166 => 44,  164 => 43,  154 => 38,  150 => 37,  146 => 36,  139 => 32,  134 => 31,  129 => 30,  125 => 29,  119 => 26,  115 => 25,  112 => 24,  107 => 23,  89 => 8,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Todo List{% endblock %}

{% block body %}
<div class=\"d-flex justify-content-between align-items-center mb-4\">
    <h1 class=\"h3\">📋 Liste des tâches</h1>
    <a href=\"{{ path('app_todo_new') }}\" class=\"btn btn-primary\">+ Ajouter une tâche</a>
</div>

<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"table table-hover mb-0\">
            <thead>
                <tr>
                    <th>Consultant</th>
                    <th>Tâche</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for todo in todos %}
                <tr>
                    <td>{{ todo.nomTache }}</td>
                    <td>{{ todo.tache }}</td>
                    <td>
                        <span class=\"badge 
                            {% if todo.statut == 'TODO' %}bg-warning text-dark
                            {% elseif todo.statut == 'DOING' %}bg-info text-dark
                            {% else %}bg-success{% endif %}\">
                            {{ todo.statut }}
                        </span>
                    </td>
                    <td>
                        <a href=\"{{ path('app_todo_edit', {nomTache: todo.nomTache, tache: todo.tache}) }}\" class=\"btn btn-sm btn-outline-primary\">Modifier</a>
                        <form method=\"post\" action=\"{{ path('app_todo_delete', {nomTache: todo.nomTache, tache: todo.tache}) }}\" style=\"display:inline-block;\" onsubmit=\"return confirm('Supprimer cette tâche ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ todo.nomTache ~ todo.tache) }}\">
                            <button class=\"btn btn-sm btn-outline-danger\">Supprimer</button>
                        </form>
                    </td>
                </tr>
                {% else %}
                <tr><td colspan=\"4\" class=\"text-center\">Aucune tâche trouvée</td></tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}", "todo/index.html.twig", "C:\\xampp\\htdocs\\flahasmart\\templates\\todo\\index.html.twig");
    }
}
