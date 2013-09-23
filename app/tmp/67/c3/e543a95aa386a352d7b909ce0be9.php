<?php

/* blog\index.html */
class __TwigTemplate_67c3e543a95aa386a352d7b909ce0be9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'page_content' => array($this, 'block_page_content'),
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
        echo "<div class=\"content-header\">

</div>
<div class=\"content-middle\">
\t<ul class=\"content-list\">
\t\t";
        // line 9
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blogs"]) ? $context["blogs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
            // line 10
            echo "\t\t<li class=\"content-list-item\">
\t\t\t<a href=\"/index.php?c=blog&a=disp&blogid=";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "blogid"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "title"), "html", null, true);
            echo "</a>
\t\t</li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 14
        echo "\t</ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "blog\\index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 14,  43 => 11,  40 => 10,  36 => 9,  29 => 4,  26 => 3,);
    }
}
