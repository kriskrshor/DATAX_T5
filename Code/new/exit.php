<?php
session_start();
session_destroy();
unset($_SESSION['username']);
echo "<script>alert('Logout successful！');window.location.href='hi.php'</script>";
?>
