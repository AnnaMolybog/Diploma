<?php

class Comment
{
    public static function editComment($comment, $userId, $newsId, $date, $approved, $parent_comment = 0)
    {
        $db = DB::getConnection();
        $insertComment = $db->query("INSERT INTO comments (comment, id_user, date, likes, dislikes, parent_comment, id_news, approved)
                                      VALUES ('$comment', '$userId', '$date', 0, 0, '$parent_comment', $newsId, $approved)");

        if ($insertComment) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCommentsByNews($newsId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT c.id_comment as id_comment,
                            c.comment as comment,
                            c.likes as likes,
                            c.dislikes as dislikes,
                            c.id_user as id_user,
                            c.parent_comment as id_parent,
                            c.approved as approved,
                            u.login as login,
                            u.id_user as id_user
                            FROM comments as c
                            LEFT JOIN users as u ON u.id_user = c.id_user
                            WHERE c.id_news = ' . $newsId . ' AND c.approved = 1 ORDER BY c.likes DESC');
        $commentsByNews = [];

        for ($i = 0; $i < $sql->rowCount(); $i++) {
            $row = $sql->fetch();
            if (empty($commentsByNews[$row['id_parent']])) {
                $commentsByNews[$row['id_parent']] = [];
            }
            $commentsByNews[$row['id_parent']][] = $row;
        }
        /*$i = 0;
        while ($row = $sql->fetch()) {
            $commentsByNews[$i]['id_comment'] = $row['id_comment'];
            $commentsByNews[$i]['comment'] = $row['comment'];
            $commentsByNews[$i]['likes'] = $row['likes'];
            $commentsByNews[$i]['dislikes'] = $row['dislikes'];
            $commentsByNews[$i]['id_user'] = $row['id_user'];
            $commentsByNews[$i]['login'] = $row['login'];
            $i++;
        }*/
        //echo "<pre>";
        //print_r($commentsByNews);
        return $commentsByNews;
    }

    public static function getTotalCommentsByNews($newsId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_comment) as count FROM comments WHERE id_news = ' . $newsId);

        $row = $sql->fetch();

        return $row['count'];
    }

    public static function updateLikes($commentId, $likes)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET likes = '$likes' WHERE id_comment = $commentId");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateDisLikes($commentId, $dislikes)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET dislikes = '$dislikes' WHERE id_comment = $commentId");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCommentByUser($userId, $page = 1)
    {
        $offset = $page * COMMENTS_PER_PAGE - COMMENTS_PER_PAGE;
        $db = DB::getConnection();
        $sql = $db->query("SELECT c.id_comment as id_comment,
                          c.comment as comment,
                          u.id_user as id_user,
                          u.login as login,
                          c.date as date,
                          c.likes as likes,
                          c.dislikes as dislikes,
                          c.parent_comment as parent_comment,
                          c.id_news as id_news,
                          n.title as title
                          FROM comments as c JOIN users as u ON u.id_user = c.id_user
                          LEFT JOIN news as n ON n.id_news = c.id_news
                          WHERE c.id_user = $userId AND c.approved = 1
                         GROUP BY c.id_comment ORDER BY `date` DESC LIMIT $offset," . COMMENTS_PER_PAGE);

        $userComments = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $userComments[$i]['id_comment'] = $row['id_comment'];
            $userComments[$i]['comment'] = $row['comment'];
            $userComments[$i]['date'] = $row['date'];
            $userComments[$i]['likes'] = $row['likes'];
            $userComments[$i]['dislikes'] = $row['dislikes'];
            $userComments[$i]['id_user'] = $row['id_user'];
            $userComments[$i]['login'] = $row['login'];
            $userComments[$i]['id_news'] = $row['id_news'];
            $userComments[$i]['title'] = $row['title'];
            $userComments[$i]['parent_comment'] = $row['parent_comment'];
            $i++;
        }
        return $userComments;
    }

    public static function getTotalCommentsByUser($userId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_comment) as count FROM comments WHERE id_user = ' . $userId . ' AND approved = 1');
        $row = $sql->fetch();
        return $row['count'];
    }

    public static function updateComment($commentId, $comment)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET comment = '$comment' WHERE id_comment = $commentId");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCommentById($commentId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM comments WHERE id_comment = ' . $commentId . ' AND c.approved = 1');
        $commentById = [];
        $i = 0;

        while ($row = $sql->fetch()) {
            $commentById[$i]['id_comment'] = $row['id_comment'];
            $commentById[$i]['comment'] = $row['comment'];
            $commentById[$i]['date'] = $row['date'];
            $commentById[$i]['likes'] = $row['likes'];
            $commentById[$i]['dislikes'] = $row['dislikes'];
            $commentById[$i]['parent_comment'] = $row['parent_comment'];
            $commentById[$i]['id_news'] = $row['id_news'];
        }
        return $commentById;
    }

    public static function getCommentsForApprove()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM comments as c JOIN users as u ON u.id_user = c.id_user
                          WHERE approved = 0');
        $commentsForApprove = [];
        $i = 0;
        while ($row = $sql->fetch()) {
            $commentsForApprove[$i]['id_comment'] = $row['id_comment'];
            $commentsForApprove[$i]['login'] = $row['login'];
            $commentsForApprove[$i]['comment'] = $row['comment'];
            $i++;
        }
        return $commentsForApprove;
    }

    public static function approveComment($commentId, $comment)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET comment = '$comment', approved = 1 WHERE id_comment = $commentId");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteComment($commentId)
    {
        $db = DB::getConnection();
        $sql = $db->query("DELETE FROM comments WHERE id_comment = $commentId");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

}