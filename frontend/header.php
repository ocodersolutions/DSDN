<?php 
require('defines.php');
//define('BASE_URL', 'http://localhost:8089/ocoder/DSDN/frontend/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Công Ty Cổ Phần Thông Tin Tín Hiệu Đường Sắt Đà Nẵng | Công Ty CP Thông Tin Tín Hiệu Đường Sắt Đà Nẵng. ĐC: 218 Hải Phòng, P.Tân Chính, Q.Thanh Kkê, TP. Đà Nẵng. ĐT: (0511)3825472.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo BASE_URL;?>css/owl.carousel.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/style.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/responsive.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/background_image_content_box.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/team_member_hover_effect.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/clean_accordion.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/customer_logo_carousel.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/minimal_logo_carousel.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/flexslider.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/customer_review_box.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/simple_app_download_buttons.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/flexslider.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/contact.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/member.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/news_image.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/magnific-popup.css" />
    <script src="https://code.jquery.com/jquery-1.11.2.js"   integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU="   crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL;?>js/bootstrap.js"></script>
    <script src="<?php echo BASE_URL;?>js/jquery.js"></script>
    <script src="<?php echo BASE_URL;?>js/jquery.flexslider-min.js"></script>
    <script src="<?php echo BASE_URL;?>js/jquery.magnific-popup.min.js"></script>
</head>
<body>
	<!-- Docs master nav -->
    <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
        <div class="header-wrapper container">
            <div class="row">
            	<div class="container">
                    <div id="text-2" class="widget_text">
                        <div class="textwidget">
                            <div class="logo col-sm-4 col-xs-6">
                                <a class="home-link" href="#" title="First Choice Restoration" rel="home">
                                <img class="img-rize" src="img/logo/logo-2.png" alt="logo">
                                </a>
                            </div>
                            <div class="phone col-sm-8 col-xs-6">
                                <div class="content">
                                    <span class="title">Gọi ngay hôm nay</span><br>
                                    <span class="phone-number">(0511)3825472</span><br>
                                    <span class="wrt">Công Ty CP Thông Tin Tín Hiệu Đường Sắt Đà Nẵng</span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="menu-main">
        <div class="container">
            <div class="navbar-header">
                <div id="text-4" class="widget_text">
                    <div class="textwidget"><a href="<?php echo BASE_URL;?>" class="request-quote">Trang chủ</a></div>
                </div>
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse">
                
                <ul class="parent nav navbar-nav">
                    <li class="parent-item ">
                        <a href="<?php echo BASE_URL;?>contact.php">Liên hệ</a>
                    </li>
                    <li class="parent-item ">
                        <a href="<?php echo BASE_URL;?>congvan.php">Công văn</a>
                    </li>
                    <li class="parent-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Dịch vụ <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Cung cấp thiết bị</a></li>
                            <li><a href="#">Bảo trì vận hành</a></li>
                            <li><a href="#">Tư vấn thiết kế</a></li>
                            <li><a href="#">Dịch vụ khác</a></li>
                        </ul>
                    </li>
                    <li class="parent-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="<?php echo BASE_URL;?>news.php">Tin tức <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo BASE_URL;?>news.php?tin-noi-bo">Tin nội bộ</a></li>
                            <li><a href="<?php echo BASE_URL;?>news.php?tin-lien-quan">Tin tức liên quan</a></li>
                            <li><a href="<?php echo BASE_URL;?>news.php?tin-cong-nghe">Tin công nghệ</a></li>
                        </ul>
                    </li>
                    <li class="parent-item ">
                        <a href="<?php echo BASE_URL;?>member.php">Đơn vị thành viên </a>
                        
                    </li>
                    <li class="parent-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Quan hệ cổ đông <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Thông báo</a></li>
                            <li><a href="#">Báo cáo tài chính</a></li>
                            <li><a href="#">Đại hội cổ đông</a></li>
                            <li><a href="#">Thông tin về cổ phiếu</a></li>
                            <li><a href="#">Báo cáo thường niên</a></li>
                            <li><a href="#">Báo cáo HĐQT</a></li>
                            <li><a href="#">Qui chế quản trị</a></li>
                            <li><a href="#">Bản cáo bạch</a></li>
                            <li><a href="#">Điều lệ tổ chức và hoạt động</a></li>
                        </ul>
                    </li>
                    <li class="parent-item ">
                        <a href="<?php echo BASE_URL;?>tinanh.php">Tin ảnh</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>