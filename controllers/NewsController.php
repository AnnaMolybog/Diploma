<?php

class NewsController
{
    public function __construct()
    {
        $tags = Tag::getTags();
    }

    //Просмотр всех страниц
    public function actionList()
    {

        $latestNews = News::getLatestNews();
        $tags = Tag::getTags();
        //$newsList = News::getNewsList();
        require_once (VIEWS_PATH . DS . 'news' . DS . 'list.php');
    }

    //Просмотр одной страницы
    public function actionView($id, $page = 1)
    {
        $tags = Tag::getTags();
        $categories = Category::getCategories();
        $newsItem = News::getNewsById($id);
        $commentsByNews = Comment::getCommentsByNews($newsItem['id_news'], $page);

        $currentViews = rand(1,5);
        $views = $newsItem['views'] + $currentViews;
        News::updateViews($id, $views);
        $tagsByNews = News::getTagsByNews($id);

        $totalComments = Comment::getTotalCommentsByNews($newsItem['id_news']);
        $pagination = new Pagination($totalComments, $page, COMMENTS_PER_PAGE, 'page-');



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
            Comment::editComment($comment, $userId, $newsId, $date);
        }

        if(isset($_POST['response'])) {
            $parent_comment = $_POST['parent_comment'];
            $comment = $_POST['comment'];
            $userId = $_SESSION['user'];
            $newsId = $newsItem['id_news'];
            $date = date("Y-m-d H:i:s");
            Comment::editComment($comment, $userId, $newsId, $date, $parent_comment);
        }

        require_once (VIEWS_PATH . DS . 'news' . DS . 'view.php');

        return true;
    }

    public function actionLikes($newsId, $commentId)
    {
        $commentsByNews = Comment::getCommentsByNews($newsId);
        $likes = $commentsByNews[0][0]['likes'] + 1;
        Comment::updateLikes($commentId, $likes);
        header("Location: /news/$newsId");
    }

    public function actionDislikes($newsId, $commentId)
    {
        $commentsByNews = Comment::getCommentsByNews($newsId);
       //print_r($commentsByNews); die();
        $dislikes = $commentsByNews[0][0]['dislikes'] + 1;
        Comment::updateDislikes($commentId, $dislikes);
        header("Location: /news/$newsId");
    }
}
