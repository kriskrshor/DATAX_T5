<?php
define("PATH", dirname(__FILE__));

include(PATH . 'db.php');
$db = new db();//实例化

include(PATH . 'input.php');
$input = new input();