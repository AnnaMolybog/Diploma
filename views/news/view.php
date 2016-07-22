
        <div class="col-lg-8 col-md-8 col-sm-8">

            <?php if(isset($_SESSION['role']) && ($_SESSION['role']) == 1) { ?>
                <div id="content"></div>
                <div style="float: right; font-size: 12px; margin-right: 20px;">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 10px;"></span><?=$totalComments?>
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 10px;" id="total_views"></span>
                </div>
                <hr>

                <a href = "/category/<?=$newsItem['id_category']?><?php if(($newsItem['id_parent'])!=0) { ?>/<?=$newsItem['id_parent']?><?php } ?>/news/<?=$newsItem['id_news']?>"><img style="margin-right: 15px" class="img-rounded" width="250" height="250" src="/www/images/<?=$newsItem['id_news']?>.jpg"></a>

                <form method="post" action="/admin/postEdit">
                <div class="form-group">
                    <input name="id" type="hidden" class="form-control" placeholder="Title" value="<?=$newsItem['id_news']?>">
                    <input name="category_parent" type="hidden" class="form-control" placeholder="Title" value="<?=$newsItem['id_category']?>">
                    <input name="views" type="hidden" class="form-control" placeholder="Title" value="<?=$newsItem['views']?>">
                    <input name="likes" type="hidden" class="form-control" placeholder="Title" value="<?=$newsItem['likes']?>">
                    <div class="form-group">
                        <label>Заголовок</label>
                        <input name="title" type="text" class="form-control" placeholder="Title" value="<?=$newsItem['title']?>">
                    </div>
                    <div class="form-group">
                        <label>Дата</label>
                        <input name="date" type="datetime" class="form-control" placeholder="0000-00-00 00-00-00" value="<?=$newsItem['date']?>">
                    </div>
                    <div class="form-group">
                        <label>Содержимое статьи</label>
                        <textarea rows="10" class="form-control" name="content" required><?=$newsItem['content']?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Теги</label>
                            <input name="tag" type="text" class="form-control" placeholder="#tag" value="<?php foreach($tagsByNews as $tag) { echo '#' . $tag['tag'];} ?>">
                    </div>
                    <div class="form-group">
                        <label>Категория</label>
                        <select class="form-control" name="id_category">
                            <?php foreach($categories as $category) { ?>
                                <?php if(!empty($category) and $category[0]['id_category'] != 7) { ?>
                                    <option value="<?=$category[0]['id_category']?>"><?=$category[0]['category']?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <?php
                            if($newsItem['id_category'] == 7) {
                                ?>
                                <input type="checkbox" name="check" checked> Аналитическая статья
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" name="check"> Аналитическая статья
                                <?php
                            }
                            ?>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Изменить</button>
                    <button type="submit" class="btn btn-primary" name="delete">Удалить</button>
                </div>
            </form>
                <h3>Оставить комментарий</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_category" value="<?=$newsItem['id_category']?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_news" value="<?=$newsItem['id_news']?>">
                    </div>
                    <div class="form-group">
                        <label>Логин</label>
                        <input disabled type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userLogin?>">
                    </div>
                    <div class="form-group">
                        <label>Комментарий</label>
                        <textarea rows="3" class="form-control" name="comment" placeholder="Оставьте свой комментарий"></textarea>
                    </div>
                    <input type="submit" class="btn btn-default" name="submit" value="Отправить">
                </form>
                <br>
                <?php $commentsTree = new CommentsTree(); $commentsTree->tree($newsItem['id_category'], $newsItem['id_news'], $commentsByNews);  ?>

            <?php } else { ?>

            <h3><a href = "/category/<?=$newsItem['id_category']?><?php if(($newsItem['id_parent'])!=0) { ?>/<?=$newsItem['id_parent']?><?php } ?>/news/<?=$newsItem['id_news']?>"><?=$newsItem['title']?></a></h3>
            <em><?=$newsItem['date']?><br></em>
            <div id="content"></div>
            <div style="float: right; font-size: 12px; margin-right: 20px;">
                <span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-right: 10px;"></span><?=$totalComments?>
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-right: 10px;" id="total_views"></span>
            </div>
            <hr>

                <a href = "/category/<?=$newsItem['id_category']?><?php if(($newsItem['id_parent'])!=0) { ?>/<?=$newsItem['id_parent']?><?php } ?>/news/<?=$newsItem['id_news']?>"><img style="float: left; margin-right: 15px" class="img-rounded" width="250" height="250" src="/www/images/<?=$newsItem['id_news']?>.jpg"></a>
                <?php if(User::isGuest() && $newsItem['id_category'] == ANALYTIC_CATEGORY) { ?>
                <div style="height: 250px">
                    <p><?=mb_substr($newsItem['content'], 0, NEWS_LENGTH_ANALYTIC);?></p>
                    <p>Для того чтобы посмотреть новость полностью необходимо <a href = "/register"> зарегистрироваться</a></p>
                </div>
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
                    <input type="hidden" class="form-control" name="id_category" value="<?=$newsItem['id_category']?>">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_news" value="<?=$newsItem['id_news']?>">
                </div>
                <div class="form-group">
                    <label>Логин</label>
                    <input disabled type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userLogin?>">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <textarea rows="3" class="form-control" name="comment" placeholder="Оставьте свой комментарий"></textarea>
                </div>
                <input type="submit" class="btn btn-default" name="submit" value="Отправить">
            </form>
                <br>
            <?php } ?>
            <?php $commentsTree = new CommentsTree(); $commentsTree->tree($newsItem['id_category'], $newsItem['id_news'], $commentsByNews) ?>
        <?php } ?>
        </div>

    <script>
        function show()
        {
            $.ajax({
                type: "POST",
                url: "/postViews/<?=$newsItem['id_news']?>/<?=$newsItem['id_category']?><?php if(($newsItem['id_parent'])!=0) { ?>/<?=$newsItem['id_parent']?><?php } ?>",
                cache: false,
                dataType: "json",

                success: function(data){
                    console.log(data.current_views);
                    $("#content").html(data.current_views);
                    $("#total_views").html(data.updated_views);
                }
            });
        }

        $(document).ready(function(){
            show();
            setInterval('show()',3000);
        });
    </script>

    <?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>
