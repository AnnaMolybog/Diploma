<?php

class CommentsTree
{
    public function tree($categoryId, $newsId, $commentsByNews, $parentId = 0)
    {
        if(empty($commentsByNews[$parentId])) {
            return;
        }
        echo "<div class=\"panel panel-default\">";


        for($i = 0; $i < count($commentsByNews[$parentId]); $i++){
            if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                echo "<form method=\"post\" action=\"/admin/commentUpdate\" style=\"padding-top: -20px; padding-bottom: -20px\">";
                echo "<div class=\"panel - body\" style='margin-left: 20px; margin-right: 10px'>";
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_category\" value=\"$categoryId\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_news\" value=\"$newsId\">";
                echo "</div>";
                $parent_comment = $commentsByNews[$parentId][$i]['id_comment'];
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_comment\" value=\"$parent_comment\">";
                echo "</div>";
                $userId = $commentsByNews[$parentId][$i]['id_user'];
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_user\" value=\"$userId\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                $login = $commentsByNews[$parentId][$i]['login'];
                echo "<input disabled class=\"form-control\" value=\"$login\" name='login' >"  ;
                echo "</div>";
                echo "<div class=\"form-group\">";
                $comment = $commentsByNews[$parentId][$i]['comment'];
                echo "<input class=\"form-control\" value=\"$comment\" name='comment' >"  ;
                echo "</div>";
                echo "<a href=\"/likes/" . $newsId ."/" . $commentsByNews[$parentId][$i]['id_comment'] . "\"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\" style=\"padding-right: 10px;\"></span></a>" . $commentsByNews[$parentId][$i]['likes'];
                echo "<a href=\"/dislikes/" . $newsId . "/" . $commentsByNews[$parentId][$i]['id_comment'] . "\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\" style=\"padding-right: 10px;\"></span></a>" . $commentsByNews[$parentId][$i]['dislikes'];
                echo "<div class=\"form-group\">";
                echo "<input type=\"submit\" class=\"btn btn-default\" name=\"response\" value=\"Редактировать\">";
                echo "</div>";
                echo "</form>";
            } else {
                echo "<div class=\"panel - body\" style='margin-left: 20px; margin-right: 10px'>";
                $userId = $commentsByNews[$parentId][$i]['id_user'];
                echo "<a href=\"/comment/$userId\"><h4>" . $commentsByNews[$parentId][$i]['login'] . "</h4></a>";
                echo "<p>" . $commentsByNews[$parentId][$i]['comment'] . "</p>";
                echo "<a href=\"/likes/" . $newsId . "/" . $commentsByNews[$parentId][$i]['id_comment'] . "\"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\" style=\"padding-right: 10px;\"></span></a>" . $commentsByNews[$parentId][$i]['likes'];
                echo "<a href=\"/dislikes/" . $newsId . "/" . $commentsByNews[$parentId][$i]['id_comment'] . "\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\" style=\"padding-right: 10px;\"></span></a>" . $commentsByNews[$parentId][$i]['dislikes'];
            }
                if(!User::isGuest()) {
                echo "<hr>";
                echo "<h4>Ответить</h4>";
                echo "<form method=\"post\" style=\"padding-top: -20px; padding-bottom: -20px\">";
                echo "<div class=\"form-group\">";
                $parent_comment = $commentsByNews[$parentId][$i]['id_comment'];
                echo "<input type=\"hidden\" class=\"form-control\" name=\"parent_comment\" value=\"$parent_comment\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_news\" value=\"$newsId\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<input type=\"hidden\" class=\"form-control\" name=\"id_category\" value=\"$categoryId\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<label>Логин</label>";
                    $userLogin = User::getUserLoginById($_SESSION['user']);
                echo "<input disabled type=\"email\" class=\"form-control\" name=\"user_email\" placeholder=\"Email\" value=\"$userLogin\">";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<label>Комментарий</label>";
                echo "<textarea rows=\"3\" class=\"form-control\" name=\"comment\" placeholder=\"Оставьте свой комментарий\"></textarea>";
                echo "</div>";
                echo "<input type=\"submit\" class=\"btn btn-default\" name=\"response\" value=\"Отправить\">";
                echo "</form>";
                echo "<br>";
            }

            self::tree($categoryId, $newsId, $commentsByNews, $commentsByNews[$parentId][$i]['id_comment']);
            echo "</div>";

        }

        echo "</div>";
    }
}