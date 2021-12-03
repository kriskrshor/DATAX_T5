<?php

header("Content-type:text/html;charset=utf-8");
$db = mysqli_connect('localhost','root','kwqswbb@^(','DataX_235');
if (!$db) {
    die("连接失败:".mysqli_connect_error());
}

class db {
    function __construct() {
        $this->mysql = new mysqli('localhost', 'root', 'kwqswbb@^(', 'DataX_235');
        if ($this->mysql->connect_error) {//检查连接是否正常
            die('Connect Error(' . $this->mysql->connect_error . ')' . $this->mysql->connect_error);
        }
    }
    function query($sql) {
        return $this->mysql->query($sql);
    }
}
