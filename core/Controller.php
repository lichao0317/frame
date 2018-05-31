<?php
namespace core;

class Controller{

    //定义默认跳转的属性
    protected $url = 'location.href = window.history.back()';

    public function redirect($url = ''){
        //如果用户调用该方法传递了跳转地址的参数,我们就认为用户希望跳转去他传递的地址,如果没有传递,我们就给他返回上一页
        //判断用户是否传递url参数,如果传递了,将url属性改成用户传递的跳转地址,如果没有传递,就用默认地址
        if ($url != ''){
            //如果用户传递了url参数,就将url参数赋值给属性
            $this->url = "location.href = '" . $url . "'";
        }
        return $this;
    }

    //成功或者失败的提示
    public function message($msg){
        //我们不在使用以前的echo script标签的方式给弹窗了,用一个页面来实现跳转
        include 'public/view/message.php';
    }





}




?>