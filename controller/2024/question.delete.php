<?php

if(isset($_SESSION['useraeep']) and isset($_POST['id'])){


    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $questions->deleteQuestion($id);
    $del = $reponses->deleteRepByQid($id);

    if($delete > 0){
        echo 'ok';
    }
}