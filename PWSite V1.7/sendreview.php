<?php
session_start();
require('reviewDB.php');

if (isset($_POST["submeter"])){
    if(isset($_POST["score"], $_POST["review"] )){
        
        $score = $_POST["score"];
        $review = $_POST["review"];
        $user_id = $_SESSION["user_id"];
        $jogo_id = $_POST["id_jogos"];

        sendReview($jogo_id,$user_id,$score,$review);
        header('Location: review.php?success');
        exit;
    }
}

header('Location: review.php');
exit;

?>