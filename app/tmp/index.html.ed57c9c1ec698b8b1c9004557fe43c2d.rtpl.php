<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link rel="stylesheet" href="/static/default/css/styles-site.css" type="text/css" />
        <link rel="stylesheet" type="text/css" media="all" href="/static/default/css/mtcolorer.css" />
        <script language="javascript" src="/static/js/jquery-1.7.1.min.js"></script>
        <script language="javascript" src="/static/js/jquery-ui-1.8.17.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="/static/css/smoothness/jquery-ui-1.8.17.custom.css" />
        <title><?php echo $site_config["title"];?></title>
    </head>
    <body class="layout-two-column-right">
        <div id="container">
            <div id="container-inner" class="pkg">

                <div id="banner">
                    <div id="banner-inner" class="pkg">
                        <h1 id="banner-header"><a href="http://blog.codingnow.com/" accesskey="1"><?php echo $site_config["title"];?></a></h1>
                        <h2 id="banner-description"><?php echo $site_config["desc"];?></h2>

                    </div>
                </div>

                <div id="pagebody">
                    <div id="pagebody-inner" class="pkg">
                        <div id="alpha">
                            <div id="alpha-inner" class="pkg">
                                <h2 class="date-header">February 02, 2012</h2>
                                <a id="a000745"></a>
                                <div class="entry" id="entry-745">
                                    <h3 class="entry-header">Ring Buffer 的应用</h3>
                                    <div class="entry-content">
                                        <div class="entry-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="beta">
                            <div id="beta-inner" class="pkg">
<!--                                <h2 class="module-header">Misc</h2>

                                <div class="module-content">
                                    <ul class="module-list">
                                        <li class="module-list-item"><a href="http://blog.codingnow.com/cloud">云风个人Wiki</a></li>
                                    </ul>
                                </div>-->

<!--                                <div>                     
                                    <iframe src="http://www.google.com/talk/service/badge/Show?tk=z01q6amlq4vptg7v5efd9939c4298f2fhpbk2pmqvsk5jtttcn4deqlsg6e499h6klmjkppl8k7sc562fop19murspj8cc85huhon0sbonb9m154te7lpjpvcmm35n675me2mjk4du1hhdpg&w=200&h=60" frameborder="0" allowtransparency="true" width="200" height="60"></iframe>
                                </div>-->
                                <div class="module-search module">
                                    <h2 class="module-header">Search</h2>
                                    <div class="module-content">
                                        <form method="get" action="http://linode.codingnow.com/cgi-bin/mt/mt-search.cgi">
                                            <input type="hidden" name="IncludeBlogs" value="1" />
                                            <input id="search" name="search" size="20" />

                                            <input type="submit" value="站内搜索" />
                                        </form>
                                    </div>
                                </div>
                                <div class="module-categories module">
                                    <h2 class="module-header">Categories</h2>
                                    <div class="module-content">
                                        <ul class="module-list">
                                            <li class="module-list-item"><a href="http://blog.codingnow.com/ooc/" title="">杂记</a> (138)
                                            </li>
                                        </ul>

                                    </div>
                                </div>


                                <div class="module-archives module">

                                    <h2 class="module-header"><a href="http://blog.codingnow.com/archives.html">Archives</a></h2>
                                    <div class="module-content">
                                        <ul class="module-list">
                                            <li class="module-list-item"><a href="http://blog.codingnow.com/2012/02/">February 2012</a> (1)</li>
                                        </ul>

                                    </div>
                                </div>

                                <div class="module-archives module">
                                    <h2 class="module-header">Recent Posts</h2>
                                    <div class="module-content">
                                        <ul class="module-list">
                                            <li class="module-list-item"><a href="http://blog.codingnow.com/2012/02/ring_buffer.html">Ring Buffer 的应用</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="module-archives module">
                                    <h2 class="module-header">Recent Comments</h2>
                                    <div class="module-content">
                                        <ul class="module-list">
                                            <li class="module-list-item">
                                                <p>		<a href="http://blog.codingnow.com/2012/01/ticket_queue.html#c42341">铁路订票系统的简单设计</a> (56)<br>
                                                        :
                                                        WOW刚刚出来的时候就有登录用户过多时的排队系统了...

                                                        </li>
                                                        </ul>

                                                        </div>
                                                        </div>
                                                        <div class="module-syndicate module">
                                                            <div class="module-content">
                                                                <a href="http://blog.codingnow.com/atom.xml">订阅 feed</a><br />
                                                                <?php if( !$isLogined ){ ?>
                                                                <a href="javascript:;" id="link_login">Login</a><br />
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div id="login_pop">
                                                            <form action="<?php echo $login_url;?>" method="post">
                                                                <div><label>UserName:</label><input type="text" id="name" name="name" /></div>
                                                                <div><label>Password:</label><input type="password" id="passwd" name="passwd" /></div>
                                                                <div><input type="button" value="submit" id="login_button"/></div>
                                                            </form>
                                                        </div>
                                                        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
                                                        </script>
                                                        <script type="text/javascript">
                                                            $(document).ready(function(){
                                                                $("#login_pop").dialog({ autoOpen: false });
                                                                $("#link_login").click(function(){
                                                                    $("#login_pop").dialog("open");
                                                                });
                                                                $("#login_button").click(function(){
                                                                    $.ajax({ url: "<?php echo $login_url;?>", 
                                                                        type:"POST",
                                                                        dataType:"json",
                                                                        data:{'name':$("#name").val(),'passwd':$("#passwd").val()},
                                                                       success: function(data){
                                                                            //alert(data);
                                                                            if(data.success){
                                                                                window.location.reload();
                                                                            }
                                                                        }});
                                                                });
                                                            });
                                                        </script>
                                                        </body>
                                                        </html>