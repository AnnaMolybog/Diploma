<?php

class User
{
    public static function register($userLogin, $userEmail, $userPassword, $roleId = 2)
    {
        $db = DB::getConnection();
        $sql = $db->query("INSERT INTO users (login, email, password, id_role)
                          VALUES ('$userLogin', '$userEmail', '$userPassword', '$roleId')");
        if($sql) {
            return true;
        } else {
            return false;
        }

    }

    public static function checkLogin($userLogin)
    {
        if(strlen($userLogin) >= 2) {
            return true;
        }

        return false;
    }

    public static function checkPassword($userPassword)
    {
        if(strlen($userPassword) >= 4) {
            return true;
        }

        return false;
    }

    public static function checkEmail($userEmail)
    {
        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public static function checkEmailExists($userEmail)
    {

        $db = DB::getConnection();
        $sql = $db->query("SELECT * FROM users WHERE email = '$userEmail'");

        if($sql->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkUserData($userEmail, $userPassword)
    {
        $db = DB::getConnection();
        $sql = $db->query("SELECT * FROM users WHERE email = '$userEmail' AND password = '$userPassword'");
        $user = $sql->fetch();
        $result['id_user'] = $user['id_user'];
        $result['id_role'] = $user['id_role'];
        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function auth($userId, $userRole)
    {
        $_SESSION['user'] = $userId;
        $_SESSION['role'] = $userRole;
    }

    public static function checkLogged()
    {
        if(isset($_SESSION['user']) && isset($_SESSION['role'])) {
            $userInfo['user'] = $_SESSION['user'];
            $userInfo['role'] = $_SESSION['role'];
            return $userInfo;
        }
    }

    public static function isGuest()
    {
        if(isset($_SESSION['user'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function getUserLoginById($userId) {
        $db = DB::getConnection();
        $sql = $db->query('SELECT login FROM users WHERE id_user = ' . $userId);
        $userLogin = $sql->fetch();
        return $userLogin['login'];
    }
}


