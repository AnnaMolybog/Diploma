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
        /*$i = 0;
        while ($row = $sql->fetch()) {
            $categoriesList[$i]['id_category'] = $row['id_category'];
            $categoriesList[$i]['category'] = $row['category'];
            $categoriesList[$i]['id_parent'] = $row['id_parent'];
            $categoriesList[$i]['id_sub_category'] = $row['id_sub_category'];
            $i++;
        }*/
        for($i = 0; $i < $sql->rowCount(); $i++)
        {
            $row = $sql->fetch();
            if(empty($categoriesList[$row['id_parent']])) {
                $categoriesList[$row['id_parent']] = [];
            }
                $categoriesList[$row['id_category']][] = $row;
            }

            /**/
       // echo "<pre>";
        //print_r($categoriesList); die();
        return $categoriesList;
    }

    public static function addCategory($category)
    {
        $db = DB::getConnection();
        $sql = $db->query("INSERT INTO categories (category, id_parent) VALUES ('$category', 0)");
        $categoryId = $db->query("SELECT id_category FROM categories ORDER BY id_category DESC LIMIT 1");
        $categoryId = $categoryId->fetch();
        $categoryId = $categoryId['id_category'];
        $insertSubCategory = $db->query("INSERT INTO sub_category (id_parent, id_category) VALUES (0, $categoryId)");

        if($sql && $insertSubCategory){
            return true;
        } else {
            return false;
        }
    }

    public static function updateCategory($categoryId, $category)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE categories SET category = '$category ' WHERE id_category = $categoryId");
        if($sql){
            return true;
        } else {
            return false;
        }
    }

    public static function deleteCategory($categoryId)
    {
        $db = DB::getConnection();
        $sql = $db->query("DELETE FROM categories WHERE id_category = $categoryId");
        if($sql){
            return true;
        } else {
            return false;
        }
    }
}
