<?php

class TagController
{

    public function actionTag($tagId, $page = 1)
    {
        //Список категорий для верхнего меню
        $categories = Category::getCategories();
        //Список новостей c данным тегом
        $tagNews = News::getNewsByTag($tagId, $page);
        //Pagination
        $total = News::getTotalNewsByTag($tagId);
        $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');
        $tags = Tag::getTags();

        require_once (VIEWS_PATH . DS . 'tag' . DS . 'tag.php');
        return true;


    }

    public function actionSearch($page = 1)
    {
        $tagName = ($_POST['tag']);
        $categories = Category::getCategories();
        //Список новостей c данным тегом
        $tags = Tag::getTags();
        $tagId = Tag::getIdByTagName($tagName);
        if($tagId) {
            $tagNews = News::getNewsByTag($tagId, $page);
            //Pagination
            $total = News::getTotalNewsByTag($tagId);
            $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');

            require_once (VIEWS_PATH . DS . 'tag' . DS . 'tag.php');
            return true;
        } else {
            header("Location: /");
        }

    }
}