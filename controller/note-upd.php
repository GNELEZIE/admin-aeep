<?php
/**
note-upd
 */
$liste = $miss->getAllMiss();

$propriete = 'note';
while ($datan = $liste->fetch()) {
    $notees = $resultats->getNote($datan['id_miss'])->fetch();
    $notes = $notees['solde'];
    $udp = $miss->updateData($propriete,$notes,$datan['id_miss']);
}