
<br>
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1">

    </div>
    <div class="col-lg-10 col-md-10 col-sm-10">
        <?php foreach($commentsForApprove as $comments) { ?>
        <form name="id_comment" class="form-inline" method="post" action="/admin/commentApprove">
            <input name="id_comment" type="hidden" class="form-control" id="inputPassword2" value="<?=$comments['id_comment']?>">
            <div class="form-group">
                <label class="sr-only">Логин</label>
                <p class="form-control-static"><?=$comments['login']?></p>
            </div>
            <div class="form-group">
                <label for="inputPassword2" class="sr-only">Комментарий</label>
                <input name="comment" type="text" class="form-control" id="inputPassword2" value="<?=$comments['comment']?>">
            </div>
            <button type="submit" class="btn btn-default" name="approve">Подтвердить</button>
            <button type="submit" class="btn btn-default" name="delete">Удалить</button>
        </form>
            <br>
        <?php } ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
    </div>



</div>
<hr>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'admin_footer.php');?>