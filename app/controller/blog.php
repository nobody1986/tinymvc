<?php

class Blog_Controller extends Controller {

    function post() {
        if (empty($_POST['content'])) {
            $view = Core::viewFactory('blog.post');
            $view->set('login_url', "/index.php?c=auth&a=login");
            $view->set('nickname', 'ssss');
            $view->set('addr', 'zzzz');
            $view->set('post_url', '/index.php?c=blog&a=post');
            $o = $view->render();
            $this->_response->write($o);
        } else {
            $model = $this->model('blog');
            $blogid = $model->post(1, $_POST['title'], $_POST['content']);

            $tags = trim($_POST['tags']);
            if (!empty($tags)) {
                $model = $this->model('tag');
                $tags = explode(',', $tags);
                foreach ($tags as $tag) {
                    $tagid = $model->getId($tag);
                    if (!$tagid) {
                        $tagid = $model->newTag($tag);
                    }
                    $model->toTag($tagid, $blogid);
                }
            }
        }
    }

    function index() {
        $model = $this->model('blog');
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $num = 10;
        $uid = 1;
        $blogs = $model->getList($uid, $page, $num);

        $catalogs = array();
        $model = $this->model('catalog');
        $catalogs_tmp = $model->getAll();
        if (!empty($catalogs_tmp)) {
            foreach ($catalogs_tmp as $cata) {
                $catalogs[$cata['cataid']] = $model->getCount($cata['cataid']);
            }
        }

        $view = Core::viewFactory('blog.index');
        $model = $this->model('user');
        $isLogined = $model->isLogined();
        $view->set('isLogined', $isLogined);
        $view->set('blogs', $blogs);
        $view->set('login_url', "/index.php?c=auth&a=login");
        $view->set('catalogs', $catalogs);
        $view->set('site_info', Core::config('site_info'));
        $o = $view->render();
        $this->_response->write($o);
    }

    function disp() {
        $model = $this->model('blog');
        if (!isset($_GET['blogid'])) {
            $this->_response->redirect('/?c=blog&a=index');
        }
        $uid = 1;
        $blogid = intval($_GET['blogid']);
        $blog = $model->getOne($uid, $blogid);

        $model = $this->model('user');
        $isLogined = $model->isLogined();
        $view = Core::viewFactory('blog.disp');
        $view->set('login_url', "/index.php?c=auth&a=login");
        $view->set('isLogined', $isLogined);
        $view->set('blog', $blog);
        $view->set('site_config', Core::config('site_info'));
        $o = $view->render();
        $this->_response->write($o);
    }

}
