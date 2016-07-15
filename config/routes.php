<?php

return array(
    //'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
    'logout' => 'user/logout',
    'admin' => 'admin/index',
    'login' => 'user/login',
    'register' => 'user/register',
    'tag/([0-9]+)/page-([0-9]+)' => 'tag/tag/$1/$2',
    'tag/([0-9]+)' => 'tag/tag/$1',
    'tag/search' => 'tag/search',
    'category/([0-9]+)/([0-9]+)/page-([0-9]+)' =>'category/subCategory/$1/$2/$3',
    'category/([0-9]+)/([0-9]+)' =>'category/subCategory/$1/$2',
    'category/([0-9]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9]+)' =>'category/category/$1',
    'dislikes/([0-9]+)/([0-9]+)' => 'news/dislikes/$1/$2',
    'likes/([0-9]+)/([0-9]+)' => 'news/likes/$1/$2',

    'news/([0-9]+)/page-([0-9]+)' =>'news/view/$1/$2',
    'news/([0-9]+)' =>'news/view/$1',

    '' => 'site/index',
);