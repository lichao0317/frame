<?php
namespace core\model;

class Model{
    //定义数据库连接的属性
    protected static $config;

    public function __call($name, $arguments)
    {
        return self::parseAction($name, $arguments);
    }

    //定义静态调用找不到方法的是hi偶方法
    public static function __callStatic($name, $arguments)
    {
        return self::parseAction($name, $arguments);
    }
    //定义找不到的时候前往什么地方去找这个方法
    public static function parseAction($name, $arguments){
        //获取当前调用类的名称
        $info = get_called_class();
        //然后把info切割成数组 取出下表为2的就是需要调用的类名称
        $table = explode('\\',$info)[2];
        $table = strtolower($table);
        return call_user_func_array([new Base(self::$config,$table),$name],$arguments);
    }
    //定义获取数据库配置项的方法,这个方法用于获取到database文件中的数据库配置
    public static function getConfig($config){
        //将$config变成一个当前对象的属性
        self::$config = $config;
    }
}


?>