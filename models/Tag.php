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
            return $row['id_tag'];
        } else {
            return false;
        }


    }
}