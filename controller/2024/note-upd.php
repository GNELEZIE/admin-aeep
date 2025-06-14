<?php
/**
note-upd
 */
//$liste = $resultats->getAllResult();
//
//
//$propriete = 'not_es';
//$notes = 0;
//while ($datan = $liste->fetch()) {
//
//    $upsd = $resultats->getMissByQId($datan['q_id']);
//    if($upsd->rowCount() > 1){
//        $udp = $resultats->updateData2($propriete,$notes,$datan['q_id']);
//    }else{
//    }
//
//}



$liste = $miss->getAllMiss();

$propriete = 'note';
while ($datan = $liste->fetch()) {
    $notees = $resultats->getNote($datan['id_miss'])->fetch();
    $notes = $notees['solde'];
    $udp = $miss->updateData($propriete,$notes,$datan['id_miss']);
}