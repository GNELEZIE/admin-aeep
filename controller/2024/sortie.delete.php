<?php

if(isset($_SESSION['useraeep']) and isset($_POST['id'])){


    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $reunion->deleteSortie($id);

    if($delete > 0){

        echo 'ok';
    }
}