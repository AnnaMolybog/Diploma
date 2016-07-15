<?php

class Category
{
    public static function getCategories()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT sc.id_sub_category as id_sub_category,
                            sc.id_parent as id_parent,
                            sc.id_category as id_category,
                            c.category as category
                            FROM sub_category as sc JOIN categories as c ON c.id_category = sc.id_category');
        $categoriesList = [];
        for($i = 0; $i < $sql->rowCount(); $i++)
        {
            $row = $sql->fetch();
            if(empty($categoriesList[$row['id_parent']])) {
                $categoriesList[$row['id_parent']] = [];
            }
            $categoriesList[$row['id_parent']][] = $row;
        }

            /*$categoriesList[$i]['id_category'] = $row['id_category'];
            $categoriesList[$i]['category'] = $row['category'];
            $categoriesList[$i]['id_parent'] = $row['id_parent'];
            $categoriesList[$i]['id_sub_category'] = $row['id_sub_category'];
            $i++;*/
//echo "<pre>";
 //       print_r($categoriesList); die();
        return $categoriesList;
    }
}