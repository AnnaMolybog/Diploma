<?php

class CategoryController
{
    public function actionCategory($categoryId, $page = 1)
    {
        //Список категорий для верхнего меню
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        //Список новостей данной категории
        $categoryNews = News::getNewsListByCategory($categoryId, $page);
        //Pagination
        $total = News::getTotalNewsInCategory($categoryId);

        $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');

        require_once (VIEWS_PATH . DS . 'category' . DS . 'category.php');
        return true;

    }

    public function actionSubCategory($categoryId, $subCategory, $page = 1)
    {
        //Список категорий для верхнего меню
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        //Список новостей данной категории
        $categoryNews = News::getNewsListBySubCategory($categoryId, $subCategory, $page);
        $total = News::getTotalNewsInSubCategory($categoryId, $subCategory);

        $pagination = new Pagination($total, $page, NEWS_PER_PAGE, 'page-');

        require_once (VIEWS_PATH . DS . 'category' . DS . 'category.php');
        return true;
    }
}

