<?php
if(!isset($_SESSION['useraeep'])){
    header('location:connexion');
    exit();
}

if(isset($doc[1]) and !isset($doc[2])){
    $get_Miss = $miss->getMissBySlug($doc[1]);
    if ($missData = $get_Miss->fetch()) {
        $no_m = html_entity_decode(stripslashes($missData['nom']));
    } else {
        header('location:' . $domaine . '/error');
        exit();
    }
}else {
    header('location:' . $domaine . '/error');
    exit();
}




include_once 'model.miss.result.php';

?>
