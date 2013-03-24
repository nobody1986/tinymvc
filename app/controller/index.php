<?php

class Index_Controller extends Controller {

    function index() {
        $view = Core::viewFactory('index');
        $model = $this->model('sifu');
        $list = $model->getList();
        $view->set('lists',$list);
        $o = $view->render();
        $this->_response->write($o);
    }
    
    function spider(){
        /*
         * 
         * 
         '<tr>
         * <TD width=11%> <a href=http://www.6666yj.com target="_blank"><font color=#000000>━１·８５合击━</font></a></TD>
         * <TD width=11%><a href=http://www.6666yj.com target="_blank">绿色复古85合击</a></TD>
         * <TD class=font_R width=16%>3月/19日/23点开放</TD><TD align=center width=10%>━━长久━━</TD>
         * <TD>━━１８５合击.长期首选·独家一区━-<font color=#ff0000>推荐</font></TD>
         * <TD align=center width=10%>━彻底封挂━</TD>
         * <TD align=center width=7%><a href=http://www.6666yj.com target="_blank">点击查看</a></TD></tr>
         */
        $model = $this->model('sifu');
        $urls = array(
            'http://pk999.tuan917.com/?jdfwkey=48cji'
        );
        $regexs = array(
            '#\'[^<]*?<dl[^>]*?>[^<]*?<dd[^>]*?>([^<]*?)</dd>[^<]*?<dd[^>]*?>([^<]*?)</dd>[^<]*?<dd[^>]*?>([^<]*?)</dd>[^<]*?<dd[^>]*?>([^<]*?)</dd>[^<]*?<dd[^>]*?>([^<]*?)</dd>[^<]*?<dt[^>]*?>([^<]*?)</dt>[^<]*?</dl>\'#i'
        );
        Core::import('lib.toolkit');
        $model->deleteAll();
        foreach($urls as $k => $url){
            $content=  fetchurl($url);
            $content = mb_convert_encoding($content, 'utf8','gbk');
            $content=  str_replace("\n",' ', $content);
            $ret = preg_match_all($regexs[$k], $content,$matches);
            $data = array();
            if($ret > 0){
                var_dump($matches);
                foreach($matches[1] as $k1=>$v1){
                    $data = array(
                        'name' => $v1,
                        'ip' => $matches[2][$k1],
                        'opentime' => $matches[3][$k1],
                        'line' => $matches[4][$k1],
                        'intro' => $matches[5][$k1],
                        'qq' => $matches[6][$k1],
                        'url' => $matches[7][$k1],
                    );
                    $model->newSifu($data);
                }
            }
        }
//        $i = $model->getList(1,1);
//        $model->delete($i['id']);
    }
}