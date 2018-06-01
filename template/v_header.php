<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!-- Author Meta -->
    <meta name="author" content="anonymous">
    <!-- Meta Description -->
    <meta name="description" content="<?php echo WEB_DESC;?>">
    <!-- Meta Keyword -->
    <meta name="keywords" content="<?php echo WEB_KEYWORDS;?>">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Sekolah Katolik Santo Paulus</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">							
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>	
    <header id="header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-4 header-top-left no-padding">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-sm-6 col-8 header-top-right no-padding">
                    <a href="tel:+6221 645 9107">(021) 645 9107</a>
                    <a href="mailto:<?php echo INFO_EMAIL;?>"><?php echo INFO_EMAIL;?></a>
                </div>
            </div>			  					
        </div>
    </div>
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
              <a href="<?php echo $baseurl;?>"><img src="assets/img/logo.png" alt="" title="<?php echo WEB_TITLE;?>"/></a>
          </div>
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="<?php echo $baseurl;?>">Beranda</a></li>
              <li><a href="?page=static&q=tentang-kami">Tentang Kami</a></li>
              <li class="menu-has-children"><a href="#">Pendaftaran</a>
                <ul>
                  <li><a href="?page=static&q=syarat-pendaftaran">Syarat Pendaftaran</a></li>
                  <li><a href="?page=form-pendaftaran">Formulir Pendaftaran</a></li>
                </ul>
              </li>
              <li><a href="?page=gallery">Galeri</a></li>
              <!--
              <li class="menu-has-children"><a href="">List</a>
                <ul>
                  <li><a href="#">List 1</a></li>
                  <li><a href="#">List 2</a></li>
                </ul>
              </li>	
              -->
              <li><a href="?page=kontak-kami">Kontak Kami</a></li>
            </ul>
          </nav><!-- #nav-menu-container -->		    		
        </div>
    </div>
    </header><!-- #header -->