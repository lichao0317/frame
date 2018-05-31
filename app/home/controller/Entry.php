<?php
namespace app\home\controller;
use core\view\View;
use core\model\Model;
use system\model\Article;

class Entry{
    public function index(){
        $result = Article::where('id > 20')->get()->toArray();

        return (new View())->make()->with('version','版本:V1.0')->datas($result);
    }
}

?>