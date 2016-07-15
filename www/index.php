<?php

//General settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
define('VIEWS_PATH', ROOT . DS . 'views');
define('ARTICLE_LENGTH_MAIN_PAGE', 200);
define('LATEST_NEWS_DAYS', 10);
define('NEWS_PER_PAGE', 5);
define('RECOMMENDED_NEWS', 3);
define('NEWS_LENGTH_ANALYTIC', 260);
define('ANALYTIC_CATEGORY', 7);
define('COMMENTS_PER_PAGE', 5);

session_start();
//Подключение файлов системы
require_once(ROOT . DS . 'components' . DS . 'autoload.php');

//Вызов Router, который определяет контроллер и метод
$router = new Router();
$router->run();
