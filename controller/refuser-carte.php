<?php

if( isset($_POST['user']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){

    extract($_POST);

    $message = htmlentities(trim(addslashes($message)));
    $user = htmlentities(trim(addslashes($user)));
    $propriete1 = 'statut';
    $propriete2 = 'motif';
    $etat = 2;
    $upd = $carte->updateData2($propriete1,$etat,$propriete2,$message,$user);
    if($upd >0){
        $success['upd'] = 'Opération effectuée avec succès !';
    }else{
        $errors['upd'] = 'Traitement impossible !';
    }
}