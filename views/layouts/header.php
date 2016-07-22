<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8-general-ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Новостной портал</title>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src=/www/js/script.js"></script>
    <script type="text/javascript" src="/www/js/jquery.cookie.js"></script>

    <style>
        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>


    <script>
   /* var validNavigation = false;

    function wireUpEvents() {
        var dont_confirm_leave = 0; //set dont_confirm_leave to 1 when you want the user to be able to leave withou confirmation
        var leave_message = "Вы уверены что хотите покинуть сайт?";

        function goodbye(e) {
            if (!validNavigation) {
                return leave_message;

            }
        }
        var host = window.hostName;
        var refer = document.referrer;
        if(refer.indexOf(host) < 0)
            window.onbeforeunload=goodbye;

// Attach the event keypress to exclude the F5 refresh
        $(document).bind('keypress', function(e) {
            if (e.keyCode == 116){
                validNavigation = true;
            }
        });

        $(document).bind("keydown", function(e) {
            if (e.keyCode == 13){
                validNavigation = true;
            }
        });

// Attach the event click for all links in the page
        $("a").bind("click", function() {
            validNavigation = true;
        });

// Attach the event submit for all forms in the page
        $("form").bind("submit", function() {
            validNavigation = true;
        });
// Attach the event click for all inputs in the page
        $("input[type=submit]").bind("click", function() {
            validNavigation = true;
        });
    }
    // Wire up the events as soon as the DOM tree is ready
    $(document).ready(function() {
        wireUpEvents();

    });*/

</script>


</head>
<body style="background-color: <?=$_SESSION['color']?> ">
<script>
    function mouseOver1() {
        document.getElementById("advertising1").title = "Скидка 10%";
        document.getElementById("discount1").style = "display: block; text-align: center; color: red; font-size: 30px";
        document.getElementById("price1").style = "display:none";
        document.getElementById("bg_popup1").style = "display:block; position: relative;";

    }
    function mouseOver2() {
        document.getElementById("discount2").style = "display: block; text-align: center; color: red; font-size: 30px";
        document.getElementById("price2").style = "display:none";
        document.getElementById("bg_popup2").style = "display:block; position: relative;";

    }
    function mouseOver3() {
        document.getElementById("discount3").style = "display: block; text-align: center; color: red; font-size: 30px";
        document.getElementById("price3").style = "display:none";
        document.getElementById("bg_popup3").style = "display:block; position: relative;";
    }
    function mouseOver4() {
        document.getElementById("discount4").style = "display: block; text-align: center; color: red; font-size: 30px";
        document.getElementById("price4").style = "display:none";
        document.getElementById("bg_popup4").style = "display:block; position: relative;";
    }

    function mouseOut1() {
        document.getElementById("discount1").style = "display: none;"
        document.getElementById("price1").style = "display: block; text-align: center";
        document.getElementById("bg_popup1").style = "display:none;";

    }
    function mouseOut2() {
        document.getElementById("discount2").style = "display: none;"
        document.getElementById("price2").style = "display: block; text-align: center";
        document.getElementById("bg_popup2").style = "display:none;";
    }
    function mouseOut3() {

        document.getElementById("discount3").style = "display: none;"
        document.getElementById("price3").style = "display: block; text-align: center";
        document.getElementById("bg_popup3").style = "display:none;";

    }
    function mouseOut4() {

        document.getElementById("discount4").style = "display: none;"
        document.getElementById("price4").style = "display: block; text-align: center";
        document.getElementById("bg_popup4").style = "display:none;";

    }

</script>


