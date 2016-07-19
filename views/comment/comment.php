<div class="row">
<div class="col-lg-2 col-md-2 col-sm-2">
    Реклама
</div>
<div class="col-lg-8 col-md-8 col-sm-8">
    <a href="/comment/<?=$userComments[0]['id_user']?>"><h4><?=$userComments[0]['login']?></h4></a>
    <?php if(User::isGuest() or ($userComments[0]['id_user'] != $_SESSION['user'])) { ?>

        <?php foreach($userComments as $comment) { ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><?=$comment['comment']?></p>
                    <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-right: 10px;"></span><?=$comment['likes']?>
                    <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="padding-right: 10px;"></span><?=$comment['dislikes']?>
                </div>
            </div>
        <?php }?>
    <?php } else { ?>
    <?php foreach($userComments as $comment) { ?>
        <form method="post" action="/comment/edit">
            <div class="form-group">
                <input type="hidden" class="form-control" name="parent_comment" value="<?=$comment['parent_comment']?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="id_comment" value="<?=$comment['id_comment']?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="id_news" value="<?=$comment['id_news']?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="id_user" value="<?=$comment['id_user']?>">
            </div>
            <div class="form-group">
                <label>Статья:  </label>
                <h4><a href="/news/<?=$comment['id_news']?>"><?=$comment['title']?></a></h4>
            </div>
            <div class="form-group">
                <label>Комментарий</label>
                <textarea rows="3" class="form-control" name="comment"><?=$comment['comment']?></textarea>
            </div>
            <input type="submit" class="btn btn-default" name="response" value="Редактировать">
        </form>
    <?php }?>
    <?php }?>
</div>
<div class="col-lg-2 col-md-2 col-sm-2">
    Реклама
</div>
</div>
<nav style="text-align: center">
    <?php echo $pagination->get(); ?>
</nav>

