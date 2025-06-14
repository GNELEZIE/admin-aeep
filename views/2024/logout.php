<?php
if(isset($_COOKIE['aeepcookie'])) {
    setcookie('aeepcookie',null,time()-60*60*24*30,'/',$cookies_domaine,true,true);
}
unset($_SESSION['useraeep']);
header('location:'.$domaine_admin.'/login');
exit();