<?php

class Tag
{
    public static function getTags()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM tags');
        $tagsList = [];
        $i = 0;
        while($row = $sql->fetch()) {
            $tagsList[$i]['id_tag'] = $row['id_tag'];
            $tagsList[$i]['tag'] = $row['tag'];
            $i++;
        }
        return $tagsList;
    }

    public static function getIdByTagName($tagName)
    {
        $db = DB::getConnection();
            $sql = $db->query("SELECT * FROM tags WHERE tag = '$tagName'");

        $row = $sql->fetch();
        if($row) {
            return $row;
        } else {
            return false;
        }
    }

    public static function addTag($tag)
    {
        if($tag!='') {
            $db = DB::getConnection();
            $sql = $db->query(sprintf("INSERT INTO tags (tag) VALUES ('%s')", $tag));
            if($sql)
            {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public static function checkTag($tags)
    {
        $allTag = self::getTags();
        $tagId = [];
        foreach ($tags as $value) {
            $flag = 0;
            foreach ($allTag as $tag) {
                if($value == $tag['tag']) {
                    $flag += 1;
                    break;
                }
                if($flag == 1) {
                    break;
                }
            }
            if($flag == 0) {
                self::addTag($value);
            }
            $tagId[] = self::getIdByTagName($value);
        }

        return $tagId;
    }

    public static function checkTagsForSearch($tags)
    {
        $allTag = self::getTags();
        $tagId = [];
        foreach ($tags as $value) {
            $flag = 0;
            foreach ($allTag as $tag) {
                if($value == $tag['tag']) {
                    $flag += 1;
                    $tagId[] = self::getIdByTagName($value);
                    break;
                }
                if($flag == 1) {
                    break;
                }
            }
            if($flag == 0) {
                unset($value);
            }

        }

        return $tagId;
    }

    public static function addTagNew($newsId, $tagId)
    {
        $db = DB::getConnection();
        $sql = $db->query(sprintf("INSERT INTO tags_news (id_tag, id_news) VALUES ('%d', '%d')", $tagId, $newsId));

        if($sql)
        {
            return true;
        }
        else {
            return false;
        }

    }

    public static function deleteTagPost($tagNewId)
    {
        $db = DB::getConnection();
        $sql = $db->query(sprintf("DELETE FROM tags_news WHERE id_tags_news = '%d'", $tagNewId));

        if($sql) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentTagNew($newsId, $tagId)
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM tags_news WHERE id_news=' . $newsId . ' AND id_tag=' . $tagId);
        $row = $sql->fetch();
        return $row;
    }
}