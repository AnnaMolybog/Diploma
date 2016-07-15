<?php

class SiteController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
        $latestNews = News::getLatestNews($page);
        $sliderNews = News::getRecommendedNews();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();

        require_once (VIEWS_PATH . DS . 'site' . DS . 'index.php');

        return true;

    }
}