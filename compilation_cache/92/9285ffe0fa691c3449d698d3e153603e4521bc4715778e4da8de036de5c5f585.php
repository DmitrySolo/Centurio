<?php

/* menu.html */
class __TwigTemplate_10a9ce26c9e3e4f233c09dfac8d7a9dbca75f854d499e9f1415b26d4b0f1b614 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<ul>
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menuArr"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 3
            echo "        <li class=\"menu\" ><a href='";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["menu"], "href", array()), "html", null, true);
            echo "'>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["menu"], "name", array()), "html", null, true);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 5
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "menu.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 5,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "menu.html", "C:\\xampp2\\htdocs\\Centurio\\templates\\menu.html");
    }
}
