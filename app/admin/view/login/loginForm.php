<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container">
        <a class="navbar-brand" href="">Student Manager</a>
        <ul class="nav navbar-nav" style="float: right;">
            <li class="active">
                <a href="">homepage</a>
            </li>
            <li>
                <a href=""><span style="color: red">张三</span>&nbsp;&nbsp;退出</a>
                <!--                    <a href="">登录</a>-->

            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="">homepage</a></li>
        <li class="active">login</li>
    </ol>
    <form method="post" action="">
        <div class="form-group">
            <label for="">username</label>
            <input type="text" class="form-control" id="" placeholder="username" name="username">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <label for="">captcha</label>
            <input type="text" class="form-control" id="" placeholder="code" name="code">
        </div>
        <div class="form-group">
            <img src="index.php?s=admin/login/code" onclick="this.src = 'index.php?s=admin/login/code&a=' + Math.random()">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="autologin"> remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">login</button>
    </form>
</div>
<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://www.houdunwang.com">houdunwang.com</a></li>
                <li><a href="http://www.nickblog.cn">nickblog.cn</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>


</body>
</html>