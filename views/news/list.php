
    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1">
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
            <?php foreach ($latestNews as $post) { ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <img class="img-circle" width="200" height="200" src="" style="float: left">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <h3><a href = "news/<?=$post['id_news']?>"><?=$post['title']?></a></h3>
                        <em><?=$post['date']?></em>
                        <p><?=mb_substr($post['content'], 0, ARTICLE_LENGTH_MAIN_PAGE)?><a href = "news/<?=$post['id_news']?>">...</a></p>
                    </div>
                </div><hr>
            <?php } ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            Реклама
        </div>

    </div>
    <hr>
    <nav style="text-align: center">
        <ul class="pagination">
            <li><a href="">Страницы</a></li>
        </ul>
    </nav>

<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>
