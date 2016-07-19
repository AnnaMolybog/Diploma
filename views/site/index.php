
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

                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                    Реклама
                </div>
            </div>

        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h4 style="text-align: center; margin-bottom: -15px; margin-top: -10px">Сейчас читают</h4><hr>
                <div class="row">
                    <?php if(!empty($mostReadNews)) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="col-sm-12 col-md-12">
                            <div class="thumbnail">
                                <a href = "/category/<?=$mostReadNews[0]['id_category']?><?php if(isset($mostReadNews[0]['id_parent'])) { ?>/<?=$mostReadNews[0]['id_parent']?><?php } ?>/news/<?=$mostReadNews[0]['id_news']?>"><img style="height: 300px; width: 100%" class="img" src="/images/<?=$mostReadNews[0]['id_news']?>.jpg"></a>
                                <div class="caption" style="height: 100px; margin-top: -10px">
                                    <h3><a href = "/category/<?=$mostReadNews[0]['id_category']?><?php if(isset($mostReadNews[0]['id_parent'])) { ?>/<?=$mostReadNews[0]['id_parent']?><?php } ?>/news/<?=$mostReadNews[0]['id_news']?>"><?=$mostReadNews[0]['title']?></a></h3>
                                    <em style="font-size: 12px"><?=$mostReadNews[0]['date']?></em>
                                    <em style="float: right; font-size: 12px; margin-right: 10px">
                                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$mostReadNews[0]['likes']; ?>
                                        <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($mostReadNews[0]['id_news'])?>
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$mostReadNews[0]['views']; unset($mostReadNews[0])?>
                                    </em>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <?php foreach($mostReadNews as $new) { ?>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <a href = "/category/<?=$new['id_category']?><?php if(isset($new['id_parent'])) { ?>/<?=$new['id_parent']?><?php } ?>/news/<?=$new['id_news']?>"><img class="img" style="height: 100px; width: 100%" src="/images/<?=$new['id_news']?>.jpg"></a>
                                <div class="caption" style="height: 90px; margin-top: -10px">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="height: 55px">
                                            <h4><a href = "/category/<?=$new['id_category']?><?php if(isset($new['id_parent'])) { ?>/<?=$new['id_parent']?><?php } ?>/news/<?=$new['id_news']?>"><?=$new['title']?></a></h4>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="height: 35px">
                                            <p style="margin-top: -10px"><em style="font-size: 12px;"><?=$new['date']?></em></p>
                                            <p style="margin-top: -10px"><em style="font-size: 12px; margin-right: 10px;">
                                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$new['likes']; ?>
                                                <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($new['id_news'])?>
                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$new['views']?>
                                            </em></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <?php } else {echo "Нет новостей в данной категории";} ?>
                </div>
            <hr>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <h4 style="text-align: center; margin-bottom: -15px; margin-top: -10px">Последнии новости</h4><hr>
                    <?php foreach($latestNews as $new) {
                        $dateTime = explode(' ', $new['date']);
                        $time = explode(':', $dateTime[1]);?>
                    <div class="row" style="margin-top: -10px; margin-bottom: -20px">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <em><?=$time[0] . ':' . $time[1]?></em>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <a href = "/category/<?=$new['id_category']?><?php if(isset($new['id_parent'])) { ?>/<?=$new['id_parent']?><?php } ?>/news/<?=$new['id_news']?>"><?=$new['title']?></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1" style="font-size: 12px; margin-right: 20px">
                            <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 10px;"></span><?=Comment::getTotalCommentsByNews($new['id_news'])?>
                        </div>
                    </div>

                    <?php } ?>
                    <hr>
                </div>


                <div class="col-lg-7 col-md-7 col-sm-7">

                    <h4 style="text-align: center; margin-bottom: -15px; margin-top: -10px">Рекомендованные новости</h4><hr>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 205px; width: 100%">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img style="height: 205px; width: 100%" src="/images/<?=$sliderNews[0]['id_news']?>.jpg" alt="...">
                            <div class="carousel-caption">
                                <a href="/category/<?=$sliderNews[0]['id_category']?><?php if(isset($sliderNews[0]['id_parent'])) { ?>/<?=$sliderNews[0]['id_parent']?><?php } ?>/news/<?=$sliderNews[0]['id_news']?>"><h3><?=$sliderNews[0]['title'];?></h3></a>
                                <?php unset($sliderNews[0]) ?>
                            </div>
                        </div>
                        <?php foreach($sliderNews as $sliderNew) { ?>
                            <div class="item">
                                <img style="height: 205px; width: 100%" src="/images/<?=$sliderNew['id_news']?>.jpg" alt="...">
                                <div class="carousel-caption">
                                    <a href="/category/<?=$sliderNew['id_category']?><?php if(isset($sliderNew['id_parent'])) { ?>/<?=$sliderNew['id_parent']?><?php } ?>/news/<?=$sliderNew['id_news']?>?>"><h3><?=$sliderNew['title'] ?></h3> </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($categories as $arrayCategory) { ?>
                    <?php foreach ($arrayCategory as $category) { ?>
                        <?php if(count($arrayCategory) == 1) {?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                                <a href="/category/<?=$category['id_category'] ?>"><h4 style="margin-right: 10px; margin-bottom: -15px; margin-top: -10px"><?=$category['category']?></h4></a><hr>
                            </div>
                            <?php $categoryNews = News::getNewsListByCategory($category['id_category']); ?>
                            <?php if(!empty($categoryNews)) { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php for($i=0; $i<2; $i++) { ?>
                                    <?php if(!empty($categoryNews[$i])) { ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="thumbnail">
                                            <a href = "/category/<?=$category['id_category'] ?>/news/<?=$categoryNews[$i]['id_news']?>"><img class="img" style="height: 100px; width: 100%" src="/images/<?=$categoryNews[$i]['id_news']?>.jpg"></a>
                                            <div class="caption" style="height: 90px; margin-top: -10px">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="height: 55px">
                                                        <h4><a href = "/category/<?=$category['id_category'] ?>/news/<?=$categoryNews[$i]['id_news']?>"><?=$categoryNews[$i]['title']?></a></h4>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="height: 35px">
                                                        <p style="margin-top: -10px"><em style="font-size: 12px;"><?=$categoryNews[$i]['date']?></em></p>
                                                        <p style="margin-top: -10px"><em style="font-size: 12px; margin-right: 10px;">
                                                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$categoryNews[$i]['likes']; ?>
                                                                <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($categoryNews[$i]['id_news'])?>
                                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$categoryNews[$i]['views']?>
                                                            </em></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <?php unset($categoryNews[$i]);} ?>
                                <?php foreach($categoryNews as $new)  { ?>
                                <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top: 10px">
                                    <a href = "/category/<?=$category['id_category'] ?>/news/<?=$new['id_news']?>"><?=$new['title']?></a>
                                    <div style="float: right">
                                    <p style="margin-top: -10px"><em style="font-size: 12px;"><?=$new['date']?></em></p>
                                    <p style="margin-top: -10px"><em style="font-size: 12px; margin-right: 10px;">
                                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$new['likes']; ?>
                                            <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($new['id_news'])?>
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$new['views']?>
                                        </em></p>
                                    </div>
                                    <hr>
                                </div>
                                <?php } ?>


                                </div>

                            <?php } else { ?>
                                <h5><?='Нет новостей в данной категории'?></h5>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php }  ?>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2">


            <div class="row" style="margin-top: -6px">
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; height: 200px;">
                    <h4 style="text-align: center">Топ-5 комментаторов</h4>
                    <?php foreach($topFive as $topUsers) { ?>
                        <h5><a href = "/comment/<?=$topUsers['id_user']?>"><?=$topUsers['login']?></a></h5>
                    <?php } ?>
                    <hr>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                    Реклама
                </div>
            </div>
        </div>

    </div>
    </div>
    <hr>

    <?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>