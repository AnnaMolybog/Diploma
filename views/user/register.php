

        <div class="col-lg-8 col-md-8 col-sm-8">
            <?php if($result) { ?>
            <p>Вы зарегистрированы</p>
            <?php } else { ?>
            <?php if(isset($errors) && is_array($errors)) { ?>
            <ul>
                <?php foreach($errors as $error) { ?>
                    <li> <?=$error?></li>
                <?php } ?>
            </ul>
            <?php } ?>
            <?php } ?>
            <h3>Форма регистрации</h3>
            <form action="#"  method="post">
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" class="form-control" name="user_login" placeholder="Логин" value="<?=$userLogin?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="user_email" placeholder="Email" value="<?=$userEmail?>">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="user_password" placeholder="Пароль" value="<?=$userPassword?>">
                </div>
                <input type="submit" class="btn btn-default" name="submit" value="Зарегистрироваться">
            </form>

        </div>

<?php include (VIEWS_PATH . DS . 'layouts' . DS . 'footer.php');?>