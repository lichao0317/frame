<?php

namespace core\model;
class Base{
    //定义PDO属性
    protected $pdo;
    //定义表名
    protected $table;
    //定义查询表数据的where属性
    protected static $where = '';
    //定义静态主键值属性
    protected static $pri;

    //定义一个构造函数.传递数据库参数和表数据参数
    public function __construct($config,$table)
    {
        //获取表名赋值给属性
        $this->table = $table;
        //加载自动连接数据库的方法
        $this->connect($config);
    }

    //定义一个自动连接数据库的方法..传递数据库参数config
    public function connect($config){
        //对连接数据库的PDO属性进行判断是否为NULL。如果为NULL就连接数据库
        if(is_null($this->pdo)){
            //组合数据库查询SQL命令语句
            $dsn = 'mysql:host='.$config['host'].';dbname=' . $config['dbname'];
            $username = $config['username'];
            $password = $config['password'];
            try{
                $this->pdo = new \PDO($dsn,$username,$password);
                $this->pdo->query('set names utf8');
            }catch (\PDOException $e){
                //错误信息
                die($e->getMessage());
            }
        }
    }

    //获取单条数据方法
    public function find($pri){
        //找到主键当前用户操作的表的主键名称。通过一个方法来获取主键名称
        $prikey = $this->getPrikey();
        //定义查询的sql语句命令
        $sql = "select * from ".$this->table." where ".$prikey." = " . $pri;
//        $sql = "select * from article where id = 4";
        $result = $this->pdo->query($sql);
        $data = $result->fetch(\PDO::FETCH_ASSOC);
        //返回当前对象，将data存储在一个临时的当前对象中
        $this->data = $data;
        //将查找的主键的值存入当前对象的属性
        self::$pri = $pri;
        return $this;

    }
    //定义获取主键名称方法并返回给find方法接收返回值
    public function getPrikey(){
        //组合执行的sql命令语句
        $sql = 'desc' . $this->table;
        //执行SQL命令
        $info = $this->pdo->query($sql);
        $data = $info->fetchAll(\PDO::FETCH_ASSOC);
//        print_r($data);die;
        //定义一个空变量用于存储下面循环账查找到的主键名称值
        $prikey = '';
        //循环$data数据 获取主键名称
        foreach ($data as $k => $v){
            //判断如果$v里面的KEY值又PRI属性，表示这个V对应的就是主键的数据
            if($data['key'] == 'PRI'){
                $prikey = $v['Field'];
                break;
            }
        }
        //将主键名称返回给上面的find方法
        return $prikey;
    }

    //定义获取多条数据的方法
    public function get(){
        //定义组合获取数据的SQL语句
        $sql = 'select * from ' . $this->table . self::$where;
        $result = $this->pdo->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        //返回当前对象，将data存储在一个临时的当前对象中
        $this->data = $data;
        return $this;
    }

    //顶一个方法用于返回当前对象data的数据.这里返回的数据实在Entry的类文件中调用，也就是加载首页模板的类文件中执行调用
    public function toArray(){
        return $this->data;
        //将对象转换成数组
    }

    //由于查询的条件可能会有where条件，这里需要定义一个方法用来设定条件数据
    public function where($where){
        //这个方法适用于当用户调用了条件的时候这个方法就会知道用户需要获取什么条件的数据
        self::$where = ' where ' . $where;
        return $this;
    }

    //定义添加数据方法
    public function add($data){
        //循环传递的data参数，并定义一个变量接收
        $keyStr = '';//接收字段名
        $valueStr = '';//接收字段值
        foreach ($data as $k => $v){
            $keyStr .= $k . ',';
            $valueStr .='"' .$v. '",';
        }

        //去掉后面的,
        $keyStr = rtrim($keyStr,',');
        $valueStr = rtrim($valueStr,',');
        //定义插入数据库的sql语句
        $sql = 'insert into '.$this->table.' ('.$keyStr.') values ('.$valueStr.')';
        //执行sql语句使用exec添加
        $data = $this->pdo->exec($sql);
        return $data;

    }

    //定义编辑数据方法
    public function edit($data){
        //循环传递的data参数，并定义一个变量接收
        $str = '';//接收字段名

        foreach ($data as $k => $v){
            $str .= $k . ' ="' .$v. '",';

        }
        $str=rtrim($str,',');
        //获取主键名称
        $priKey = $this->getPriKey();
        //定义需要执行编辑修改的sql语句
        $sql = "update " .$this->table. " set ".$str. " where " .$priKey." = " .self::$pri;
        //执行SQL语句命令
        $data = $this->pdo-exec($sql);
        return $data;
    }

    //删除数据的方法
    public function dalete($pri){
        //获取主键名称
        $prikey = $this->getPrikey();
        $sql = "delete from ".$this->table." where ".$prikey." = " . $pri;
        $data = $this->pdo->exec($sql);
        return $data;
    }

    //多表查询数据
    public function query($sql){
        //直接使用pdo对象调用PDO的query方法获取关联表的数据
        $result = $this->pdo->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        //将当前对象,将data数据存入当前对象的临时属性中
        $this->data = $data;
        return $this;
    }
}


?>