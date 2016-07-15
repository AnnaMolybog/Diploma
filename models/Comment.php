<?php

class Comment
{
    public static function editComment($comment, $userId, $newsId, $date, $parent_comment = 0)
    {
        $db = DB::getConnection();
        $insertComment = $db->query("INSERT INTO comments (comment, id_user, date, likes, dislikes, parent_comment)
                                      VALUES ('$comment', '$userId', '$date', 0, 0, '$parent_comment')");
        $selectComment = $db->query('SELECT * FROM comments ORDER BY id_comment DESC LIMIT 1');
        $latestComment = $selectComment->fetch();
        $latestComment = $latestComment['id_comment'];
        $insertCommentNews = $db->query("INSERT INTO news_comments (id_news, id_comment) VALUES ('$newsId', '$latestComment')");

        if($insertCommentNews and $insertComment) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCommentsByNews($newsId, $page = 1)
    {
        $offset = $page * COMMENTS_PER_PAGE - COMMENTS_PER_PAGE;
        $db = DB::getConnection();
        $sql = $db->query('SELECT nc.id_news_comments as id_news_comments,
                            nc.id_comment as id_comment,
                            c.comment as comment,
                            c.likes as likes,
                            c.dislikes as dislikes,
                            c.id_user as id_user,
                            c.parent_comment as id_parent,
                            u.login as login
                            FROM news_comments as nc
                            JOIN comments as c ON c.id_comment = nc.id_comment
                            JOIN users as u ON u.id_user = c.id_user
                            WHERE nc.id_news = ' . $newsId . ' ORDER BY c.likes DESC LIMIT ' . $offset . ", " . COMMENTS_PER_PAGE);
        $commentsByNews = [];

        /*for($i = 0; $i < $sql->rowCount(); $i++)
        {
            $row = $sql->fetch();
            if(empty($commentsByNews[$row['id_parent']])) {
                $commentsByNews[$row['id_parent']] = [];
            }
            $commentsByNews[$row['id_parent']][] = $row;
        }*/

        $i = 0;
        while ($row = $sql->fetch()) {
            $commentsByNews[$i]['id_news_comments'] = $row['id_news_comments'];
            $commentsByNews[$i]['id_comment'] = $row['id_comment'];
            $commentsByNews[$i]['comment'] = $row['comment'];
            $commentsByNews[$i]['likes'] = $row['likes'];
            $commentsByNews[$i]['dislikes'] = $row['dislikes'];
            $commentsByNews[$i]['id_user'] = $row['id_user'];
            $commentsByNews[$i]['login'] = $row['login'];
            $i++;
        }

        return $commentsByNews;
    }

    public static function getTotalCommentsByNews($newsId) {
        $db = DB::getConnection();
        $sql = $db->query('SELECT count(id_news_comments) as count FROM news_comments WHERE id_news = ' . $newsId);

        $row = $sql->fetch();

        return $row['count'];
    }

    public static function updateLikes($commentId, $likes) {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET likes = '$likes' WHERE id_comment = $commentId");
        if($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateDisLikes($commentId, $dislikes) {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE comments SET dislikes = '$dislikes' WHERE id_comment = $commentId");
        if($sql) {
            return true;
        } else {
            return false;
        }
    }
}