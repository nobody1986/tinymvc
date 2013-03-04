<?php
class Test_Controller extends Controller{
    function twigview(){
//        echo '<h1>HI</h1>';
        $view = Core::viewFactory('index',array('name' => 'jhasdj'));
        $view->setData(array('ok' => '3dsasadasd21'));
        $view->set('name','snow');
        $e = $view->render();
		$this->_response->write($e);
    }
    
    function rainview(){
//        echo '<h1>HI</h1>';
        $view = Core::viewFactory('test.test1',array('name' => 'jhasdj'));
        $view->render();
    }
}
