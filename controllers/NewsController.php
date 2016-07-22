<?php

class NewsController
{
    //Просмотр всех страниц
    public function actionList()
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
        require_once (VIEWS_PATH . DS . 'news' . DS . 'list.php');
    }

    //Просмотр одной страницы
    public function actionView($id, $categoryId = null, $subCategory = null, $page = 1)
    {
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();
        $advertising = Advertising::getAdvertising();
        $mostViewedAdvertising = [$advertising[0], $advertising[1]];
        unset($advertising[0], $advertising[1]);
        shuffle($advertising);

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

        //$currentViews = rand(1,5);
        //echo $currentViews;
        //$updatedViews = $newsItem['views'] + $currentViews;

        //News::updateViews($newsItem['id_news'], $updatedViews);


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

    public function actionPostViews($newsId, $categoryId = null, $subCategory = null)
    {
        $currentViews = rand(1,5);

        $newsItem = News::getNewsById($newsId, $categoryId, $subCategory);
        $updatedViews = $newsItem['views'] + $currentViews;
        News::updateViews($newsItem['id_news'], $updatedViews);
        print_r(json_encode(['current_views' => 'Количество пользователей, которые просматривают страницу: '.$currentViews,
        'updated_views' => $updatedViews]));

        return json_encode(['current_views' => $currentViews, 'updated_views' => $updatedViews]);
    }

    public function actionSearch()
    {
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        $topThree = News::getTopNewsByComments();
        $topFive = News::getTopUsersByComments();
        $advertising = Advertising::getAdvertising();
        $mostViewedAdvertising = [$advertising[0], $advertising[1]];
        unset($advertising[0], $advertising[1]);
        shuffle($advertising);
        require_once(VIEWS_PATH . DS . 'layouts' . DS . 'header.php');

        $dateFrom = null;
        $dateTo = null;
        $category = null;
        $tags = null;

        if (!empty(($_POST))) {
            $dateFrom = $_POST['date_from']; //array
            $dateTo = $_POST['date_to']; //array
            if (isset($_POST['category'])) {
                $category = $_POST['category'];
            }
            $tags = $_POST['tags'];
        }
        if (!empty($dateFrom) && empty($dateTo) && empty($category) && empty($tags)) {
            $searchResult = News::searchByDateFrom($dateFrom);
        } elseif(!empty($dateFrom) && !empty($dateTo) && empty($category) && empty($tags)){
            $searchResult = News::searchByDateFromDateTo($dateFrom, $dateTo);
        } elseif(empty($dateFrom) && !empty($dateTo) && empty($category) && empty($tags)){
            $searchResult = News::searchByDateTo($dateTo);
        } elseif(!empty($dateFrom) && !empty($dateTo) && !empty($category) && empty($tags)){
            $category = implode(', ', $category);
            $searchResult = News::searchByDateFromDateToCategory($dateFrom, $dateTo, $category);
        } elseif(empty($dateFrom) && empty($dateTo) && !empty($category) && empty($tags)){
            $category = implode(', ', $category);
            $searchResult = News::searchByCategory($category);
        } elseif(!empty($dateFrom) && empty($dateTo) && !empty($category) && empty($tags)){
            $category = implode(', ', $category);
            $searchResult = News::searchByDateFromCategory($dateFrom, $category);
        } elseif(empty($dateFrom) && !empty($dateTo) && !empty($category) && empty($tags)){
            $category = implode(', ', $category);
            $searchResult = News::searchByDateToCategory($dateTo, $category);
        } elseif(!empty($dateFrom) && !empty($dateTo) && !empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            $category = implode(', ', $category);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByDateFromDateToCategoryTag($dateFrom, $dateTo, $category, $tagsId);
            } else {
                $searchResult = News::searchByDateFromDateToCategory($dateFrom, $dateTo, $category);
            }

        } elseif(empty($dateFrom) && !empty($dateTo) && !empty($category) && !empty($tags)){
        $tags = explode('#', $tags);
        unset($tags[0]);
        $tagsId = Tag::checkTagsForSearch($tags);
        $category = implode(', ', $category);
        if(!empty($tagsId)) {
            foreach($tagsId as $tag) {
                $tagId[] = $tag['id_tag'];
            }
            $tagsId = implode(', ', $tagId);
            $searchResult = News::searchByDateToCategoryTag($dateTo, $category, $tagsId);
        } else {
            $searchResult = News::searchByDateToCategory($dateFrom, $dateTo, $category);
        }

    } elseif(!empty($dateFrom) && empty($dateTo) && !empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            $category = implode(', ', $category);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByDateFromCategoryTag($dateTo, $category, $tagsId);
            } else {
                $searchResult = News::searchByDateFromCategory($dateFrom, $category);
            }

        } elseif(empty($dateFrom) && empty($dateTo) && !empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            $category = implode(', ', $category);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByCategoryTag($category, $tagsId);
            } else {
                $searchResult = News::searchByCategory($category);
            }

        } elseif(!empty($dateFrom) && empty($dateTo) && empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByDateFromTag($dateFrom, $tagsId);
            } else {
                $searchResult = News::searchByDateFrom($dateFrom);
            }

        } elseif(empty($dateFrom) && !empty($dateTo) && empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByDateToTag($dateTo, $tagsId);
            } else {
                $searchResult = News::searchByDateFrom($dateTo);
            }

        } elseif(!empty($dateFrom) && !empty($dateTo) && empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);
            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByDateFromDateToTag($dateFrom, $dateTo, $tagsId);
            } else {
                $searchResult = News::searchByDateFromDateTo($dateFrom, $dateTo);
            }

        } elseif(empty($dateFrom) && empty($dateTo) && empty($category) && !empty($tags)){
            $tags = explode('#', $tags);
            unset($tags[0]);
            $tagsId = Tag::checkTagsForSearch($tags);

            if(!empty($tagsId)) {
                foreach($tagsId as $tag) {
                    $tagId[] = $tag['id_tag'];
                }
                $tagsId = implode(', ', $tagId);
                $searchResult = News::searchByTag($tagsId);
            } else {
                $searchResult = '';
            }

        } else { $searchResult = ''; }


        require_once(VIEWS_PATH . DS . 'news' . DS . 'list.php');
        return true;
        }
    }
