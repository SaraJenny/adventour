<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/
// Läser in config-filen
include(__DIR__."/config.php");
?>
<!DOCTYPE html>
<html lang="sv">
    <head>
        <!-- För äldre IE-versioner -->
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title><?php echo $site_title . $divider . $page_title; ?></title>
        <meta charset="utf-8">
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Mouse+Memoirs' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <!-- Font Awesome -->
        <script src="https://use.fontawesome.com/d41e00553f.js"></script>
        <!-- Stilmall -->
        <link rel="stylesheet" href="<?php __DIR__; ?>/css/style.css" type="text/css">
        <!-- Lightbox -->
        <link href="<?php __DIR__; ?>/script/lightbox/css/lightbox.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="<?php __DIR__; ?>/script/mobile-menu.js"></script>
        <!-- Faviconer -->
        <link rel="shortcut icon" href="../images/favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="144x144" href="../images/favicon/apple-touch-icon-144x144">
        <link rel="apple-touch-icon" sizes="114x114" href="../images/favicon/apple-touch-icon-114x114">
        <link rel="apple-touch-icon" sizes="72x72" href="../images/favicon/apple-touch-icon-72x72">
        <link rel="apple-touch-icon" href="../images/favicon/apple-touch-icon-57x57">
    </head>
    <body>
        <!-- Sidhuvud -->
        <header>
            <div id="headerSection">
                <a id="skip" href="#mainContent">Hoppa till innehållet</a>
                <!-- Språkval -->
                <div class="dropdown">
                    <?php
                    // Om besökaren är inne på den engelska sidan ska "english" stå överst
                    if (getPath() == "/en/index.php") {
                    ?>
                        <p>English <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                        <div class="dropdown-content">
                            <a href="<?php __DIR__; ?>/index.php">Svenska</a>
                    <?php
                    }
                    // Svenska överst
                    else {
                    ?>
                        <p>Svenska <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                        <div class="dropdown-content">
                            <a href="<?php __DIR__; ?>/en/index.php">English</a><br>
                    <?php
                    }
                    ?>
                        <a href="#">Deutsch</a><br>
                        <a href="#">Espa&ntilde;ol</a><br>
                        <a href="#">Fran&ccedil;ais</a>
                    </div><!-- /.dropdown-content -->
                </div><!-- /.dropdown -->
                <h1>Adventour</h1>
                <!-- Logotyp -->
                <a href="index.php">
                    <figure id="logo">
                        <img src="<?php __DIR__; ?>/images/logo.png" alt="Adventour">
                        <figcaption>Din reseguide i världen</figcaption>
                    </figure>
                </a>
                <!-- Sökformulär -->
                <form method="get" id="searchbox">
                    <label for="search" class="hidden">Sök</label>
                    <input type="search" name="search" id="search">
                    <input type="submit" value ="Sök" name="submitSearch" id="submitSearch">
                </form>
                <!-- Meny -->
                <?php include(__DIR__."/mainmenu.php");?>
            </div><!-- /#headerSection -->
        </header><!-- Sidhuvud slut -->
        <!-- Breadcrumbs -->
        <div id="breadcrumbs">
            <div id="inner-breadcrumb">
                <a href="index.php">
                    <span class="hidden">Hem</span>
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <?php if (getPath() == "/index.php" || getPath() == "/en/index.php") { ?><img src="<?php __DIR__; ?>/images/interface/arrow.png" alt="" class="arrow"><span><?php if (getPath() == "/en/index.php") {?>Home<?php } else { ?>Hem<?php } ?></span><?php }
                else if (getPath() == "/resor.php") { ?><img src="<?php __DIR__; ?>/images/interface/arrow.png" alt="" class="arrow"><span>Resor</span><?php }
                else if (getPath() == "/kontakt.php") { ?><img src="<?php __DIR__; ?>/images/interface/arrow.png" alt="" class="arrow"><span>Kontakt</span><?php }
                else { ?><img src="<?php __DIR__; ?>/images/interface/arrow.png" alt="" class="arrow"><a href="resor.php"><span>Resor</span></a><img src="<?php __DIR__; ?>/images/interface/arrow.png" alt="" class="arrow"><span><?php echo $page_title; ?></span><?php } ?>
            </div><!-- /#inner-breadcrumb -->
        </div><!-- /#breadcrumbs -->