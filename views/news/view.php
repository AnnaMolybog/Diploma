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
            <h3><a href = "/news/<?=$newsItem['id_news']?>"><?=$newsItem['title']?></a></h3>
            <em><?=$newsItem['date']?><br></em>
            В данный момент страницу смотрят <?=$currentViews?> пользователей
            <div style="float: right; font-size: 12px; margin-right: 20px";>
                <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 10px;"></span><?=$totalComments?>
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 10px;"></span><?=$newsItem['views']?></div>
            <hr>
            <a href = "/news/<?=$newsItem['id_news']?>"><img style="float: left; margin-right: 15px" class="img-rounded" width="250" height="250" src="/images/<?=$newsItem['id_news']?>.jpg"></a>
            <?php if(User::isGuest() && $newsItem['id_category'] == ANALYTIC_CATEGORY) { ?>
                <p><?=mb_substr($newsItem['content'], 0, NEWS_LENGTH_ANALYTIC);?></p>
                <p>Для того чтобы посмотреть новость полностью необходимо <a href = "/register"> зарегистрироваться</a></p>
            <?php } else { ?>
            <p><?=$newsItem['content']?></p>
            <?php }?>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($tagsByNews as $tag) { ?>
                    <a href="/tag/<?=$tag['id_tag']?>">#<?=$tag['tag']?></a>
                    <?php } ?>
                </div>
            </div>
            <?php if(!User::isGuest()) { ?>
            <h3>Оставить комментарий</h3>
            <form method="post">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_news" value="<?=$newsItem['id_news']?>">
                </div>
                <div class="form-group">
                    <label>Логин</label>
                    <input disabled type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userLogin?>">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <textarea rows="3" class="form-control" name="comment" placeholder="Оставьте свой комментарий"></textarea>
                </div>
                <input type="submit" class="btn btn-default" name="submit" value="Отправить">
            </form>
                <br>
            <?php } ?>
            <?php foreach($commentsByNews as $comment) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="#"><h4><?=$comment['login']?></h4></a>
                        <p><?=$comment['comment']?></p>
                        <a href="/likes/<?=$newsItem['id_news']?>/<?=$comment['id_comment']?>"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 10px;"></span></a><?=$comment['likes']?>
                        <a href="/dislikes/<?=$newsItem['id_news']?>/<?=$comment['id_comment']?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="padding-right: 10px;"></span></a><?=$comment['dislikes']?>
                    <?php if(!User::isGuest()) { ?>
                        <hr>
                        <h4>Ответить</h4>
                        <form method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="parent_comment" value="<?=$comment['id_comment']?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_news" value="<?=$newsItem['id_news']?>">
                            </div>
                            <div class="form-group">
                                <label>Логин</label>
                                <input disabled type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userLogin?>">
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <textarea rows="3" class="form-control" name="comment" placeholder="Оставьте свой комментарий"></textarea>
                            </div>
                            <input type="submit" class="btn btn-default" name="response" value="Отправить">
                        </form>
                        <br>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <nav style="text-align: center">
                <?php echo $pagination->get(); ?>
            </nav>
        </div>

<div class="col-lg-2 col-md-2 col-sm-2">
    Реклама
</div>

</div>
<hr>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>
