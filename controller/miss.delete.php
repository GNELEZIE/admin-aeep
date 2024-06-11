<?php

if(isset($_SESSION['useraeep']) and isset($_POST['id'])){


    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $delete = $miss->deleteMiss($id);
    $dels = $resultats->deleteResult($id);

    if($delete > 0){
        echo 'ok';
    }
}