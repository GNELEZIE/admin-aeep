<?php

if(isset($_SESSION['useraeep']) and isset($_POST['id']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){
    // include function

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));
    $etat = 1;
    $upd = $carte->updateValider($etat,$id);
    if($upd >0){
        echo 'ok';
    }
}