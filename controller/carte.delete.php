<?php

if(isset($_SESSION['useraeep']) and isset($_POST['id'])){

    extract($_POST);

    $id = htmlentities(trim(addslashes($id)));

    $data = $carte->getCarteById($id)->fetch();
  
    $delete = $carte->deleteCarte($id);
    if($delete > 0){
        $fichier = $_SERVER['DOCUMENT_ROOT'].'/inscription.aeep-pongala.com/uploads/'.$data['photo'];
        if(file_exists($fichier)){
            unlink($fichier);
        }
        echo 'ok';
    }
}