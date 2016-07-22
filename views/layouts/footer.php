<div class="col-lg-2 col-md-2 col-sm-2">
    <div class="row" style="margin-top: -6px">
        <hr>
        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; height: 200px;">
            <h4 style="text-align: center">Топ-5 комментаторов</h4>
            <?php foreach($topFive as $topUsers) { ?>
                <h5><a href = "/comment/<?=$topUsers['id_user']?>"><?=$topUsers['login']?></a></h5>
            <?php } ?>
            <hr>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-right: 10px">
            <a href="/advertisingViews/<?=$mostViewedAdvertising[1]['id_advertising']?>" style="text-decoration: none;" ><div class="thumbnail" style="margin-left: 10px; background-color: beige" onmouseover="mouseOver3()" onmouseout="mouseOut3()" id="advertising3">
                    <h4><b><?=$mostViewedAdvertising[1]['product_name']?></b></h4>
                    <div class="caption" style="margin-top: -20px">
                        <h4 id="price3"><?=$mostViewedAdvertising[1]['price']?> грн</h4>
                        <h4 id="discount3" style="display: none"><?=$mostViewedAdvertising[1]['price']*0.9?> грн</h4>
                        <h5><?=$mostViewedAdvertising[1]['company']?></h5>
                    </div>
                </div></a>
            <div id="bg_popup3" style="display: none;">
                <p>Купон на скидку 10%</p>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-right: 10px">
            <a href="/advertisingViews/<?=$advertising[1]['id_advertising']?>" style="text-decoration: none;"><div class="thumbnail" style="margin-left: 10px; background-color: beige" onmouseover="mouseOver4()" onmouseout="mouseOut4()" id="advertising4">
                    <h4><b><?=$advertising[1]['product_name']?></b></h4>
                    <div class="caption" style="margin-top: -20px">
                        <h4 id="price4"><?=$advertising[1]['price']?> грн</h4>
                        <h4 id="discount4" style="display: none"><?=$advertising[1]['price']*0.9?> грн</h4>
                        <h5><?=$advertising[1]['company']?></h5>
                    </div>
                </div></a>
            <div id="bg_popup4" style="display: none;">
                <p>Купон на скидку 10%</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<hr>

<footer style="text-align: center">
    <p>Мой блог<br>Copyright &copy; 2016</p>
</footer>
</div> <!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>