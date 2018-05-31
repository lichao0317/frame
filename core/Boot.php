<?php
namespace core;

class Boot{
    public function run(){
        //检测是否传递S参数
        if(isset($_GET['s'])){
            //如果传递了S参数
            $info= explode('/',$_GET['s']);
            //设置模块
            $m = $info[0];
            $c = $info[1];
            $a = $info[2];
        }else{
            //没有传递S参数设置默认值
            $m = 'home';//默认模块
            $c = 'Entry';//默认控制器
            $a = 'index';//默认方法
        }
        //定义常量
        define('MODELU',$m);
        define('CONTROLLER',$c);
        define('ACTION',$a);

        $class = '\\app\\'.$m.'\\controller\\'.$c;
        echo call_user_func_array([new $class,$a],[]);
    }
}


?>