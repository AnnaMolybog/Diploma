<?php

class CommentController
{

    public function actionLikes($newsId, $commentId)
    {
        $userInfo = User::checkLogged();

        if($userInfo['role'] == 1) {
            header("Location: /admin");
        }
        $commentById = Comment::getCommentById($commentId);
        //print_r($commentId);
        //print_r($commentsByNews); die();
        $likes = $commentById[0]['likes'] + 1;
        Comment::updateLikes($commentId, $likes);
        header("Location: /news/$newsId");
    }

    public function actionDislikes($newsId, $commentId)
    {
        $userInfo = User::checkLogged();

        if($userInfo['role'] == 1) {
            header("Location: /admin");
        }
        $commentById = Comment::getCommentById($commentId);
        // print_r($commentById); die();
        $dislikes = $commentById[0]['dislikes'] + 1;
        Comment::updateDislikes($commentId, $dislikes);
        header("Location: /news/$newsId");
    }

    public function actionEdit() {
        if(!empty($_POST)) {
            //print_r($_POST); die;
            $commentId = $_POST['id_comment'];
            $comment = $_POST['comment'];
            $userId = $_POST['id_user'];
            Comment::updateComment($commentId, $comment);
            header("Location: /cabinet/$userId");
        } else {
            header("Location: /");
        }
    }
}