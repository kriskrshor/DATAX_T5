<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include('db.php');
include ('input.php');
$db = new db();
$input = new input();
@$username=$_SESSION['username'];
$text = $input->get('text');
$user = $input->get('user');
$date = $input->get('date');
$text = addslashes($text);
$sql = "select * from post WHERE (text='{$text}' and user='{$user}' and date='{$date}')";
$result = $db->query($sql);
$results=$result->fetch_array(MYSQLI_ASSOC);
$like_num = $results['like_num'];
$comment_num = $results['comment_num'];
$image_path = $results['image_path'];
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

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="#"><?php $text = stripcslashes($text); echo $text ?></a></h2>
<!--                <p>--><?php //echo $text ?><!--</p>-->
            </div>
            <div class="meta">
                <time class="published" datetime="2015-11-01"><?php echo $date?></time>
                <a href="#" class="author"><span class="name"><?php echo $user?></span></a>
            </div>
        </header>
        <a><span class="image featured"><img src=<?php echo $image_path?> alt="" /></span></a>
        <footer>
            <ul class="stats">
                <li><a href="search_post.php?user=<?php echo $user?>&text=<?php echo $text?>& date= <?php echo $date?> " class="button col-1-small">Search</a></li>
                <li><a href="" class="icon solid fa-heart"><?php echo $like_num?></a></li>
                <li><a href="#" class="icon solid fa-comment"><?php echo $comment_num?></a></li>
            </ul>
        </footer>
    </article>

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
