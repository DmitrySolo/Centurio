<?php

/* base.html */
class __TwigTemplate_4b90b7e451d9fb8bb30bb02edd605c178ac1472a5f3b03f304d28c857370ad21 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 23.07.2018
 * Time: 11:58
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>tuu </title>
    </head>
    <body>
        <header>
            <nav>
                    ";
        // line 18
        echo twig_include($this->env, $context, "menu.html");
        echo "
            </nav>
        </header>
    <main>
        ";
        // line 22
        $this->displayBlock('main', $context, $blocks);
        // line 23
        echo "    </main>
    </body>
</html>
";
    }

    // line 22
    public function block_main($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 22,  52 => 23,  50 => 22,  43 => 18,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base.html", "C:\\xampp2\\htdocs\\Centurio\\templates\\base.html");
    }
}
