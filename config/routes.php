<?php

return array(
    //'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
    //'postViews' => 'news/postViews',
    //'postViews/category/([0-9]+)/([0-9]+)/news/([0-9]+)' => 'news/postViews/$1/$2/$3',
    //'postViews/category/([0-9]+)/news/([0-9]+)' => 'news/postViews/$1/$2',
    'advertisingViews/([0-9]+)' => 'site/advertising/$1',

    'postViews/([0-9]+)/([0-9]+)' => 'news/postViews/$1/$2',
    'postViews/([0-9]+)/([0-9]+)/([0-9]+)' => 'news/postViews/$1/$2/$3',
    'admin/postAdd' => 'admin/postAdd',
    'admin/postEdit' => 'admin/postEdit',
    'admin/commentUpdate' => 'admin/commentUpdate',
    'admin/commentApprove' => 'admin/commentApprove',
    'admin/categoryAdd' => 'admin/categoryAdd',
    'admin/color' => 'admin/color',
    'admin/name' => 'admin/name',

    'admin/advertisement' => 'admin/advertisement',
    'admin' => 'admin/index',


    'cabinet/([0-9]+)/page-([0-9]+)' => 'user/cabinet/$1/$2',
    'cabinet/([0-9]+)' => 'user/cabinet/$1',

    'comment/([0-9]+)/page-([0-9]+)' => 'user/comment/$1/$2',
    'comment/([0-9]+)' => 'user/comment/$1',
    'comment/edit' => 'comment/edit',

    'logout' => 'user/logout',

    'login' => 'user/login',
    'register' => 'user/register',
    'tag/([0-9]+)/page-([0-9]+)' => 'tag/tag/$1/$2',
    'tag/([0-9]+)' => 'tag/tag/$1',
    'tag/search' => 'tag/search',
    'category/([0-9]+)/([0-9]+)/news/([0-9]+)' => 'news/view/$3/$1/$2',
    'category/([0-9]+)/news/([0-9]+)' => 'news/view/$2/$1',
    'category/([0-9]+)/([0-9]+)/page-([0-9]+)' =>'category/subCategory/$1/$2/$3',
    'category/([0-9]+)/([0-9]+)' =>'category/subCategory/$1/$2',
    'category/([0-9]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9]+)' =>'category/category/$1',
    'dislikes/([0-9]+)/([0-9]+)' => 'comment/dislikes/$1/$2',
    'likes/([0-9]+)/([0-9]+)' => 'comment/likes/$1/$2',

    'news/([0-9]+)/page-([0-9]+)' =>'news/view/$1/$2',
    'news/([0-9]+)' =>'news/view/$1',
    'news/search/page-([0-9]+)' => 'news/search/$1',
    'news/search' => 'news/search',
    '' => 'site/index',
);