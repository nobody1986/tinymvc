<?php
class Test_Controller extends Controller{
    function index(){
//        echo '<h1>HI</h1>';
        $view = Core::viewFactory('test.index',array('mime' => 'jhasdj'));
        $view->setData(array('ok' => '3dsasadasd21'));
        $view->set('name','snow');
        $view->render();
    }
    
    function index1(){
//        echo '<h1>HI</h1>';
        $view = Core::viewFactory('test.test1',array('name' => 'jhasdj'));
        $view->render();
    }
}
?>