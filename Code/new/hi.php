<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include('db.php');
$db = new db();
$text="text";
@$username=$_SESSION['username'];


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

            <li><a href="../index.html">Index Page</a></li>
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
    <?php
    if(@$_POST['query']==null)
    {
        @$query="";
    }else {
        @$query = $_POST['query'];
    }


    if($query != "" ) {

        $sql = "select * from post WHERE text='{$query}' or user='{$query}' or date='{$query}'";
        $result = $db->query($sql);
        $rows = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

    }
    else{
        $sql = "select * from post ORDER BY date DESC ";
        $result = $db->query($sql);

        $rows = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
    }
    ?>

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
        <h2><a href="../add_post/add_post.html">New Post</a></h2>
        <!-- Post -->
        <?php foreach ($rows as $row ):?>
            <tr>

        <article class="post">
            <header>
                <div class="title">
                    <h3><a href="post.php?user=<?php echo $row['user']?>&text=<?php echo $row['text'] ?>& date= <?php echo $row['date'] ?> "><?php echo $row['text'] ?>
                        </a></h3>
                    <h4><a href="user.php?user=<?php echo $row['user']?>">@<?php echo $row['user']?></a></h4>

                </div>
                <div class="meta">
                    <time class="published" datetime="2021-11-03"><?php echo $row['date']?></time>
                    <a href="user.php" class="author"><span class="name"><?php echo $row['user']?></span><img src="../static/images/test.png" alt="" /></a>
                </div>
            </header>
            <a href="post.php?user=<?php echo $row['user']?>&text=<?php echo $row['text'] ?>& date= <?php echo $row['date'] ?>" class="image featured"><img src=<?php echo $row['image_path']?>  alt="" height="700" width="150" /></a>
            <p><footer>
                <ul class="actions">
                    <li><a href="search_post.php?user=<?php echo $row['user']?>&text=<?php echo $row['text'] ?>& date= <?php echo $row['date'] ?>"  class="button large">Search</a></li>
<!--                    <li><a href="post.php?user=--><?php //echo $row['user']?><!--&text=--><?php //echo $row['text'] ?><!--& date= --><?php //echo $row['date'] ?><!--" class="button large">Continue Reading</a></li>-->
                </ul>

                <ul class="stats">

                    <li><a href="" class="icon solid fa-heart"><?php echo $row['like_num']?></a></li>
                    <li><a href="#" class="icon solid fa-comment"><?php echo $row['comment_num']?></a></li>
                </ul>
            </footer>
        </article>
            </tr>
        <?php endforeach;?>


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

<!-- Scripts -->
<script src="../static/js/jquery.min.js"></script>
<script src="../static/js/browser.min.js"></script>
<script src="../static/js/breakpoints.min.js"></script>
<script src="../static/js/util.js"></script>
<script src="../static/js/main.js"></script>
</body>
</html>
