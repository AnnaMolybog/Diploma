<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'header.php')?>
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
                        <li role="presentation" class="<?php if($categoryId == $category['id_category']) echo 'active'?>"><a href="/">Последние новости</a></li>
                        <?php foreach ($categories[0] as $category) { ?>
                            <?php if(isset($categories[$category['id_category']])) { ?>
                                <li role="presentation" class="dropdown <?php if($categoryId == $category['id_category']) echo 'active'?>">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <?=$category['category']?><span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li><a href="/category/<?=$category['id_category']?>"><?=$category['category']?></a></li>
                                        <?php foreach($categories[$category['id_category']] as $subCategory) { ?>
                                            <li><a href="/category/<?=$category['id_category']?>/<?=$subCategory['id_category']?>"><?=$subCategory['category']?></a></li>
                                        <?php }?>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li role="presentation" class="<?php if($categoryId == $category['id_category']) echo 'active'?>" ><a href="/category/<?=$category['id_category']?>"><?=$category['category']?></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2">
            Реклама
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
                <?php if(isset($errors) && is_array($errors)) { ?>
                    <ul>
                        <?php foreach($errors as $error) { ?>
                            <li> <?=$error?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            <h3>Форма авторизации</h3>
            <form method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userEmail?>">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="user_password" placeholder="Пароль" value="<?=$userPassword?>">
                </div>
                <input type="submit" class="btn btn-default" name="submit" value="Войти">
            </form>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2">
            Реклама
        </div>

    </div>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>