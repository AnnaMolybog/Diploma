
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="row">
                    <?php if(!empty($tagNews)) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 style="margin-left: 20px"><a href = "/tag/<?=$tagNews[0]['id_tag']?>"><?=ucfirst($tagNews[0]['tag'])?></a></h3>
                        <hr>
                    </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="col-sm-12 col-md-12">

                                <div class="thumbnail">
                                    <a href = "/news/<?=$tagNews[0]['id_news']?>"><img class="img" style="height: 350px; width: 100%" src="/www/images/<?=$tagNews[0]['id_news']?>.jpg"></a>
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
                                        <a href = "/news/<?=$new['id_news']?>"><img class="img" style="height: 140px; width: 100%" src="/www/images/<?=$new['id_news']?>.jpg"></a>
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
                <nav style="text-align: center">
                    <?php echo $pagination->get(); ?>
                </nav>

            </div>




<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>