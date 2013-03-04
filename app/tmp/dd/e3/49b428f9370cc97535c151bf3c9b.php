<?php

/* base.html */
class __TwigTemplate_dde349b428f9370cc97535c151bf3c9b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'navbar' => array($this, 'block_navbar'),
            'page_content' => array($this, 'block_page_content'),
            'page_side' => array($this, 'block_page_side'),
            'page_footer' => array($this, 'block_page_footer'),
            'login_pop' => array($this, 'block_login_pop'),
            'import_js' => array($this, 'block_import_js'),
            'page_js' => array($this, 'block_page_js'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"zh-cn\">
\t<head>
\t\t";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 33
        echo "\t</head>
\t<body>
\t\t";
        // line 35
        $this->displayBlock('navbar', $context, $blocks);
        // line 71
        echo "\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"span9\">
\t\t\t\t\t";
        // line 74
        $this->displayBlock('page_content', $context, $blocks);
        // line 93
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"span3 bs-docs-sidebar\">
\t\t\t\t\t";
        // line 95
        $this->displayBlock('page_side', $context, $blocks);
        // line 100
        echo "\t\t\t\t</div>
\t\t\t\t
\t\t\t</div>
\t\t</div>
\t\t<div class=\"footer row\">
\t\t\t";
        // line 105
        $this->displayBlock('page_footer', $context, $blocks);
        // line 107
        echo "\t\t</div>
\t\t";
        // line 108
        $this->displayBlock('login_pop', $context, $blocks);
        // line 142
        echo "\t\t";
        $this->displayBlock('import_js', $context, $blocks);
        // line 146
        echo "\t\t";
        $this->displayBlock('page_js', $context, $blocks);
        // line 154
        echo "\t</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo " <title>";
        echo twig_escape_filter($this->env, (isset($context["site_title"]) ? $context["site_title"] : null), "html", null, true);
        echo "</title>
\t\t<!-- Bootstrap -->
\t\t<link href=\"/static/css/bootstrap.min.css\" rel=\"stylesheet\">
\t\t<style>
\t\t\tbody {
\t\t\t\tpadding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
\t\t\t}
\t\t\t#login-pop {
\t\t\t\twidth: 450px;
\t\t\t\theight: 280px;
\t\t\t}
\t\t\t.content-header {
\t\t\t\theight: 100px;
\t\t\t\tbackground-color: green;
\t\t\t}
\t\t\t.content-middle {

\t\t\t}
\t\t\tul.content-list li.content-list-item {
\t\t\t\twidth: 100%;
\t\t\t\theight: 150px;
\t\t\t\tlist-style: none;
\t\t\t\tborder-bottom: 1px dashed #999999;
\t\t\t}
\t\t\t.footer {
\t\t\t\theight: 200px;
\t\t\t}
\t\t</style>
\t\t";
    }

    // line 35
    public function block_navbar($context, array $blocks = array())
    {
        // line 36
        echo "\t\t<div class=\"navbar navbar-inverse navbar-fixed-top\">
\t\t\t<div class=\"navbar-inner\">
\t\t\t\t<div class=\"container\">
\t\t\t\t\t<a class=\"brand\" href=\"/\">The Kalimudo</a>
\t\t\t\t\t<div class=\"nav-collapse collapse\">
\t\t\t\t\t\t<ul class=\"nav\">
\t\t\t\t\t\t\t<li class=\"active\">
\t\t\t\t\t\t\t\t<a href=\"#\">Home</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a href=\"#about\">About</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a href=\"#contact\">Contact</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<ul class=\"nav pull-right\">
\t\t\t\t\t\t\t<li class=\"active\">
\t\t\t\t\t\t\t\t<a href=\"#\">Home</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"divider-vertical\"></li>
\t\t\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">xxxxx<b class=\"caret\"></b></a>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t<a href=\"#\">退出</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div><!--/.nav-collapse -->
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t";
    }

    // line 74
    public function block_page_content($context, array $blocks = array())
    {
        // line 75
        echo "\t\t\t\t\t<div class=\"content-header\">
\t\t\t\t\t\t<h1>title</h1>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"content-middle\">
\t\t\t\t\t\t<form>
\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t<input class=\"input-xxlarge\" type=\"text\" placeholder=\"title\">
\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t<textarea class=\"textarea\" rows=\"30\" style=\"width: 100%;\"></textarea>
</p>\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn\">
\t\t\t\t\t\t\t\t\tSubmit
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t</form>
\t\t\t\t\t</div>
\t\t\t\t\t";
    }

    // line 95
    public function block_page_side($context, array $blocks = array())
    {
        // line 96
        echo "\t\t\t\t\t<button type=\"button\" data-toggle=\"modal\" data-target=\"#login-pop\">
\t\t\t\t\t\tLaunch modal
\t\t\t\t\t</button>
\t\t\t\t\t";
    }

    // line 105
    public function block_page_footer($context, array $blocks = array())
    {
        // line 106
        echo "\t\t\t";
    }

    // line 108
    public function block_login_pop($context, array $blocks = array())
    {
        // line 109
        echo "\t\t<div id=\"login-pop\" class=\"modal hide fade\" role=\"dialog\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t登录
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<form class=\"form-horizontal\">
\t\t\t\t\t<div class=\"control-group\">
\t\t\t\t\t\t<label class=\"control-label\" for=\"inputEmail\">Email</label>
\t\t\t\t\t\t<div class=\"controls\">
\t\t\t\t\t\t\t<input type=\"text\" id=\"inputEmail\" placeholder=\"Email\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"control-group\">
\t\t\t\t\t\t<label class=\"control-label\" for=\"inputPassword\">Password</label>
\t\t\t\t\t\t<div class=\"controls\">
\t\t\t\t\t\t\t<input type=\"password\" id=\"inputPassword\" placeholder=\"Password\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"control-group\">
\t\t\t\t\t\t<div class=\"controls\">
\t\t\t\t\t\t\t<label class=\"checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\">
\t\t\t\t\t\t\t\tRemember me </label>
\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn\">
\t\t\t\t\t\t\t\tSign in
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\"></div>
\t\t</div>
\t\t";
    }

    // line 142
    public function block_import_js($context, array $blocks = array())
    {
        // line 143
        echo "\t\t<script src=\"/static/js/jquery.js\"></script>
\t\t<script src=\"/static/js/bootstrap.min.js\"></script>
\t\t";
    }

    // line 146
    public function block_page_js($context, array $blocks = array())
    {
        // line 147
        echo "\t\t<script type=\"text/javascript\">
\t\t\t\$(document).ready(function() {
\t\t\t\t//                \$('.dropdown-toggle').dropdown();
\t\t\t});

\t\t</script>
\t\t";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  245 => 147,  242 => 146,  236 => 143,  233 => 142,  197 => 109,  194 => 108,  190 => 106,  187 => 105,  180 => 96,  177 => 95,  156 => 75,  153 => 74,  115 => 36,  112 => 35,  76 => 4,  71 => 154,  68 => 146,  65 => 142,  63 => 108,  60 => 107,  58 => 105,  51 => 100,  49 => 95,  45 => 93,  43 => 74,  38 => 71,  36 => 35,  32 => 33,  25 => 1,  56 => 18,  46 => 12,  40 => 9,  35 => 7,  30 => 4,  27 => 3,);
    }
}