<div class="container-fluid" style="margin-top: -30px">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/"><?if(!empty($_SESSION['site_name'])){
                            echo $_SESSION['site_name'];
                        } else {
                            echo "NEWS.net";
                        } ?>
                    </a>
                </div>
                <?php if(User::isGuest()) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Вход<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/register">Регистрация</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/login">Авторизация</a></li>
                        </ul>
                    </li>
                </ul>
                <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if($_SESSION['role'] == 1) { ?>
                    <li>
                        <a href="/admin">Административная панель</a>
                    </li>
                    <?php } else { ?>
                    <li>
                        <a href="/cabinet/<?=$_SESSION['user']?>">Личный кабинет</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="/logout">Выход</a>
                    </li>

                </ul>
                <?php }?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form method="post" class="navbar-form navbar-left" role="search" action="/tag/search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск по тегам" list="tags" name="tag" required>
                            <datalist id="tags">
                                <?php foreach($tags as $tag) { ?>
                                <option value="<?=$tag['tag']?>">
                                    <?php } ?>
                            </datalist>
                        </div>
                        <button type="submit" class="btn btn-default">Поиск</button>
                    </form>

                    <?php include "search.php"; ?>

                </div><!-- /.navbar-collapse -->

            </div><!-- /.container-fluid -->
        </nav>

    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <nav class="navbar " role="navigation">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav nav-tabs nav-justified">

                            <li role="presentation" class="<?php if($categoryId == $category['id_category']) echo 'active'?>"><a href="/">Главная</a></li>

                                <?php foreach ($categories as $arrayCategory) { ?>

                                    <?php foreach ($arrayCategory as $category) { ?>
                                        <?php if(count($arrayCategory) == 1) {?>
                                            <?php if($category['id_category'] <= 7) { ?>
                                                <?php if($category['id_parent'] == 0) {?>
                                                <li role="presentation" class="<?php if($categoryId == $category['id_category']) echo 'active'?>" ><a href="/category/<?=$category['id_category']?>"><?=$category['category']?></a></li>
                                                <?php }?>
                                            <?php }?>
                                            <?php } else { $subCategoryArray[$category['id_category']]['category'] = $category['category'];
                                            $subCategoryArray[$category['id_category']]['id_category'] = $category['id_category'];
                                            $subCategoryArray[$category['id_category']]['id_parent'][] = $category['id_parent']; } ?>
                                        <?php } ?>

                                <?php } ?>



                                <?php foreach ($subCategoryArray as $parentCategory) { ?>

                                    <li role="presentation" class="dropdown <?php if($categoryId == $parentCategory['id_category']) echo 'active'?>">
                                        <a id="dLabel" data-target="#" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <?=$parentCategory['category']?><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <?php for($i = 0; $i < count($parentCategory['id_parent']); $i++) { ?>
                                            <?php foreach($categories[$parentCategory['id_parent'][$i]] as $subCategoryParent) { ?>
                                                <li><a href="/category/<?=$parentCategory['id_category']?>/<?=$parentCategory['id_parent'][$i]?>"><?=$subCategoryParent['category']?></a></li>
                                            <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <li role="presentation" class="dropdown">
                                <a  id="dLabel" data-target="#" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <?php foreach ($categories as $arrayCategory) { ?>
                                        <?php foreach ($arrayCategory as $category) { ?>
                                            <?php if(count($arrayCategory) == 1) {?>
                                                <?php if($category['id_category'] > 7 ) { ?>
                                                    <?php if($category['id_parent'] == 0) {?>
                                                    <li><a href="/category/<?=$category['id_category']?>"><?=$category['category']?></a></li>
                                                    <?php } ?>
                                                    <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="row" style="margin-top: -6px">
                    <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; height: 200px">
                        <h4 style="text-align: center">Топ-3 активные темы</h4>
                        <?php foreach($topThree as $topNews) { ?>
                            <h5><a href = "/category/<?=$topNews['id_category']?><?php if(isset($topNews['id_parent'])) { ?>/<?=$topNews['id_parent']?><?php } ?>/news/<?=$topNews['id_news']?>"><?=$topNews['title']?></a></h5>
                            <p style="margin-top: -10px"><em style="font-size: 12px; margin-right: 10px;">
                                    <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$topNews['likes']; ?>
                                    <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($topNews['id_news'])?>
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$topNews['views']?>
                                </em></p>
                        <?php } ?>
                        <hr>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; ">
                        <a href="/advertisingViews/<?=$mostViewedAdvertising[0]['id_advertising']?>" style="text-decoration: none;"><div class="thumbnail" style="margin-left: 10px; background-color: beige" onmouseover="mouseOver1()" onmouseout="mouseOut1()" id="advertising1">
                                <h4><b><?=$mostViewedAdvertising[0]['product_name']?></b></h4>
                                <div class="caption" style="margin-top: -20px">
                                    <h4 id="price1"><?=$mostViewedAdvertising[0]['price']?> грн</h4>
                                    <h4 id="discount1" style="display: none"><?=$mostViewedAdvertising[0]['price']*0.9?> грн</h4>
                                    <h5><?=$mostViewedAdvertising[0]['company']?></h5>
                                </div>
                            </div></a>
                        <div id="bg_popup1" style="display: none;">
                            <p>Купон на скидку 10%</p>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; ">
                        <a href="/advertisingViews/<?=$advertising[0]['id_advertising']?>" style="text-decoration: none;"><div class="thumbnail" style="margin-left: 10px; background-color: beige" onmouseover="mouseOver2()" onmouseout="mouseOut2()" id="advertising2">
                                <h4><b><?=$advertising[0]['product_name']?></b></h4>
                                <div class="caption" style="margin-top: -20px">
                                    <h4 id="price2"><?=$advertising[0]['price']?> грн</h4>
                                    <h4 id="discount2" style="display: none"><?=$advertising[0]['price']*0.9?> грн</h4>
                                    <h5><?=$advertising[0]['company']?></h5>
                                </div>
                            </div></a>
                        <div id="bg_popup2" style="display: none;">
                            <p>Купон на скидку 10%</p>
                        </div>
                    </div>
                </div>

            </div>