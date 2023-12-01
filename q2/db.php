<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=bquiz";
    protected $pdo;
    protected $table;
    // 在宣告成員 不能有運算式or new甚麼...

    public function __construct($table)
    {
        $this->table = $table;
        // $this:用db這個class產生的物件 ->:存取屬性或方法(統稱為成員)
        $this->pdo = new PDO($this->dsn, 'root', '');
    }



    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    function count($where = '', $other = '')
    {
        $sql = "select count(*) from `$this->table` ";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    private function math($math,$col,$array='',$other = '')
    // 由於sum需要"欄位", 所以加入$col 參數(變數)
    {
        $sql = "select $math(`$col`) from `$this->table` ";
        $sql=$this->sql_all($sql,$array,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col='',$where='',$other = '')
    {
        return $this->math('sum',$col,$where,$other);
    }
    function max($col='',$where='',$other = '')
    {
        return $this->math('max',$col,$where,$other);
    }
    function min($col='',$where='',$other = '')
    {
        return $this->math('min',$col,$where,$other);
    }

    // function total($id)
    // {
    //     // global $pdo;
    //     $sql = "select count(`id`) from `$this->table` ";

    //     if (is_array($id)) {
    //         foreach ($id as $col => $value) {
    //             $tmp[] = "`$col`='$value'";
    //         }
    //         $sql .= " where " . join(" && ", $tmp);
    //     } else if (is_numeric($id)) {
    //         $sql .= " where `id`='$id'";
    //     } else {
    //         echo "錯誤:參數的資料型態比須是數字或陣列";
    //     }
    //     //echo 'find=>'.$sql;
    //     $row = $this->pdo->query($sql)->fetchColumn();
    //     return $row;
    // }

    function find($id)
    {
        // global $pdo;
        $sql = "select * from `$this->table` ";

        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        } else {
            echo "錯誤:參數的資料型態必須是數字或陣列";
        }
        //echo 'find=>'.$sql;
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // 將insert與update function合併簡化
    // 並將原先函式設定protected是讓外部不能存取 只能用save funtion丟陣列進來判斷
    function save($array)
    {
        if (isset($array['id'])) {
            $sql = "update `$this->table` set ";

            if (!empty($array)) {
                $tmp = $this->a2s($array);
            } else {
                echo "錯誤:缺少要編輯的欄位陣列";
            }
            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['id']}'";
        } else {
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";

            $sql = $sql . $cols . " values " . $vals;
        }
        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        // global $pdo;
        $sql = "delete from `$this->table` where ";

        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " `id`='$id'";
        } else {
            echo "錯誤:參數的資料型態必須是數字或陣列";
        }
        //echo $sql;

        return $this->pdo->exec($sql);
    }

    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function a2s($array)
    {
        // 雖然拉出的程式不是甚麼機密的問題 但是是外部非必須使用的 所以將權限設為private
        // array to sql(命名)
        foreach ($array as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        return $tmp;
        // 注意 最後是存成一個$tmp來存取提出的陣列,所以return $tmp
    }
    private function sql_all($sql,$array,$other){
        if (isset($this->table) && !empty($this->table)) {

            if (is_array($array)) {

                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }

            $sql .= $other;
            //echo 'all=>'.$sql;
            // $rows = $this->pdo->query($sql)->fetchColumn();
            // 改用return回傳
            // 只是回傳筆數 所以不須所有資料紀錄
            return $sql;
        } else {
            echo "錯誤:沒有指定的資料表名稱";
        }
    }
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Que=new DB('que');



?>