<?php

/* base.html */
class __TwigTemplate_843f099f2c2854c94ac4cc751fde7d1b extends Twig_Template
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
    <head>
        ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 33
        echo "    </head>
    <body>
        ";
        // line 35
        $this->displayBlock('navbar', $context, $blocks);
        // line 71
        echo "        <div class=\"container\">
            <div class=\"row\">
                <div class=\"span9\">
                    ";
        // line 74
        $this->displayBlock('page_content', $context, $blocks);
        // line 93
        echo "                </div>
                <div class=\"span3 bs-docs-sidebar\">
                    ";
        // line 95
        $this->displayBlock('page_side', $context, $blocks);
        // line 100
        echo "                </div>

            </div>
        </div>
        <div class=\"footer row\">
            ";
        // line 105
        $this->displayBlock('page_footer', $context, $blocks);
        // line 107
        echo "        </div>
        ";
        // line 108
        $this->displayBlock('login_pop', $context, $blocks);
        // line 142
        echo "        ";
        $this->displayBlock('import_js', $context, $blocks);
        // line 146
        echo "        ";
        $this->displayBlock('page_js', $context, $blocks);
        // line 154
        echo "    </body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo " <title>";
        echo twig_escape_filter($this->env, (isset($context["site_title"]) ? $context["site_title"] : null), "html", null, true);
        echo "</title>
        <!-- Bootstrap -->
        <link href=\"/static/css/bootstrap.min.css\" rel=\"stylesheet\">
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
            #login-pop {
                width: 450px;
                height: 280px;
            }
            .content-header {
                height: 100px;
                background-color: green;
            }
            .content-middle {

            }
            ul.content-list li.content-list-item {
                width: 100%;
                height: 150px;
                list-style: none;
                border-bottom: 1px dashed #999999;
            }
            .footer {
                height: 200px;
            }
        </style>
        ";
    }

    // line 35
    public function block_navbar($context, array $blocks = array())
    {
        // line 36
        echo "        <div class=\"navbar navbar-inverse navbar-fixed-top\">
            <div class=\"navbar-inner\">
                <div class=\"container\">
                    <a class=\"brand\" href=\"/\">The Kalimudo</a>
                    <div class=\"nav-collapse collapse\">
                        <ul class=\"nav\">
                            <li class=\"active\">
                                <a href=\"#\">Home</a>
                            </li>
                            <li>
                                <a href=\"#about\">About</a>
                            </li>
                            <li>
                                <a href=\"#contact\">Contact</a>
                            </li>
                        </ul>
                        <ul class=\"nav pull-right\">
                            <li class=\"active\">
                                <a href=\"#\">Home</a>
                            </li>
                            <li class=\"divider-vertical\"></li>
                            <li class=\"dropdown\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">xxxxx<b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"#\">退出</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        ";
    }

    // line 74
    public function block_page_content($context, array $blocks = array())
    {
        // line 75
        echo "                    <div class=\"content-header\">
                        <h1>title</h1>
                    </div>
                    <div class=\"content-middle\">
                        <form>
                            <p>
                                <input class=\"input-xxlarge\" type=\"text\" placeholder=\"title\">
                            </p>
                            <p>
                                <textarea class=\"textarea\" rows=\"30\" style=\"width: 100%;\"></textarea>
                            </p>\t\t\t\t\t\t\t<p>
                                <button type=\"submit\" class=\"btn\">
                                    Submit
                                </button>
                            </p>
                        </form>
                    </div>
                    ";
    }

    // line 95
    public function block_page_side($context, array $blocks = array())
    {
        // line 96
        echo "                    <button type=\"button\" data-toggle=\"modal\" data-target=\"#login-pop\">
                        Launch modal
                    </button>
                    ";
    }

    // line 105
    public function block_page_footer($context, array $blocks = array())
    {
        // line 106
        echo "            ";
    }

    // line 108
    public function block_login_pop($context, array $blocks = array())
    {
        // line 109
        echo "        <div id=\"login-pop\" class=\"modal hide fade\" role=\"dialog\">
            <div class=\"modal-header\">
                登录
            </div>
            <div class=\"modal-body\">
                <form class=\"form-horizontal\">
                    <div class=\"control-group\">
                        <label class=\"control-label\" for=\"inputEmail\">Email</label>
                        <div class=\"controls\">
                            <input type=\"text\" id=\"inputEmail\" placeholder=\"Email\">
                        </div>
                    </div>
                    <div class=\"control-group\">
                        <label class=\"control-label\" for=\"inputPassword\">Password</label>
                        <div class=\"controls\">
                            <input type=\"password\" id=\"inputPassword\" placeholder=\"Password\">
                        </div>
                    </div>
                    <div class=\"control-group\">
                        <div class=\"controls\">
                            <label class=\"checkbox\">
                                <input type=\"checkbox\">
                                Remember me </label>
                            <button type=\"submit\" class=\"btn\">
                                Sign in
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class=\"modal-footer\"></div>
        </div>
        ";
    }

    // line 142
    public function block_import_js($context, array $blocks = array())
    {
        // line 143
        echo "        <script src=\"/static/js/jquery.js\"></script>
        <script src=\"/static/js/bootstrap.min.js\"></script>
        ";
    }

    // line 146
    public function block_page_js($context, array $blocks = array())
    {
        // line 147
        echo "        <script type=\"text/javascript\">
            \$(document).ready(function() {
                //                \$('.dropdown-toggle').dropdown();
            });

        </script>
        ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  245 => 147,  242 => 146,  236 => 143,  233 => 142,  197 => 109,  194 => 108,  190 => 106,  187 => 105,  180 => 96,  177 => 95,  156 => 75,  153 => 74,  115 => 36,  112 => 35,  76 => 4,  71 => 154,  68 => 146,  65 => 142,  63 => 108,  60 => 107,  58 => 105,  51 => 100,  49 => 95,  45 => 93,  38 => 71,  32 => 33,  30 => 4,  25 => 1,  54 => 14,  43 => 74,  40 => 10,  36 => 35,  29 => 4,  26 => 3,);
    }
}
