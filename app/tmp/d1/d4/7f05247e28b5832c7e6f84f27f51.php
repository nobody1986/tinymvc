<?php

/* blog\disp.html */
class __TwigTemplate_d1d47f05247e28b5832c7e6f84f27f51 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'page_content' => array($this, 'block_page_content'),
            'page_js' => array($this, 'block_page_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_content($context, array $blocks = array())
    {
        // line 4
        echo "\t\t<div class=\"content-header\">
\t\t</div>
\t\t<div class=\"content-middle\">
\t\t<form action=\"";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["post_url"]) ? $context["post_url"] : null), "html", null, true);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
\t\t<div class=\"title\">
\t\t<h2>";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "title"), "html", null, true);
        echo "</h2>
\t\t</div>
\t\t<div class=\"content\">
\t\t";
        // line 12
        echo $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "content");
        echo "
\t\t</div>
\t\t</form>

\t\t</div>
";
    }

    // line 18
    public function block_page_js($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "blog\\disp.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 18,  46 => 12,  40 => 9,  35 => 7,  30 => 4,  27 => 3,);
    }
}
