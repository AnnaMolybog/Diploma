
<br>
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1">

    </div>
    <div class="col-lg-10 col-md-10 col-sm-10">
        <form name="id_comment" class="form-inline" method="post" action="/admin/categoryAdd">
            <div class="form-group">
                <label for="inputPassword2" class="sr-only">Категория</label>
                <input name="category" type="text" class="form-control" id="inputPassword2">
            </div>
            <button type="submit" class="btn btn-default" name="add">Добавить</button>
        </form>
        <br>
        <?php foreach ($categories as $category) { ?>

        <form name="id_comment" class="form-inline" method="post" action="/admin/categoryAdd">
            <input name="id_category" type="hidden" class="form-control" id="inputPassword2" value="<?=$category[0]['id_category']?>">
            <div class="form-group">
                <label for="inputPassword2" class="sr-only">Категория</label>
                <input name="category" type="text" class="form-control" id="inputPassword2" value="<?=$category[0]['category']?>">
            </div>
            <button type="submit" class="btn btn-default" name="update">Изменить</button>
            <button type="submit" class="btn btn-default" name="delete">Удалить</button>
        </form>
        <br>
        <?php }?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
    </div>



</div>
<hr>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>