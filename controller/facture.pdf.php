<?php
if(!isset($_SESSION['useraeep'])){
    header('location:connexion');
    exit();
}

$liste = $carte->getAllCarte();
if ($dat = $liste->fetch()) {

} else {
    header('location:' . $domaine . '/error');
    exit();
}


include_once 'model0.facture.php';

?>
