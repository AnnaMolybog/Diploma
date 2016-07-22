        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="row">
                <?php if(!empty($categoryNews)) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="col-sm-12 col-md-12">
                            <div class="thumbnail">
                                <a href = "/category/<?=$categoryNews[0]['id_category']?><?php if($categoryNews[0]['id_parent'] !=0) { ?>/<?=$categoryNews[0]['id_parent']?><?php } ?>/news/<?=$categoryNews[0]['id_news']?>"><img style="height: 300px; width: 100%" class="img" src="/www/images/<?=$categoryNews[0]['id_news']?>.jpg"></a>
                                <div class="caption" style="height: 100px; margin-top: -10px">
                                    <h3><a href = "/category/<?=$categoryNews[0]['id_category']?><?php if(($categoryNews[0]['id_parent'])!=0) { ?>/<?=$categoryNews[0]['id_parent']?><?php } ?>/news/<?=$categoryNews[0]['id_news']?>"><?=$categoryNews[0]['title']?></a></h3>
                                    <em style="font-size: 12px"><?=$categoryNews[0]['date']?></em>
                                    <em style="float: right; font-size: 12px; margin-right: 10px">
                                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 5px;"></span><?=$categoryNews[0]['likes']; ?>
                                        <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 5px;"></span><?=Comment::getTotalCommentsByNews($categoryNews[0]['id_news'])?>
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 5px;"></span><?=$categoryNews[0]['views']; unset($categoryNews[0])?>
                                    </em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">

                        <?php foreach($categoryNews as $new) { ?>
                            <div class="col-sm-6 col-md-6">
                                <div class="thumbnail">
                                    <a href = "/category/<?=$new['id_category']?><?php if(($new['id_parent']) != 0) { ?>/<?=$new['id_parent']?><?php } ?>/news/<?=$new['id_news']?>"><img class="img" style="height: 100px; width: 100%" src="/www/images/<?=$new['id_news']?>.jpg"></a>
                                    <div class="caption" style="height: 90px; margin-top: -10px">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="height: 55px">
                                                <h4><a href = "/category/<?=$new['id_category']?><?php if(($new['id_parent'])!=0) { ?>/<?=$new['id_parent']?><?php } ?>/news/<?=$new['id_news']?>"><?=$new['title']?></a></h4>
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
            <nav style="text-align: center">
                <?php echo $pagination->get(); ?>
            </nav>
        </div>



<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>