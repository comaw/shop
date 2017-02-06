<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="author" content="php-shaman">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Cache-Control" content="max-age=100, must-revalidate">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="<?=(mb_substr_count($this->title, '404', Yii::$app->charset) > 0 ? 'noindex,nofollow' : 'all')?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="revisit-after" content="1 days">
    <meta name="generator" content="php-shaman">
    <link rel="canonical" href="<?=Url::canonical()?>">
    <?php if($this->title){ ?>
        <title><?= Html::encode($this->title). ' | ' . Html::encode(Yii::$app->name) ?></title>
    <?php }else{ ?>
        <title><?= Html::encode(Yii::$app->name) ?></title>
    <?php } ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">
        <div class="header_top">
            <div class="col-sm-9 h_menu4">
                <ul class="megamenu skyblue">
                    <li class="active grid"><a class="color8" href="/">New</a></li>
                    <li><a class="color1" href="#">Men</a><div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <li><a href="men.html">Accessories</a></li>
                                            <li><a href="men.html">Bags</a></li>
                                            <li><a href="men.html">Caps & Hats</a></li>
                                            <li><a href="men.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="men.html">Jackets & Coats</a></li>
                                            <li><a href="men.html">Jeans</a></li>
                                            <li><a href="men.html">Jewellery</a></li>
                                            <li><a href="men.html">Jumpers & Cardigans</a></li>
                                            <li><a href="men.html">Leather Jackets</a></li>
                                            <li><a href="men.html">Long Sleeve T-Shirts</a></li>
                                            <li><a href="men.html">Loungewear</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <li><a href="men.html">Shirts</a></li>
                                            <li><a href="men.html">Shoes, Boots & Trainers</a></li>
                                            <li><a href="men.html">Shorts</a></li>
                                            <li><a href="men.html">Suits & Blazers</a></li>
                                            <li><a href="men.html">Sunglasses</a></li>
                                            <li><a href="men.html">Sweatpants</a></li>
                                            <li><a href="men.html">Swimwear</a></li>
                                            <li><a href="men.html">Trousers & Chinos</a></li>
                                            <li><a href="men.html">T-Shirts</a></li>
                                            <li><a href="men.html">Underwear & Socks</a></li>
                                            <li><a href="men.html">Vests</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Popular Brands</h4>
                                        <ul>
                                            <li><a href="men.html">Levis</a></li>
                                            <li><a href="men.html">Persol</a></li>
                                            <li><a href="men.html">Nike</a></li>
                                            <li><a href="men.html">Edwin</a></li>
                                            <li><a href="men.html">New Balance</a></li>
                                            <li><a href="men.html">Jack & Jones</a></li>
                                            <li><a href="men.html">Paul Smith</a></li>
                                            <li><a href="men.html">Ray-Ban</a></li>
                                            <li><a href="men.html">Wood Wood</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid"><a class="color2" href="#">Women</a>
                        <div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <li><a href="men.html">Accessories</a></li>
                                            <li><a href="men.html">Bags</a></li>
                                            <li><a href="men.html">Caps & Hats</a></li>
                                            <li><a href="men.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="men.html">Jackets & Coats</a></li>
                                            <li><a href="men.html">Jeans</a></li>
                                            <li><a href="men.html">Jewellery</a></li>
                                            <li><a href="men.html">Jumpers & Cardigans</a></li>
                                            <li><a href="men.html">Leather Jackets</a></li>
                                            <li><a href="men.html">Long Sleeve T-Shirts</a></li>
                                            <li><a href="men.html">Loungewear</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <li><a href="men.html">Shirts</a></li>
                                            <li><a href="men.html">Shoes, Boots & Trainers</a></li>
                                            <li><a href="men.html">Shorts</a></li>
                                            <li><a href="men.html">Suits & Blazers</a></li>
                                            <li><a href="men.html">Sunglasses</a></li>
                                            <li><a href="men.html">Sweatpants</a></li>
                                            <li><a href="men.html">Swimwear</a></li>
                                            <li><a href="men.html">Trousers & Chinos</a></li>
                                            <li><a href="men.html">T-Shirts</a></li>
                                            <li><a href="men.html">Underwear & Socks</a></li>
                                            <li><a href="men.html">Vests</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Popular Brands</h4>
                                        <ul>
                                            <li><a href="men.html">Levis</a></li>
                                            <li><a href="men.html">Persol</a></li>
                                            <li><a href="men.html">Nike</a></li>
                                            <li><a href="men.html">Edwin</a></li>
                                            <li><a href="men.html">New Balance</a></li>
                                            <li><a href="men.html">Jack & Jones</a></li>
                                            <li><a href="men.html">Paul Smith</a></li>
                                            <li><a href="men.html">Ray-Ban</a></li>
                                            <li><a href="men.html">Wood Wood</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a class="color4" href="404.html">Accessories</a></li>
                    <li><a class="color6" href="contact.html">Conact</a></li>
                </ul>
            </div>
            <div class="col-sm-3 header-top-right">
                <div class="drop_buttons">
                    <select class="drop-down ">
                        <option value="1">Dollar</option>
                        <option value="2">Euro</option>
                    </select>
                    <select class="drop-down drop-down-in">
                        <option value="1">English</option>
                        <option value="2">French</option>
                        <option value="3">German</option>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="register-info">
                    <ul>
                        <li><a href="login.html">Login</a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="header_bootm">
            <div class="col-sm-4 span_1">
                <div class="logo">
                    <a href="index.html"><img src="/lookz/images/logo.png" alt=""/></a>
                </div>
            </div>
            <div class="col-sm-8 row_2">
                <div class="header_bottom_right">
                    <div class="search">
                        <input type="text" value="Your email address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your email address';}">
                        <input type="submit" value="">
                    </div>
                    <ul class="bag">
                        <a href="cart.html"><i class="bag_left"> </i></a>
                        <a href="cart.html"><li class="bag_right"><p>205.00 $</p> </li></a>
                        <div class="clearfix"> </div>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content">
            <div class="content_box">
                <?=$content?>
                <div class="footer_top">
                    <div class="span_of_4">
                        <div class="col-md-3 box_4">
                            <h4>Shop</h4>
                            <ul class="f_nav">
                                <li><a href="#">new arrivals</a></li>
                                <li><a href="#">men</a></li>
                                <li><a href="#">women</a></li>
                                <li><a href="#">accessories</a></li>
                                <li><a href="#">kids</a></li>
                                <li><a href="#">brands</a></li>
                                <li><a href="#">trends</a></li>
                                <li><a href="#">sale</a></li>
                                <li><a href="#">style videos</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 box_4">
                            <h4>help</h4>
                            <ul class="f_nav">
                                <li><a href="#">frequently asked  questions</a></li>
                                <li><a href="#">men</a></li>
                                <li><a href="#">women</a></li>
                                <li><a href="#">accessories</a></li>
                                <li><a href="#">kids</a></li>
                                <li><a href="#">brands</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 box_4">
                            <h4>account</h4>
                            <ul class="f_nav">
                                <li><a href="#">login</a></li>
                                <li><a href="#">create an account</a></li>
                                <li><a href="#">create wishlist</a></li>
                                <li><a href="#">my shopping bag</a></li>
                                <li><a href="#">brands</a></li>
                                <li><a href="#">create wishlist</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 box_4">
                            <h4>popular</h4>
                            <ul class="f_nav">
                                <li><a href="#">new arrivals</a></li>
                                <li><a href="#">men</a></li>
                                <li><a href="#">women</a></li>
                                <li><a href="#">accessories</a></li>
                                <li><a href="#">kids</a></li>
                                <li><a href="#">brands</a></li>
                                <li><a href="#">trends</a></li>
                                <li><a href="#">sale</a></li>
                                <li><a href="#">style videos</a></li>
                                <li><a href="#">login</a></li>
                                <li><a href="#">brands</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start span_of_2 -->
                    <div class="span_of_2">
                        <div class="span1_of_2">
                            <h5>need help? <a href="#">contact us <span> &gt;</span> </a> </h5>
                            <p>(or) Call us: +22-34-2458793</p>
                        </div>
                        <div class="span1_of_2">
                            <h5>follow us </h5>
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#" target="_blank"></a></li>
                                    <li><a href="#" target="_blank"></a></li>
                                    <li><a href="#" target="_blank"></a></li>
                                    <li><a href="#" target="_blank"></a></li>
                                    <li class="last2"><a href="#" target="_blank"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="copy">
                        <p>© 2015 All Rights Reseverd Template by <a href="http://w3layouts.com/">W3layouts</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>