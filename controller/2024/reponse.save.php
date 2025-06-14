<?php

if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']) {
    extract($_POST);

    $quest_id = htmlentities(trim(addslashes(strip_tags($quest_id))));
    $reponse_ = htmlentities(trim(addslashes(strip_tags($reponse_))));
    $point_ = htmlentities(trim(addslashes(strip_tags($point_))));


    $reponse_add = $reponses->addReponse($quest_id,$reponse_,$point_);

    if($reponse_add > 0){
        echo 'ok';
    }

}
