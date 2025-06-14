<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    $liste = $miss->getAllMiss();

     $nb = 0;
    while ($data = $liste->fetch()) {
        $nb++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_miss'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        <a href="'.$domaine_admin.'/miss-2024/'.$data['slug'].'" class="btn  btn-sm btn-transparence-info" target="_blank">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                </div>';

        $nots = $resultats->getNote($data['id_miss'])->fetch();
        if($nots['solde'] > 0){
            $n_te = $nots['solde'];
        }else{
            $n_te = 0;
        }
        if($nots['solde'] < 5 ){
            $clN = 'notes_b';
        }else{
            $clN = 'notes_g';
        }
        $notes = '<span class="'.$clN.'">'.$n_te.'/10</span>';

        $arr_list['data'][] = array(
            $nb,
            date_time_fr($data['date_miss']),
            html_entity_decode(stripslashes($data['nom'])),
            html_entity_decode(stripslashes($data['phone'])),
            village_name($data['village']),
            $notes,
            $action


        );
    }
}

echo json_encode($arr_list);
