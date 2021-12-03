<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include('db.php');
include ('input.php');
@$username=$_SESSION['username'];
$db = new db();
$input = new input();
$text = $input->get('text');
//$text = str_replace("'","\'",$text);
$text = addslashes($text);
$user = $input->get('user');
$date = $input->get('date');
$sql = "select * from post WHERE (text='{$text}' and user='{$user}' and date='{$date}')";
$result = $db->query($sql);
$results=$result->fetch_array(MYSQLI_ASSOC);
$post_id = $results['post_id'];
$like_num = $results['like_num'];
$comment_num = $results['comment_num'];
$image_path = $results['image_path'];
unset($out);
$c = exec("python model.py {$post_id}",$out,$res);
$x = $out[0];
$x1 = str_replace('[','',$x);
$x2 = str_replace(']','',$x1);
$x3 = str_replace("'",'',$x2);
//var_dump($x3);
$users=explode(" ",$x3);
//var_dump($users);

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>UMM-Team5</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../static/css/main.css" />
</head>
<body class="is-preload">


<!-- Header -->
<header id="header">
    <h1><a href="hi.php">UMM-Team5</a></h1>
    <nav class="links">
        <ul>
            <li><a href="../add_post/add_post.html">New</a></li>

        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </li>

            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>
<!-- Menu -->
<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

    <!-- Links -->
    <section>
        <?php
        if($username== null ){?>
            <ul class="actions stacked">
                <li><a href="../sign_up&login/login.html" class="button large fit">Log In</a></li>
            </ul>
            <ul class="actions stacked">
                <li><a href="../sign_up&login/sign_up&login.html" class="button large fit">Sign Up</a></li>
            </ul>
        <?php }
        else {?>
            <ul class="links" >
                <ul class="actions stacked" >
                    <li ><a href = "exit.php" class="button large fit" > <?php echo $_SESSION['username'] ?></a ></li >
                </ul >

            </ul >
        <?php }
        ?>
    </section>


</section>
<div id="wrapper">

    <!-- Main -->
    <div id="main">
            <!-- Intro -->
            <section>
                <ul class="posts">
                    <li>
                        <article>
                            <header>
                                <h3><a href="post.php?user=<?php echo $user?>&text=<?php $text = stripcslashes($text); echo $text?>& date= <?php echo $date?>"><?php echo $text?></a></h3>
                                <time class="published" datetime="2015-10-20"><?php echo $date?></time>
                            </header>
                            <a href="post.php?user=<?php echo $user?>&text=<?php echo $text?>& date= <?php echo $date?>" class="image"><img src="<?php echo $image_path?>" alt="" /></a>
                        </article>
                    </li>
                </ul>
            </section>
        <hr />


     <section>

            <div class="row">
                <?php
                foreach ($users as $key => $value):
                $sql = "select * from post_pool WHERE post_id='$value' ";
                $result = $db->query($sql);
                $results1=$result->fetch_array(MYSQLI_ASSOC);
                $user1 = $results1['user'];
                $text1 = $results1['text'];
                $image_path1 = $results1['image_path'];
                $date1 = $results1['date'];
                ?>
                <div class="col-6 col-12-medium">

                    <article class="mini-post">
                <header>
                    <h3><a href="post.php?user=<?php echo $user1?>&text=<?php echo $text1 ?>& date= <?php echo $date1 ?> "><?php echo $text1 ?></a></h3>
                    <time class="published" datetime="2015-10-20"><?php echo $date1 ?></time>
                    <a href="#" class="author"><img src="../static/images/test.png" alt="" /></a>
                </header>
                <a href="#" class="image"><img src="<?php echo $image_path1 ?>" alt="" /></a>
            </article>

                </div>
                <?php endforeach;?>
                <ul class="actions">
                    <li><a href="#" class="button">Learn More</a></li>
                </ul>

            </div>

        </section>


        <!-- About -->
        <section class="blurb">
            <h2>About</h2>
            <p>This is a Team5 project from UC Berkeley’s INDENG 235 course. Our team members are: Coco Diru GQ Jiang Kyle Wenqi.</p>
            <ul class="actions">
                <li><a href="#" class="button">Learn More</a></li>
            </ul>
        </section>

        <!-- Footer -->
        <section id="footer">
            <ul class="icons">
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
                <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
            </ul>
            <p class="copyright">&copy; Team5. Design: <a href="https://Google.com">Team 5</a>.</p>
        </section>


    </div>

</div>

<!-- Scripts -->
<script src="../static/js/jquery.min.js"></script>
<script src="../static/js/browser.min.js"></script>
<script src="../static/js/breakpoints.min.js"></script>
<script src="../static/js/util.js"></script>
<script src="../static/js/main.js"></script>

</body>
</html>
