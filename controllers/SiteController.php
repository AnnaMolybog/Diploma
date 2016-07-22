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
        $advertising = Advertising::getAdvertising();
        $mostViewedAdvertising = [$advertising[0], $advertising[1]];
        unset($advertising[0], $advertising[1]);
        shuffle($advertising);

        $userInfo = User::checkLogged();

        /*if($userInfo['role'] == 1) {
            header("Location: /admin");
        }*/

        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');
        require_once (VIEWS_PATH . DS . 'site' . DS . 'index.php');

        return true;

    }

    public function actionAdvertising($advertisingId)
    {
        $views = Advertising::getCurrentAdvertising($advertisingId);
        $totalViews = $views['views'] + 1;
        Advertising::updateViews($advertisingId, $totalViews);
        $location = $views['company'];
        header("Location: $location");
    }
}

