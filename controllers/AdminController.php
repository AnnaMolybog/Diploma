<?php

class AdminController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
       // echo "<pre>";
       // print_r($categories); die;
        $imageName = News::getImageName();
        $tags = Tag::getTags();


        $userId = User::checkLogged();
        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'admin_header.php');
        require_once (VIEWS_PATH . DS . 'admin' . DS . 'index.php');

        return true;

    }

    public function actionPostAdd()
    {
        $imageName = News::getImageName();
        if(!empty($_POST)) {
            //echo "<pre>";
            //print_r($_POST);
            //print_r($_FILES);
            $title = $_POST['title'];
            $content = $_POST['content'];
            $date = $_POST['date'];
            $categoryId = $_POST['id_category'];
            $tags = explode('#', $_POST['tag']);

            unset($tags[0]);

            $check = $_POST['check'];

            $uploadDir = ROOT . '/www/images/' . basename($_FILES['image']['name']);
            echo $uploadDir; die;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir);
            News::addNews($title, $content, $date, $categoryId, $check);
            $newsId = News::getLastNew();
            $tagsId = Tag::checkTag($tags);
            foreach ($tagsId as $tagId) {
                Tag::addTagNew($newsId, $tagId);
            }
            $tagsByNew = News::getTagsByNews($newsId);
            foreach($tagsByNew as $item) {
                $flag = 0;
                foreach ($tagsId as $tag) {
                    if ($item['id_tag'] == $tag[0]['id_tag']) {
                        $flag += 1;
                        break;
                    }
                    if ($flag == 1) {
                        break;
                    }
                }
                if ($flag == 0) {
                    Tag::deleteTagPost($item['id_tags_news']);
                }
            }
            header("Location: /admin");
            return true;
        }
    }

    public function actionCommentUpdate()
    {
        if(!empty($_POST))
        {
            $comment = $_POST['comment'];
            $commentId = $_POST['id_comment'];
            $categoryId = $_POST['id_category'];
            $newsId = $_POST['id_news'];
            Comment::updateComment($commentId, $comment);
            header("Location: /category/$categoryId/news/$newsId");
        }
    }

    public function actionPostEdit()
    {
        if(!empty($_POST)){
            echo "<pre>";

            $newsId = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $date = $_POST['date'];
            $categoryId = $_POST['id_category'];
            $views = $_POST['views'];
            $likes = $_POST['likes'];
            $categoryParent = $_POST['category_parent'];
            $check = $_POST['check'];
            $tags = explode('#', $_POST['tag']);

            unset($tags[0]);
            News::updateNews($newsId, $title, $content, $date, $views, $likes, $categoryId, $check);

            $tagsId = Tag::checkTag($tags);
            //print_r($tagsId);
            foreach ($tagsId as $tagId) {
                $getCurrentTagNew = Tag::getCurrentTagNew($newsId, $tagId['id_tag']);
                if(empty($getCurrentTagNew)) {
                    Tag::addTagNew($newsId, $tagId['id_tag']);
                }


            }

            $tagsByNew = News::getTagsByNews($newsId);
            //print_r($tagsByNew); die();
            foreach($tagsByNew as $item) {

                $flag = 0;
                foreach ($tagsId as $tag) {

                    if ($item['id_tag'] == $tag['id_tag']) {
                        $flag += 1;
                        break;
                    }
                    if ($flag == 1) {
                        break;
                    }
                }
                if ($flag == 0) {
                    Tag::deleteTagPost($item['id_tags_news']);
                }
            }

            if($check == 'on' ) {
                header("Location: /category/7/$categoryId/news/$newsId");
            } else {
                header("Location: /category/$categoryId/news/$newsId");
            }

            return true;
        }
    }

    public function actionCommentApprove()
    {
        $categories = Category::getCategories();
        // echo "<pre>";
        // print_r($categories); die;
        $imageName = News::getImageName();
        $tags = Tag::getTags();
        $userId = User::checkLogged();

        $commentsForApprove = Comment::getCommentsForApprove();

        if(isset($_POST['approve'])) {
            $commentId = $_POST['id_comment'];
            $comment = $_POST['comment'];
            Comment::approveComment($commentId, $comment);
        }

        if(isset($_POST['delete'])) {
            $commentId = $_POST['id_comment'];
            Comment::deleteComment($commentId);
        }

        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'admin_header.php');
        require_once (VIEWS_PATH . DS . 'admin' . DS . 'comment.php');

        return true;
    }

    public function actionCategoryAdd()
    {
        $categories = Category::getCategories();
        unset($categories[7]);
        unset($categories[0]);
        // echo "<pre>";
        // print_r($categories); die;

        if(isset($_POST['add'])) {
            $category = $_POST['category'];
            Category::addCategory($category);
            header("Location: /admin/categoryAdd");
        }

        if(isset($_POST['update'])) {
            $categoryId = $_POST['id_category'];
            $category = $_POST['category'];
            Category::updateCategory($categoryId, $category);
            header("Location: /admin/categoryAdd");
        }

        if(isset($_POST['delete'])) {
            $categoryId = $_POST['id_category'];
            Category::deleteCategory($categoryId);
            header("Location: /admin/categoryAdd");
        }



        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'admin_header.php');
        require_once (VIEWS_PATH . DS . 'admin' . DS . 'category.php');

        return true;
    }

    public function actionColor()
    {
        $_SESSION['color'] = $_POST['color'];
        header("Location:" . $_SERVER['HTTP_REFERER']);

        return true;
    }

    public function actionName()
    {
        $_SESSION['site_name'] = $_POST['site_name'];
        header("Location:" . $_SERVER['HTTP_REFERER']);

        return true;
    }

    public function actionadvertisement()
    {
        $categories = Category::getCategories();
        // echo "<pre>";
        // print_r($categories); die;
        $imageName = News::getImageName();
        $tags = Tag::getTags();


        $userId = User::checkLogged();
        require_once (VIEWS_PATH . DS . 'layouts' . DS . 'admin_header.php');
        require_once (VIEWS_PATH . DS . 'admin' . DS . 'advertisement.php');

        return true;
    }

}