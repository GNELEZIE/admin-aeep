<?php
ini_set("session.cookie_httponly", True);
session_start();

// include function
include_once "function/domaine.php";
include_once "function/mailing.php";
include_once "function/function.php";
//https://detectdevice.com/#php-class
include_once "function/detectdevice/Mobile_Detect.php";
include_once "function/detectdevice/detect.php";

$cdn = 'cdn';
$class = 'class';
$controller = 'controller';
$function = 'function';
$mail = 'mail';
$layout = 'layout';

//Include Connexion controle/
include_once 'model/Connexion.class.php';
include_once 'model/Reunion.class.php';
include_once 'controller/payer-sortie.php';

// appelle des class
include_once 'model/Admin.class.php';
include_once 'model/Carte.class.php';





 if(isset($_COOKIE['aeepcookie']) AND !isset($_SESSION['useraeep'])){
    $email = my_decrypt($_COOKIE['useraeep']);
    $result = $admin->getAdminByEmail($email);
    if($data = $result->fetch()){
        if($data['bloquer'] == 1){
            $_SESSION['useraeep'] = $data;
        }else{
            setcookie('aeepcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
        }
    }else{
        setcookie('aeepcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
    }
 }

 if(isset($_SESSION['useraeep'])){
     $result = $admin->getAdminById($_SESSION['useraeep']['id_admin']);
     if($data = $result->fetch()){
         if($data['bloquer'] != 1){
             if(isset($_COOKIE['aeepcookie'])) {
                 setcookie('aeepcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
             }
             unset($_SESSION['useraeep']);
         }
     }else{
         unset($_SESSION['useraeep']);
     }
 }
