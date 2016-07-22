
<br>
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1">

    </div>
    <div class="col-lg-10 col-md-10 col-sm-10">
        <form class="form-inline" method="post" action="/admin/advertisement">
            <div class="form-group">
                <label>Товар</label>
                <input name="product_name" type="text" class="form-control" placeholder="Наименование товара">
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input name="price" type="text" class="form-control" placeholder="Цена в грн">
            </div>
            <div class="form-group">
                <label>Продавец</label>
                <input name="company" type="text" class="form-control" placeholder="Ссылка на сайт продавца">
            </div>
            <button type="submit" class="btn btn-default" name="add">Добавить</button>
        </form>
        <br>
        <?php foreach ($advertising as $item) { ?>
        <form class="form-inline" method="post" action="/admin/advertisement">
            <input name="id_advertising" type="hidden" class="form-control" value="<?=$item['id_advertising']?>">
            <div class="form-group">
                <label>Товар</label>
                <input name="product_name" type="text" class="form-control" value="<?=$item['product_name']?>">
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input name="price" type="text" class="form-control" value="<?=$item['price']?>">
            </div>
            <div class="form-group">
                <label>Продавец</label>
                <input name="company" type="text" class="form-control" value="<?=$item['company']?>">
            </div>
            <div class="form-group">
                <label>Просмотры</label>
                <input disabled name="views" type="text" class="form-control" value="<?=$item['views']?>">
            </div>
            <button type="submit" class="btn btn-default    " name="update">Редактировать</button>
            <button type="submit" class="btn btn-default" name="delete">Удалить</button>
        </form>
            <br>
        <?php }?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
    </div>



</div>
<hr>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'admin_footer.php');?>