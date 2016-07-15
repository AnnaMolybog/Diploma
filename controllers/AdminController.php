<?php

class AdminController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
        $latestNews = News::getLatestNews($page);
        $sliderNews = News::getRecommendedNews();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();

        $userId = User::checkLogged();

        require_once (VIEWS_PATH . DS . 'admin' . DS . 'index.php');

        return true;

    }
}