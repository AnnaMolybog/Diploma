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
                        <li>
                            <a href="" data-toggle="modal" data-target="#myModal">Правила пользования административной панелью</a>
                                                        <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Правила пользования административной панелью</h4>
                                        </div>
                                        <div class="modal-body">
                                            Для того чтобы внести изменения в статью, в т.ч. изменить/добавить теги, изменить категорию необходимо перейти на сайт и выбрать статью, которую Вы хотите изменить
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <li>
                            <a href="/logout">Выход</a>
                        </li>

                    </ul>
                <?php }?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form method="post" class="navbar-form navbar-left" role="search" action="/admin/color">
                        <div class="form-group">
                            <select name="color" class="form-control">
                                <option <?php if($_SESSION['color'] == 'White') { echo "selected"; }?> value="White">Color: White</option>
                                <option <?php if($_SESSION['color'] == 'Snow') { echo "selected"; }?> value="Snow">Color: Snow</option>
                                <option <?php if($_SESSION['color'] == 'GhostWhite') { echo "selected"; }?> value="GhostWhite">Color: GhostWhite</option>
                                <option <?php if($_SESSION['color'] == 'Ivory') { echo "selected"; }?> value="Ivory">Color: Ivory</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Установить</button>
                    </form>
                    <form method="post" class="navbar-form navbar-left" role="search" action="/admin/name">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="text" class="form-control" name="site_name" placeholder="Изменить название сайта" value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Изменить</button>
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

                            <li role="presentation" class="active"><a href="/admin">Добавить новость</a></li>
                            <li role="presentation"><a href="/admin/commentApprove">Комментарии на подтверждение</a></li>
                            <li role="presentation"><a href="/admin/categoryAdd">Добавить категорию</a></li>
                            <li role="presentation"><a href="/admin/advertisement">Добавить рекламу</a></li>
                            <li role="presentation"><a href="/">Перейти на сайт</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <br>