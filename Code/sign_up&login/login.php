<?php
include ('../new/db.php');
$db = new db();
session_start();
header("Content-type:text/html;charset=utf-8");

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "" || $password == "" )
{
    echo "<script>alert('The input cannot be empty, please re-enter.');window.location.href='login.html'</script>";
} else {
    $sql = "select * from user WHERE username='{$username}' AND password='{$password}'";

$result = $db->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("location:../new/hi.php");
} else {
    echo "<script>alert('Invalid username or password, please try again!');window.location.href='login.html'</script>";
}

}


?>