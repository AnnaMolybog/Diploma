<!-- Button trigger modal -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" style="margin-top: 9px">
    Расширенный поиск
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/news/search">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Расширенный поиск</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" >
                        <label>Дата</label><br>
                        <label>
                            Oт: <input type="date" class="form-control" name="date_from">
                        </label>
                        <label>
                            До: <input type="date" class="form-control" name="date_to">
                        </label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Категории</label><br>
                        <?php foreach($categories as $category) {
                            if(!empty($category)){ ?>
                        <label class="checkbox-inline">
                            <input name="category[]" type="checkbox" id="inlineCheckbox1" value="<?=$category[0]['id_category']?>"><?=$category[0]['category']?>
                        </label>
                            <?php }  ?>
                        <?php }  ?>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Теги</label><br>
                        <input type="text" class="form-control" name="tags" placeholder="Перед тегами ставить #, между тегами не ставить пробелов">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="search">Поиск</button>
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>