
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2">
            Реклама
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
                <?php if(isset($errors) && is_array($errors)) { ?>
                    <ul>
                        <?php foreach($errors as $error) { ?>
                            <li> <?=$error?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            <h3>Форма авторизации</h3>
            <form method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userEmail?>">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="user_password" placeholder="Пароль" value="<?=$userPassword?>">
                </div>
                <input type="submit" class="btn btn-default" name="submit" value="Войти">
            </form>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2">
            Реклама

        </div>

    </div>
<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>