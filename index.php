<?php
session_start();
require_once 'session.class.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Ветеренарная клиника</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/menu.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>
<body>
    <div id="front">
        <div class="site-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <div id="templatemo_logo">
                            <h1><a href="#"></a></h1>
                        </div> <!-- /.logo -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-10 col-sm-6 col-xs-6">
                        <a href="#" class="toggle-menu"><i class="fa fa-bars"></i></a>
                        <div >
                            <ul id="menu">
                                <li><a href="#front">Главная</a></li>
                                <li><a href="#services">О нас</a></li>
                                <li><a href="#products">Услуги</a></li>
								<?php if (Session::has('user')) : ?>
                                    <li><a href="logout.php">Выход (<?=Session::get('user'); ?>)</a></li>
                                <?php else : ?>
                                    <li><a href="login.php">Вход</a></li>
                                <?php endif; ?>
                            </ul>
                        </div> <!-- /.main-menu -->
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="responsive">
                            <div class="main-menu">
                                <ul id="navbar">
                                    <li><a href="#front">Home</a></li>
                                    <li><a href="#services">Services</a></li>
                                    <li><a href="#products">Products</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.container -->
        </div> <!-- /.site-header -->
    </div> <!-- /#front -->

    <div class="site-slider">
        <ul class="bxslider">
            <li>
                <img src="images/slider/slide1.jpg" alt="slider image 1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="slider-caption">
                                <h2>Лучшие специалисты</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <img src="images/slider/slide2.jpg" alt="slider image 2">
                <div class="container caption-wrapper">
                    <div class="slider-caption">
                        <h2>Лучшая диагностика</h2>
                    </div>
                </div>
            </li>
        </ul> <!-- /.bxslider -->
        <div class="bx-thumbnail-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="bx-pager">
                            <a data-slide-index="0" href=""><img src="images/slider/thumb1.jpg" alt="image 1" /></a>
                            <a data-slide-index="1" href=""><img src="images/slider/thumb2.jpg" alt="image 2" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.site-slider -->

    <div id="services" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3>Новые оборудования</h3>
                        <p>Наша компания оснащена самыми инновационными обарудованиями.</p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-4 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon second"></span>
                        <h3>Презенты</h3>
                        <p>В праздники мы делаем большие скидки нашим клиентам, а так же делаем бесплатный осмотр.</p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-4 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon third"></span>
                        <h3>24/7</h3>
                        <p>Особенность нашей клиники в том, что мы работаем без выходных.</p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#services -->

    <div id="product-promotion" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Наше Salo</h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-2 col-sm-3">
                    <div class="">
                        
                    </div> <!-- /.item-small -->
                </div> <!-- /.col-md-2 -->
                <div class="col-md-8 col-sm-6">
                    <div class="item-large">
                        <img src="images/promotion/promotion2.jpg" alt="Product 2">
                        <div class="item-large-content">
                            <div class="item-header">
                                <h2 class="pull-left">История клиники</h2>

                                <div class="clearfix"></div>
                            </div> <!-- /.item-header -->
                            <p>Специализированная ветеринарная клиника доктора Чулковой, основанная в 1992 году, — первая частная клиника в Волгограде, получившая государственную лицензию на ведение ветеринарной деятельности в Волгоградской области. Все сотрудники клиники являются дипломированными специалистами с опытом работы.</p>
                        </div> <!-- /.item-large-content -->
                    </div> <!-- /.item-large -->
                </div> <!-- /.col-md-8 -->
                <div class="col-md-2 col-sm-3">
                    <div class="">
                        
                    </div> <!-- /.item-small -->
                </div> <!-- /.col-md-2 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#product-promotion -->

    <div id="products" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Услуги</h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_1.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Офтальмолог</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product1.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием офтальмолога</h3>
                        <span>Цена: <em class="text-muted">$100.00</em> - <em class="price">$50.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_3.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Дерматолог</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product2.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием дерматолога</h3>
                        <span>Цена: <em class="text-muted">$80.00</em> - <em class="price">$40.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_2.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Нейрохирург</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product3.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием нейрохирурга</h3>
                        <span>Цена: <em class="text-muted">$200.00</em> - <em class="price">$180.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_1.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Кардиолог</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product4.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием кардиолога</h3>
                        <span>Цена: <em class="text-muted">$260.00</em> - <em class="price">$140.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_3.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Хирург</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product5.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием хирурга</h3>
                        <span>Цена: <em class="text-muted">$150.00</em> - <em class="price">$100.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_1.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Онколог</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product6.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием онколога</h3>
                        <span>Цена: <em class="text-muted">$470.00</em> - <em class="price">$330.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_2.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Груммер</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product7.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием грумера</h3>
                        <span>Цена: <em class="text-muted">$70.00</em> - <em class="price">$60.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
                <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_3.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Ортопед</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product8.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Ортопеда</h3>
                        <span>Цена: <em class="text-muted">$120.00</em> - <em class="price">$110.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
				
				<div class="col-md-4 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb">
                            <span class="note"><img src="images/small_logo_3.png" alt=""></span>
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="#nogo" class="view-detail">Терапевт</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product9.jpg" alt="">
                        </div> <!-- /.item-thumb -->
                        <h3>Прием терапевта</h3>
                        <span>Цена: <em class="text-muted">$200.00</em> - <em class="price">$170.00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#products -->
    
    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="js/jquery.easing-1.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!-- templatemo 401 sprint -->
</body>
</html>