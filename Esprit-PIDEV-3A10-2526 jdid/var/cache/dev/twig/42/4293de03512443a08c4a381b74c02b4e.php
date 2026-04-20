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

/* cart/index.html.twig */
class __TwigTemplate_2175c7fb9ebe51605c9f4872e9390a8f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cart/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cart/index.html.twig"));

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

        yield "Mon panier - FlahaSmart";
        
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
        yield "<div class=\"container\">
    <h1>🛒 Mon panier</h1>
    ";
        // line 8
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["cart"]) || array_key_exists("cart", $context) ? $context["cart"] : (function () { throw new RuntimeError('Variable "cart" does not exist.', 8, $this->source); })()))) {
            // line 9
            yield "        <div class=\"alert alert-info\">Votre panier est vide. <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index");
            yield "\">Continuer vos achats</a></div>
    ";
        } else {
            // line 11
            yield "        <table class=\"table table-hover\">
            <thead>
                <tr><th>Article</th><th>Prix unitaire</th><th>Quantité</th><th>Sous-total</th><th></th></tr>
            </thead>
            <tbody>
                ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["cart"]) || array_key_exists("cart", $context) ? $context["cart"] : (function () { throw new RuntimeError('Variable "cart" does not exist.', 16, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                yield "                <tr>
                    <td><a href=\"";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 18), "id", [], "any", false, false, false, 18)]), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 18), "nom", [], "any", false, false, false, 18), "html", null, true);
                yield "</a></td>
                    <td>";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 19), "prix", [], "any", false, false, false, 19), "html", null, true);
                yield " €</td>
                    <td>
                        <div class=\"input-group w-50\">
                            <input type=\"number\" value=\"";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 22), "html", null, true);
                yield "\" min=\"1\" max=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 22), "stock", [], "any", false, false, false, 22), "html", null, true);
                yield "\" class=\"form-control quantity-input\" data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 22), "id", [], "any", false, false, false, 22), "html", null, true);
                yield "\">
                            <button class=\"btn btn-outline-secondary update-qty\" data-id=\"";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 23), "id", [], "any", false, false, false, 23), "html", null, true);
                yield "\">Mettre à jour</button>
                        </div>
                    </td>
                    <td>";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "subtotal", [], "any", false, false, false, 26), "html", null, true);
                yield " €</td>
                    <td><a href=\"";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart_remove", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "article", [], "any", false, false, false, 27), "id", [], "any", false, false, false, 27)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-danger\">Supprimer</a></td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 30
            yield "            </tbody>
            <tfoot>
                <tr class=\"table-success\">
                    <td colspan=\"3\" class=\"text-end\"><strong>Total :</strong></td>
                    <td><strong>";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 34, $this->source); })()), "html", null, true);
            yield " €</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class=\"d-flex justify-content-between\">
            <a href=\"";
            // line 40
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_shop_index");
            yield "\" class=\"btn btn-secondary\">Continuer les achats</a>
            <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#checkoutModal\">
                Valider la commande
            </button>
        </div>
    ";
        }
        // line 46
        yield "</div>

