<?php
class UserController
{
    public function actionRegister($page = 1)
    {
        $categories = Category::getCategories();
        $latestNews = News::getLatestNews($page);
        $sliderNews = News::getRecommendedNews();
        $tags = Tag::getTags();

        $userLogin = '';
        $userEmail = '';
        $userPassword = '';
        $result = '';

        if(isset($_POST['submit'])) {
            $userLogin = $_POST['user_login'];
            $userEmail = $_POST['user_email'];
            $userPassword = $_POST['user_password'];

            $errors = false;

            if(!User::checkLogin($userLogin)) {
                $errors[] = 'Имя не должно быть короче 2х символов';
            }

            if(!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if(!User::checkPassword($userPassword)) {
                $errors[] = 'Пароль не должен быть короче 4х символов';
            }

            if(User::checkEmailExists($userEmail)) {
                $errors[] = 'Такой email уже используется';
            }

            if($errors == false) {
                $result = User::register($userLogin, $userEmail, $userPassword);
            }
        }


        require_once (VIEWS_PATH . DS . 'user' . DS . 'register.php');
        return true;
    }

    public function actionLogin($page = 1)
    {
        $categories = Category::getCategories();
        $latestNews = News::getLatestNews($page);
        $sliderNews = News::getRecommendedNews();
        $tags = Tag::getTags();

        $userEmail = '';
        $userPassword = '';

        // Обработка формы
        if (isset($_POST['submit'])) {

            $userEmail = $_POST['user_email'];
            $userPassword = $_POST['user_password'];

            $errors = false;
            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($userPassword)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            // Проверяем существует ли пользователь
            $result = User::checkUserData($userEmail, $userPassword);
            $userId = $result['id_user'];
            $userRole = $result['id_role'];
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);
                if($userRole == 2) {
                    header("Location: /");
                } elseif ($userRole == 1) {
                    header("Location: /admin");
                }
            }
        }
        require_once (VIEWS_PATH . DS . 'user' . DS . 'login.php');
        return true;
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }
}
