<?php

class CategoryController
{
    public function actionCategory($categoryId, $page = 1)
    {
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();
        $advertising = Advertising::getAdvertising();
        $mostViewedAdvertising = [$advertising[0], $advertising[1]];
        unset($advertising[0], $advertising[1]);
        shuffle($advertising);

        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        //Список новостей данной категории
        $categoryNews = News::getNewsListByCategory($categoryId, $page);

        //Pagination
        $total = News::getTotalNewsInCategory($categoryId);

        $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');

        $userInfo = User::checkLogged();

       /* if($userInfo['role'] == 1) {
            header("Location: /admin");
        }*/

        require_once (VIEWS_PATH . DS . 'category' . DS . 'category.php');

        return true;

    }

    public function actionSubCategory($categoryId, $subCategory, $page = 1)
    {
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();
        $advertising = Advertising::getAdvertising();
        $mostViewedAdvertising = [$advertising[0], $advertising[1]];
        unset($advertising[0], $advertising[1]);
        shuffle($advertising);

        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');

        $userInfo = User::checkLogged();

        /*if($userInfo['role'] == 1) {
            header("Location: /admin");
        }*/

        //Список новостей данной категории
        $categoryNews = News::getNewsListBySubCategory($categoryId, $subCategory, $page);
        //echo "<pre>";
        //print_r($categoryNews);
        $total = News::getTotalNewsInSubCategory($categoryId, $subCategory);

        $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');

        require_once (VIEWS_PATH . DS . 'category' . DS . 'category.php');
        return true;
    }
}

