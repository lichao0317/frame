<?php
namespace app\admin\controller;


use core\view\View;
use core\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class Login extends Controller{

    //定义一个加载登录模板的方法
    public function loginForm(){

        return View::make();
    }


    //生成验证码

    public function code(){
        $phraseBuilder = new PhraseBuilder(4,'1234567890');
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        //将生成的验证码存入session
        $_SESSION['code'] = $builder->getPhrase();
    }

}

?>