<!-- MODALE pour les infos de commande -->
<div class=\"modal fade\" id=\"checkoutModal\" tabindex=\"-1\" aria-labelledby=\"checkoutModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form method=\"post\" action=\"";
        // line 52
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart_checkout_submit");
        yield "\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"checkoutModalLabel\">Finaliser votre commande</h5>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                </div>
                <div class=\"modal-body\">
                    <div class=\"mb-3\">
                        <label for=\"statut\" class=\"form-label\">Statut</label>
                        <input type=\"text\" class=\"form-control\" id=\"statut\" name=\"statut\" required placeholder=\"Ex: En attente, Payé, Expédié...\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"modePaiement\" class=\"form-label\">Mode de paiement</label>
                        <input type=\"text\" class=\"form-control\" id=\"modePaiement\" name=\"modePaiement\" required placeholder=\"Carte bancaire, PayPal, ...\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"adresse\" class=\"form-label\">Adresse de livraison</label>
                        <textarea class=\"form-control\" id=\"adresse\" name=\"adresse\" rows=\"2\" required placeholder=\"Votre adresse complète\"></textarea>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Annuler</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Confirmer la commande</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.update-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            let id = this.dataset.id;
            let input = this.parentElement.querySelector('.quantity-input');
            let qty = input.value;
            window.location.href = `/cart/update/\${id}/\${qty}`;
        });
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
        return "cart/index.html.twig";
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
        return array (  197 => 52,  189 => 46,  180 => 40,  171 => 34,  165 => 30,  156 => 27,  152 => 26,  146 => 23,  138 => 22,  132 => 19,  126 => 18,  123 => 17,  119 => 16,  112 => 11,  106 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon panier - FlahaSmart{% endblock %}

{% block body %}
<div class=\"container\">
    <h1>🛒 Mon panier</h1>
    {% if cart is empty %}
        <div class=\"alert alert-info\">Votre panier est vide. <a href=\"{{ path('app_shop_index') }}\">Continuer vos achats</a></div>
    {% else %}
        <table class=\"table table-hover\">
            <thead>
                <tr><th>Article</th><th>Prix unitaire</th><th>Quantité</th><th>Sous-total</th><th></th></tr>
            </thead>
            <tbody>
                {% for item in cart %}
                <tr>
                    <td><a href=\"{{ path('app_shop_show', {id: item.article.id}) }}\">{{ item.article.nom }}</a></td>
                    <td>{{ item.article.prix }} €</td>
                    <td>
                        <div class=\"input-group w-50\">
                            <input type=\"number\" value=\"{{ item.quantity }}\" min=\"1\" max=\"{{ item.article.stock }}\" class=\"form-control quantity-input\" data-id=\"{{ item.article.id }}\">
                            <button class=\"btn btn-outline-secondary update-qty\" data-id=\"{{ item.article.id }}\">Mettre à jour</button>
                        </div>
                    </td>
                    <td>{{ item.subtotal }} €</td>
                    <td><a href=\"{{ path('app_cart_remove', {id: item.article.id}) }}\" class=\"btn btn-sm btn-danger\">Supprimer</a></td>
                </tr>
                {% endfor %}
            </tbody>
            <tfoot>
                <tr class=\"table-success\">
                    <td colspan=\"3\" class=\"text-end\"><strong>Total :</strong></td>
                    <td><strong>{{ total }} €</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class=\"d-flex justify-content-between\">
            <a href=\"{{ path('app_shop_index') }}\" class=\"btn btn-secondary\">Continuer les achats</a>
            <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#checkoutModal\">
                Valider la commande
            </button>
        </div>
    {% endif %}
</div>

<!-- MODALE pour les infos de commande -->
<div class=\"modal fade\" id=\"checkoutModal\" tabindex=\"-1\" aria-labelledby=\"checkoutModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form method=\"post\" action=\"{{ path('app_cart_checkout_submit') }}\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"checkoutModalLabel\">Finaliser votre commande</h5>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                </div>
                <div class=\"modal-body\">
                    <div class=\"mb-3\">
                        <label for=\"statut\" class=\"form-label\">Statut</label>
                        <input type=\"text\" class=\"form-control\" id=\"statut\" name=\"statut\" required placeholder=\"Ex: En attente, Payé, Expédié...\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"modePaiement\" class=\"form-label\">Mode de paiement</label>
                        <input type=\"text\" class=\"form-control\" id=\"modePaiement\" name=\"modePaiement\" required placeholder=\"Carte bancaire, PayPal, ...\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"adresse\" class=\"form-label\">Adresse de livraison</label>
                        <textarea class=\"form-control\" id=\"adresse\" name=\"adresse\" rows=\"2\" required placeholder=\"Votre adresse complète\"></textarea>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Annuler</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Confirmer la commande</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.update-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            let id = this.dataset.id;
            let input = this.parentElement.querySelector('.quantity-input');
            let qty = input.value;
            window.location.href = `/cart/update/\${id}/\${qty}`;
        });
    });
</script>
{% endblock %}", "cart/index.html.twig", "C:\\xampp\\htdocs\\Esprit-PIDEV-3A10-2526-FlahhaSmart-bachar-integration\\src\\templates\\cart\\index.html.twig");
    }
}
