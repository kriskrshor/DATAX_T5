<?php
include('../new/db.php');
$db = new db();
session_start();
$text=$_POST['text'];
@$user = @$_SESSION['username'];
if($user == NULL){
    echo "<script>alert('Please Log in!');window.location.href='../sign_up&login/login.html'</script>";
}
else {
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg"))
        || ($_FILES["file"]["type"] == "image/png")
        && ($_FILES["file"]["size"] < 20000000)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
//            echo "file_name: " . $_FILES["file"]["name"] . "<br />";
//            echo "file_type: " . $_FILES["file"]["type"] . "<br />";
//            echo "file_size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//            echo "user: " . $_SESSION['username'] . "<br />";
            $destination_path = getcwd() . DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../static/images/' . basename($_FILES["file"]["name"]);
            if (file_exists($target_path . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
            }
        }
    } else {
        echo "<script>alert('Upload Failed!');window.location.href='../new/hi.php'</script>";
//        die("Upload Failed!". header("Refresh:1;url=../new/hi.php"));
    }
    $file = "../static/images/" . $_FILES["file"]["name"];
    $id_image = $_FILES["file"]["name"];
    $id_image = str_replace(strrchr($id_image, "."), "", $id_image);
    $today = date("Y-m-d H:i:s");
    $query = "INSERT INTO post(post_id,user,text,image_path,date)
            VALUES
            ('$id_image','$user','$text','$file','$today')";
    $result = $db->query($query);

    if (!$query) {
        die('Error: ' . $query());
    }
    echo "<script>alert('Post successfully!');window.location.href='../new/hi.php'</script>";
//        echo "Post successfully!";
//        header("Refresh:1;url=../new/hi.php");

}
?>
