<script>



    window.onbeforeunload = function() {
        return "You're leaving the site.";
    };
    $(document).ready(function() {

        $('a').click(function() { window.onbeforeunload = null; });
        $('form').submit(function() { window.onbeforeunload = null; });
        $(window).(function() { window.onbeforeunload = null; });
    });
</script>

<div id="ouibounce-modal" style="display: block;">
    <div class="ouibounce-underlay"></div>
    <div class="ouibounce-modal">
        <div class="ouibounce-modal-close">Уже подписан <span class="ouibounce-modal-close-icon"></span></div>
        <div class="ouibounce-modal-title">Подпишитесь на нас</div>
        <div class="ouibounce-modal-desc">и узнавайте о новых постах первыми</div>
        <div class="ouibounce-modal-social">
            <div class="header__social header__social_ouibounce">
                <a rel="nofollow" class="social-link social-link_ouibounce social-link_vk" href="https://vk.com/postovoynet" target="_blank"></a>
                <a rel="publisher" class="social-link social-link_ouibounce social-link_gp" href="https://plus.google.com/u/0/b/107256036452905739930/+PostovoyNet" target="_blank"></a>
                <a rel="nofollow" class="social-link social-link_ouibounce social-link_fb" href="https://www.facebook.com/postovoynet" target="_blank"></a>
                <a rel="nofollow" class="social-link social-link_ouibounce social-link_tw" href="https://twitter.com/postovoynet" target="_blank"></a>
                <a rel="nofollow" class="social-link social-link_ouibounce social-link_rs" href="http://feeds.feedburner.com/postovoynet" target="_blank"></a>
            </div>
        </div>
        <div class="ouibounce-modal-vk">
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
            <!-- VK Widget -->
            <div id="vk-groups_ouibounce" style="height: 217px; width: 355px; background: none;"><iframe name="fXDb2e3d" frameborder="0" src="http://vk.com/widget_community.php?app=0&amp;width=355px&amp;_ver=1&amp;gid=55565230&amp;mode=1&amp;color1=FFFFFF&amp;color2=272727&amp;color3=272727&amp;class_name=&amp;height=140&amp;url=http%3A%2F%2Fpostovoy.net%2F10-modalnyh-okon-na-jquery-dlya-adaptivnogo-sayta.html&amp;referrer=https%3A%2F%2Fwww.google.com.ua%2F&amp;title=10%20%D0%BC%D0%BE%D0%B4%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D1%85%20%D0%BE%D0%BA%D0%BE%D0%BD%20%D0%BD%D0%B0%20jQuery%20%D0%B4%D0%BB%D1%8F%20%D0%B0%D0%B4%D0%B0%D0%BF%D1%82%D0%B8%D0%B2%D0%BD%D0%BE%D0%B3%D0%BE%20%D1%81%D0%B0%D0%B9%D1%82%D0%B0&amp;1560f5f7111" width="355" height="200" scrolling="no" id="vkwidget2" style="overflow: hidden; height: 217px;"></iframe></div>
            <script type="text/javascript">

                VK.Widgets.Group("vk-groups_ouibounce", {mode: 1, width: "355", height: "140", color1: 'FFFFFF', color2: '272727', color3: '272727'}, 55565230);

            </script>

        </div>
    </div>
</div>

<script>

    // https://github.com/carlsednaoui/ouibounce
    var _ouibounce = ouibounce(document.getElementById('ouibounce-modal'), {
        sensitivity: 20, // Чувствительность. Defaults to 20.
        aggressive: false, // Агрессивный режим - модальное окно будет показываться постоянно
        timer: 3000, // задержка перед срабатыванием скрипта
        delay: 100, // задержка перед появлением модального окна
        cookieExpire: 182 // Количество дней, прежде чем модальное появится для пользователя снова
    });

    $('.ouibounce-underlay, .ouibounce-modal-close').on('click', function () {
        $('#ouibounce-modal').hide();
    });
    $('.ouibounce-modal').on('click', function (e) {
        e.stopPropagation();
    });

</script>
\

var isUserHere = function(){
var user = true;
};
$('a').click(function() { isUserHere; });
$('form').submit(function() { isUserHere; });
$(window).onload (function() { isUserHere; });
if(!isUserHere()){
alert("???");
}
<script>
var hostName = window.location.hostname;
var myFunction = function (currentHostName) {
if (currentHostName === hostName) {
alert('Ok');
} else {
confirm('Yes?');
}
};

$(document).ready(function() {
var currentHostName = window.location.hostname;
console.log(window.location.hostname);
$(window).onbeforeunload = myFunction(currentHostName);
});

</script>





url: "/category/<?=$newsItem['id_category']?><?php if(($newsItem['id_parent'])!=0) { ?>/<?=$newsItem['id_parent']?><?php } ?>/news/<?=$newsItem['id_news']?>",



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Подпишитесь на новостную рассылку</h4>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>





/////////////////////////////////////////////////////////////////////////////////
var delay_popup = 5000;
setTimeout("document.getElementById('bg_popup').style.display='block'", delay_popup);

<div id="bg_popup" style="background-color: rgba(0, 0, 0, 0.8);
                        display: none;
                        position: fixed;
                        z-index: 99999;
                        top: 0;
                        right: 0;
                        bottom: 0;
                        left: 0;">

    <div id="popup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Подпишитесь на новостную рассылку</h4>
                    <a class="close" href="#" title="Закрыть" onclick="document.getElementById('bg_popup').style.display='none'; return false;">X</a>
                </div>
                <div class="modal-body">
                    <form action="#"  method="post">
                        <div class="form-group">
                            <label>Логин</label>
                            <input type="text" class="form-control" name="user_login" placeholder="Логин"">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="user_email" placeholder="Email"">
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" class="form-control" name="user_password" placeholder="Пароль">
                        </div>
                        <input type="submit" class="btn btn-default" name="submit" value="Зарегистрироваться">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>

        </div>
    </div>
</div>

///////////////////

<script type="text/javascript" src="js/jquery.cookie.js"></script>
<div id="pp" style="top: 150px;">
    <div class="pp-header">
        <h3>Хочешь создать сайт?<br>Подпишись на бесплатный курс!</h3>
    </div>
    <div class="pp-content">
        <div class="pp-content-main">
            <h4>Из курса ты узнаешь:</h4>
            <ul>
                <li><i class="fa fa-check"></i>Как сделать локальный хостинг;</li>
                <li><i class="fa fa-check"></i>Как установить WordPress;</li>
                <li><i class="fa fa-check"></i>Как установить и настроить шаблоны и плагины;</li>
                <li><i class="fa fa-check"></i>Как создавать современные сайты;</li>
                <li><i class="fa fa-check"></i>Как создать домен и установить сайт на хостинг.</li>
            </ul>
        </div>
        <div class="pp-content-sidebar">
            <i class="fa fa-wordpress"></i>
        </div>
    </div>
    <div class="pp-footer">
        <form>
            <input type="text" placeholder="Ваше имя">
            <input type="text" placeholder="email@email.com">
            <input class="btn" type="submit" value="Подписаться на курс">
        </form>
    </div>
</div>