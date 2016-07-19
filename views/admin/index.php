
    <br>
    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1">

        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
            <form enctype="multipart/form-data" method="post" action="/admin/postAdd">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input name="title" type="text" class="form-control" placeholder="Заголовок" required>
                </div>
                <div class="form-group">
                    <label>Дата</label>
                    <input name="date" type="datetime" class="form-control" placeholder="0000-00-00 00-00-00" required>
                </div>
                <div class="form-group">
                    <label>Содержимое статьи</label>
                    <textarea rows="10" class="form-control" name="content" required></textarea>
                </div>
                <div class="form-group">
                    <label>Изображение</label>
                    <input type="file" id="exampleInputFile" name="image" required>
                    <p class="help-block">Имя файла должно быть: <?=$imageName?>. Формат файла .jpg</p>
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
                        <input type="checkbox" name="check"> Аналитическая статья
                    </label>
                </div>
                <div class="form-group">
                    <label>Теги</label>
                    <input name="tag" type="text" class="form-control" placeholder="#tag">
                </div>
                    <button type="submit" class="btn btn-primary" name="add">Добавить</button>
            </form>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1">
        </div>



    </div>
    <hr>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>