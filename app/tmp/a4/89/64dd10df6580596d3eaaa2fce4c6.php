<?php

/* blog\post.html */
class __TwigTemplate_a48964dd10df6580596d3eaaa2fce4c6 extends Twig_Template
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
\t\t<h2>This is a test</h2>
\t\t</div>
\t\t<div class=\"content\">
\t\t<div class=\"post_form\">
\t\t<div class=\"post_title\"><input name=\"title\" type=\"text\"/></div>
\t\t<div class=\"post_content\"><textarea id=\"post_content\" name=\"content\"></textarea></div>
\t\t<div class=\"post_tags\"><input type=\"text\" name=\"tags\"/></div>
\t\t<div class=\"post_submit\"><input type=\"submit\" value=\"发布\"/></div>
\t\t</div>
\t\t</div>
\t\t</form>

\t\t</div>
";
    }

    // line 24
    public function block_page_js($context, array $blocks = array())
    {
        // line 25
        echo "\t\t<link charset=\"utf-8\" href=\"/static/ueditor/themes/default/ueditor.css\" rel=\"stylesheet\" type=\"text/css\"\" />
\t\t<script type=\"text/javascript\" src=\"/static/ueditor/editor_config.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/static/ueditor/editor_all.js\"></script>
\t\t<script type=\"text/javascript\">
\t\t\$(document).ready(function(){
\t\tvar editor = new baidu.editor.ui.Editor();
\t\teditor.render(\"post_content\");
\t\t});
\t\t</script>
\t\t";
    }

    public function getTemplateName()
    {
        return "blog\\post.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 25,  55 => 24,  35 => 7,  30 => 4,  27 => 3,);
    }
}
