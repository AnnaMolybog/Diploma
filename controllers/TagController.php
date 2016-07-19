<?php

class TagController
{

    public function actionTag($tagId, $page = 1)
    {
            $categories = Category::getCategories();
            $tags = Tag::getTags();
            require_once(VIEWS_PATH . DS . 'layouts' . DS . 'header.php');

            //Список новостей c данным тегом
            $tagNews = News::getNewsByTag($tagId, $page);
            //Pagination
            $total = News::getTotalNewsByTag($tagId);
            $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');
            $tags = Tag::getTags();

            $userInfo = User::checkLogged();

           /* if ($userInfo['role'] == 1) {
                header("Location: /admin");
            }*/

            require_once(VIEWS_PATH . DS . 'tag' . DS . 'tag.php');
            return true;

    }

    public function actionSearch($page = 1)
    {
        if(!empty($_POST)) {
            $tagName = ($_POST['tag']);
            $tagId = Tag::getIdByTagName($tagName);
        }
        $tagId = $tagId['id_tag'];
        if($tagId) {
            header("Location: /tag/$tagId");
            return true;
        } else {
            header("Location: /");
        }

    }
}