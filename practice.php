<?php 

date_default_timezone_set('Asia/Taipei');
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db06";
    protected $pdo;
    protected $table;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    function all($where='',$other=''){
        $sql="select * from `$this->table`";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count($where='',$other=''){
        $sql="select count(*) from `$this->table`";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    private function math($math,$col,$array='',$other=''){
        $sql="select $math(`$col`) from `$this->table`";
        $sql=$this->sql_all($sql,$array,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col='',$where='',$other=''){
        return $this->math('sum',$col,$where,$other);
    }

    

}





?>