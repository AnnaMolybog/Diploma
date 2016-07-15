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
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="row">
                    <?php if(!empty($tagNews)) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 style="margin-left: 20px"><a href = "/news/<?=$tagNews[0]['id_news']?>"><?=ucfirst($tagNews[0]['tag'])?></a></h3>
                        <hr>
                    </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="col-sm-12 col-md-12">

                                <div class="thumbnail">
                                    <a href = "/news/<?=$tagNews[0]['id_news']?>"><img class="img" style="height: 350px; width: 100%" src="/images/<?=$tagNews[0]['id_news']?>.jpg"></a>
                                    <div class="caption" style="height: 180px">
                                        <h3><a href = "/news/<?=$tagNews[0]['id_news']?>"><?=$tagNews[0]['title']?></a></h3>
                                        <em><?=$tagNews[0]['date']; unset($tagNews[0])?></em>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <?php foreach($tagNews as $new) { ?>
                                <div class="col-sm-6 col-md-6">
                                    <div class="thumbnail">
                                        <a href = "/news/<?=$new['id_news']?>"><img class="img" style="height: 140px; width: 100%" src="/images/<?=$new['id_news']?>.jpg"></a>
                                        <div class="caption" style="height: 110px">
                                            <h4><a href = "/news/<?=$new['id_news']?>"><?=$new['title']?></a></h4>
                                            <em><?=$new['date']?></em>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    <?php } else {echo "Нет новостей в данной категории";} ?>
                </div>
                <hr>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                Реклама
            </div>
        </div>
    </div>


    <nav style="text-align: center">
        <?php echo $pagination->get(); ?>
    </nav>

<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>