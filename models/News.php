<?php

class News
{
    //возвращает новость по id
    public static function getNewsById($id, $categoryId = null, $subCategory = null)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            $sql = "SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category,
                            sc.id_parent as id_parent
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c ON c.id_category = sc.id_category
                            WHERE n.id_news = $id";
            if(isset($categoryId)) {
                $sql .= " and sc.id_category = $categoryId";
            }
            if(isset($subCategory)) {
                $sql .= " and sc.id_parent = $subCategory";
            }
            //echo $sql;
            $sql = $db->query($sql);
            //print_r($sql); die();
            $newsItem = $sql->fetch();
            return $newsItem;
        }
    }

    //возвращает все новости
    public static function getNewsListByCategory($categoryId, $page = 1)
    {
        $offset = $page * NEWS_PER_PAGE - NEWS_PER_PAGE;
        $db = DB::getConnection();
        $sql = 'SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category,
                            sc.id_parent as id_parent
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c
                            ON c.id_category = sc.id_category
                            WHERE sc.id_category = ' . $categoryId .
                            ' GROUP BY n.id_news ORDER BY `date` DESC
                             LIMIT ' . $offset . ", " . NEWS_PER_PAGE;
       // echo $sql;
        $sql = $db->query($sql);
        $newsList = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $newsList[$i]['id_news'] = $row['id_news'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['content'] = $row['content'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['views'] = $row['views'];
            $newsList[$i]['likes'] = $row['likes'];
            $newsList[$i]['id_sub_category'] = $row['id_sub_category'];
            $newsList[$i]['id_category'] = $row['id_category'];
            $newsList[$i]['id_parent'] = $row['id_parent'];
            $i++;
        }


        return $newsList;
    }

    public static function getMostReadNews($page = 1) {
        $offset = $page * NEWS_PER_PAGE - NEWS_PER_PAGE;
        $db = DB::getConnection();
        $sql = $db->query('SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c
                            ON c.id_category = sc.id_category
                          ORDER BY n.views DESC LIMIT ' . $offset . ", " . NEWS_PER_PAGE);
        $mostReadNews = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $mostReadNews[$i]['id_news'] = $row['id_news'];
            $mostReadNews[$i]['title'] = $row['title'];
            $mostReadNews[$i]['content'] = $row['content'];
            $mostReadNews[$i]['date'] = $row['date'];
            $mostReadNews[$i]['views'] = $row['views'];
            $mostReadNews[$i]['likes'] = $row['likes'];
            $mostReadNews[$i]['id_sub_category'] = $row['id_sub_category'];
            $mostReadNews[$i]['id_category'] = $row['id_category'];
            $i++;
        }
        return $mostReadNews;

    }


    public static function getLatestNews($page = 1)
    {
        $offset = $page * NEWS_PER_PAGE - NEWS_PER_PAGE;
        $unixDate = mktime(0, 0, 0, date("m"), date("d") - LATEST_NEWS_DAYS, date("Y"));
        $currentDate = date("Y-m-d H:i:s", $unixDate);
        $db = DB::getConnection();
        $sql = $db->query('SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c
                            ON c.id_category = sc.id_category
                          ORDER BY n.date DESC LIMIT ' . $offset . ", " . NEWS_PER_PAGE);
        $latestNews = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $latestNews[$i]['id_news'] = $row['id_news'];
            $latestNews[$i]['title'] = $row['title'];
            $latestNews[$i]['content'] = $row['content'];
            $latestNews[$i]['date'] = $row['date'];
            $latestNews[$i]['views'] = $row['views'];
            $latestNews[$i]['likes'] = $row['likes'];
            $latestNews[$i]['id_sub_category'] = $row['id_sub_category'];
            $latestNews[$i]['id_category'] = $row['id_category'];
            $i++;
        }
        return $latestNews;
    }

    public static function getRecommendedNews()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c
                            ON c.id_category = sc.id_category
                            ORDER BY n.likes DESC
                            LIMIT ' . RECOMMENDED_NEWS);
        $recommendedNews = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $recommendedNews[$i]['id_news'] = $row['id_news'];
            $recommendedNews[$i]['title'] = $row['title'];
            $recommendedNews[$i]['content'] = $row['content'];
            $recommendedNews[$i]['date'] = $row['date'];
            $recommendedNews[$i]['views'] = $row['views'];
            $recommendedNews[$i]['likes'] = $row['likes'];
            $recommendedNews[$i]['id_sub_category'] = $row['id_sub_category'];
            $recommendedNews[$i]['id_category'] = $row['id_category'];
            $i++;
        }
        return $recommendedNews;
    }

    public static function getTotalNewsInCategory($categoryId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_news) AS count FROM news as n
                          JOIN sub_category as sc
                          ON sc.id_sub_category = n.id_sub_category
                          WHERE sc.id_category = ' . $categoryId);
        $row = $sql->fetch();

        return $row['count'];
    }

    public static function getTotalNewsInSubCategory($categoryId, $subCategoryId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_news) AS count FROM news as n
                          JOIN sub_category as sc
                          ON sc.id_sub_category = n.id_sub_category
                          WHERE sc.id_parent = ' . $subCategoryId . ' AND sc.id_category = ' . $categoryId);
        $row = $sql->fetch();

        return $row['count'];
    }

    public static function updateViews($id, $views)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE news SET views = '$views' WHERE id_news = $id");
        if($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function getTagsByNews($id)
    {

        $db = DB::getConnection();
        $sql = $db->query('SELECT tn.id_tags_news as id_tags_news, tn.id_news as id_news, tn.id_tag as id_tag, t.tag as tag
                          FROM tags_news as tn
                          JOIN tags as t
                          ON t.id_tag = tn.id_tag
                          WHERE tn.id_news = ' . $id);
        $newsTags = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $newsTags[$i]['id_tags_news'] = $row['id_tags_news'];
            $newsTags[$i]['id_news'] = $row['id_news'];
            $newsTags[$i]['id_tag'] = $row['id_tag'];
            $newsTags[$i]['tag'] = $row['tag'];
            $i++;
        }

        return $newsTags;

    }

    public static function getNewsByTag($tagId, $page = 1)
    {
        $offset = $page * NEWS_PER_PAGE - NEWS_PER_PAGE;
        $db = DB::getConnection();
        $sql = $db->query('SELECT n.id_news as id_news, n.title as title, n.content as content, n.date as date,
                            n.views as views, n.likes as likes, n.id_sub_category as id_sub_category, t.tag as tag,
                            tn.id_tag as id_tag
                            FROM news as n
                            JOIN tags_news as tn
                            ON tn.id_news = n.id_news
                            JOIN tags as t
                            ON t.id_tag = tn.id_tag
                            WHERE tn.id_tag = ' . $tagId .
                            ' GROUP BY n.id_news ORDER BY n.date DESC
                            LIMIT ' . $offset . ", " . NEWS_PER_PAGE);
        $newsByTag = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $newsByTag[$i]['id_news'] = $row['id_news'];
            $newsByTag[$i]['title'] = $row['title'];
            $newsByTag[$i]['content'] = $row['content'];
            $newsByTag[$i]['date'] = $row['date'];
            $newsByTag[$i]['views'] = $row['views'];
            $newsByTag[$i]['likes'] = $row['likes'];
            $newsByTag[$i]['id_sub_category'] = $row['id_sub_category'];
            $newsByTag[$i]['tag'] = $row['tag'];
            $newsByTag[$i]['id_tag'] = $row['id_tag'];
            $i++;
        }
        return $newsByTag;
    }

    public static function getTotalNewsByTag($tagId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_news) AS count FROM tags_news
                          WHERE id_tag = ' . $tagId);
        $row = $sql->fetch();

        return $row['count'];
    }

    public static function getNewsListBySubCategory($categoryId, $subCategoryId, $page = 1)
    {

        $offset = $page * NEWS_PER_PAGE - NEWS_PER_PAGE;
        $db = DB::getConnection();
        $sql = $db->query('SELECT n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category,
                            sc.id_parent as id_parent
                            FROM news as n
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            JOIN categories as c
                            ON c.id_category = sc.id_category
                            WHERE sc.id_parent = ' . $subCategoryId . ' AND c.id_category = ' . $categoryId .
            ' GROUP BY n.id_news ORDER BY `date` DESC
              LIMIT ' . $offset . ", " . NEWS_PER_PAGE);
        $newsList = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $newsList[$i]['id_news'] = $row['id_news'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['content'] = $row['content'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['views'] = $row['views'];
            $newsList[$i]['likes'] = $row['likes'];
            $newsList[$i]['id_sub_category'] = $row['id_sub_category'];
            $newsList[$i]['id_category'] = $row['id_category'];
            $newsList[$i]['id_parent'] = $row['id_parent'];
            $i++;
        }
        return $newsList;
    }

    public static function getTopNewsByComments()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(c.id_comment) as count, n.id_news as id_news,
                            n.title as title,
                            n.content as content,
                            n.date as date,
                            n.views as views,
                            n.likes as likes,
                            n.id_sub_category as id_sub_category,
                            sc.id_category as id_category
                            FROM comments as c
                            JOIN news as n ON n.id_news = c.id_news
                            JOIN sub_category as sc
                            ON sc.id_sub_category = n.id_sub_category
                            GROUP BY c.id_news
                            ORDER BY count DESC LIMIT 3');
        $topThree = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $topThree[$i]['id_news'] = $row['id_news'];
            $topThree[$i]['title'] = $row['title'];
            $topThree[$i]['content'] = $row['content'];
            $topThree[$i]['date'] = $row['date'];
            $topThree[$i]['views'] = $row['views'];
            $topThree[$i]['likes'] = $row['likes'];
            $topThree[$i]['id_sub_category'] = $row['id_sub_category'];
            $topThree[$i]['id_category'] = $row['id_category'];
            $topThree[$i]['count'] = $row['count'];
            $i++;
        }
        return $topThree;

    }
    public static function getTopUsersByComments()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(c.id_comment) as count, u.login as login, u.id_user as id_user
                            FROM comments as c JOIN users as u ON u.id_user = c.id_user
                            GROUP BY c.id_user
                            ORDER BY count DESC LIMIT 5');
        $topFive = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $topFive[$i]['id_user'] = $row['id_user'];
            $topFive[$i]['login'] = $row['login'];
            $topFive[$i]['count'] = $row['count'];
            $i++;
        }
        return $topFive;
    }

    public static function getLastNew()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT id_news FROM news ORDER BY id_news DESC LIMIT 1');
        $row = $sql->fetch();
        return $row['id_news'];
    }

    public static function addNews($title, $content, $date, $categoryId, $check)
    {
        if(empty($title || $content || $date || $categoryId)) {
            return false;
        }
        $db = DB::getConnection();

        if($check == 'on') {
            $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . 7 . ' AND id_parent = ' . $categoryId);
            if($selectSubCategoryId) {
                //var_dump($selectSubCategoryId);
                $selectSubCategoryId = ($selectSubCategoryId->fetch());
                $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
            } else {
                $insertSubCategory = $db->query("INSERT INTO sub_category (id_parent, id_category) VALUES ($categoryId, 7)");
                $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . $categoryId . ' AND id_parent = ' . 7);
                $selectSubCategoryId = ($selectSubCategoryId->fetch());
                $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
            }
        } else {
            $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . $categoryId);
            $selectSubCategoryId = ($selectSubCategoryId->fetch());
            $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
        }

       // echo $subCategoryId;
       // die();

        $insertNew = $db->query(sprintf("INSERT INTO news (title, content, date, views, likes, id_sub_category)
                                        VALUES ('%s', '%s', '%s', '%d', '%d', '%d')", $title, $content, $date, 0, 0, $subCategoryId));

        if($insertNew) {
            return true;
        } else {
            return false;
        }
    }

    public static function getImageName()
    {
        $db = DB::getConnection();
        $sql = $db->query("SHOW TABLE STATUS LIKE 'news'");
        $row = $sql->fetch();
        return $row['Auto_increment'];

    }

    public static function updateNews($newsId, $title, $content, $date, $views, $likes, $categoryId, $check)
    {
        if(empty($title || $content || $date || $categoryId)) {
            return false;
        }
        $db = DB::getConnection();

        if($check == 'on') {
            $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . 7 . ' AND id_parent = ' . $categoryId);
            if($selectSubCategoryId) {
                //var_dump($selectSubCategoryId);
                $selectSubCategoryId = ($selectSubCategoryId->fetch());
                $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
            } else {
                $insertSubCategory = $db->query("INSERT INTO sub_category (id_parent, id_category) VALUES ($categoryId, 7)");
                $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . $categoryId . ' AND id_parent = ' . 7);
                $selectSubCategoryId = ($selectSubCategoryId->fetch());
                $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
            }
        } else {
            $selectSubCategoryId = $db->query('SELECT id_sub_category FROM sub_category WHERE id_category = ' . $categoryId);
            $selectSubCategoryId = ($selectSubCategoryId->fetch());
            $subCategoryId = intval($selectSubCategoryId['id_sub_category']);
        }

        //echo $subCategoryId;
        // die();

        $updateNew = $db->query(sprintf("UPDATE news SET title='%s', content='%s', date='%s', views='%d', likes='%d', id_sub_category='%d' WHERE id_news = '%d'", $title, $content, $date, $views, $likes, $subCategoryId, $newsId));

        if($updateNew) {
            return true;
        } else {
            return false;
        }
    }
}