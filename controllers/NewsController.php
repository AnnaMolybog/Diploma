<?php

class NewsController
{
    //Просмотр всех страниц
    public function actionList()
    {
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');

        $latestNews = News::getLatestNews();
        //$newsList = News::getNewsList();
        require_once (VIEWS_PATH . DS . 'news' . DS . 'list.php');
    }

    //Просмотр одной страницы
    public function actionView($id, $categoryId = null, $subCategory = null, $page = 1)
    {

        $id = intval($id);

        if(!empty($categoryId)){
            $categoryId = intval($categoryId);
        }
        if(!empty($subCategory)){
            $subCategory = intval($subCategory);
        }
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'header.php');

        $newsItem = News::getNewsById($id, $categoryId, $subCategory);
        $commentsByNews = Comment::getCommentsByNews($id);
        $currentViews = rand(1,5);
        $updatedViews = $newsItem['views'] + $currentViews;

        News::updateViews($newsItem['id_news'], $updatedViews);


        $tagsByNews = News::getTagsByNews($id);

        $totalComments = Comment::getTotalCommentsByNews($id);

        $userInfo = User::checkLogged();

       /* if($userInfo['role'] == 1) {
            header("Location: /admin");
        }*/

        if($newsItem['id_parent'] == 0) {
            $categoryId = $newsItem['id_category'];
        } else {
            $categoryId = $newsItem['id_parent'];
        }

        if(!User::isGuest()) {
            $userLogin = User::getUserLoginById($_SESSION['user']);
        }

        if(isset($_POST['submit'])) {

            $comment = $_POST['comment'];
            $userId = $_SESSION['user'];
            $newsId = $newsItem['id_news'];
            $date = date("Y-m-d H:i:s");
            if($_POST['id_category'] == 4 ) {
                $approved = 0;

            } else {
                $approved = 1;
            }
            Comment::editComment($comment, $userId, $newsId, $date, $approved);
        }

        if(isset($_POST['response'])) {
            $parent_comment = $_POST['parent_comment'];
            $comment = $_POST['comment'];
            $userId = $_SESSION['user'];
            $newsId = $newsItem['id_news'];
            $date = date("Y-m-d H:i:s");
            if($_POST['id_category'] == 4 ) {
                $approved = 0;

            } else {
                $approved = 1;
            }
            Comment::editComment($comment, $userId, $newsId, $date, $approved, $parent_comment);
        }

        require_once (VIEWS_PATH . DS . 'news' . DS . 'view.php');

        return true;
    }

}
