<?php

class SiteController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
        //echo "<pre>";
        //print_r($categories);
        $mostReadNews = News::getMostReadNews($page);
        $latestNews = News::getLatestNews($page);
        $sliderNews = News::getRecommendedNews();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();

        $userInfo = User::checkLogged();

        /*if($userInfo['role'] == 1) {
            header("Location: /admin");
        }*/

        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');
        require_once (VIEWS_PATH . DS . 'site' . DS . 'index.php');

        return true;

    }
}