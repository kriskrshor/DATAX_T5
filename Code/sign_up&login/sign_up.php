<?php
include ('../new/db.php');
$db = new db();
session_start();
header("Content-type:text/html;charset=utf-8");


if(@$_POST['username']==null or @$_POST['password']==null )
{
    echo "<script>alert('The input cannot be empty, please re-enter.');window.location.href='sign_up.html'</script>";
}else {
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    if ($username != "" and $password != "") {
        $sql = "select * from user WHERE username='{$username}'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('Username exists, please fill in again');window.location.href='sign_up.html'</script>";
        } else {
            $sql = "insert into user(username, password)values('$username','$password')";
            $result = $db->query($sql);
            echo "<script>alert('Registered successful!');window.location.href='sign_up&login.html'</script>";
        }

    }
}





?>