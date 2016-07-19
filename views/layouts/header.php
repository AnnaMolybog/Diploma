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
    <script src="js/script.js"></script>
    <style>
        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>



</head>
<body style="background-color: <?=$_SESSION['color']?>">
<div class="container-fluid" style="margin-top: -30px">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/"><?=$_SESSION['site_name']?></a>
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
                                <a id="dLabel" data-target="#" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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