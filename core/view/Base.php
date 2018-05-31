<?php
namespace core\view;

class Base{

    protected $file;
    protected $vs = [];
    public function make(){
        $this->file = 'app/'.MODELU.'/view/'.strtolower(CONTROLLER).'/'.ACTION.'.php';
        return $this;
    }

    public function with($name,$value){
        $this->vs[$name] = $value;
        return $this;
    }

    public function datas($result){
        //接受到传递来的'数据库的文章内容',
        $this->news=$result;
        return $this;

    }
    public function __toString()
    {
        extract($this->vs);
        //加载模板
        include $this->file;

        return '';
    }
}


?>