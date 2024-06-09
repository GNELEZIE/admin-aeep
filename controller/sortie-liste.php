<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    $liste = $reunion->inscritsForSortie();
    $nb = 0;
    while ($data = $liste->fetch()) {
        $nb++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer(' . $data['id_sortie'] . ')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';
         if($data['etat'] == 0){
             $eta = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" class="btn  btn-sm btn-red-transparent">
                                            Non
                                        </a>
                                    </div>';
         }else{
             $eta = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" class="btn  btn-sm btn-green-transparent">
                                            Oui
                                        </a>
                     </div>';
         }
        $nom =  html_entity_decode(stripslashes($data['nom'])) .' '. html_entity_decode(stripslashes($data['prenom']));
        $phone =  $data['phone'];
        $arr_list['data'][] = array(
            $nb,
            date_fr($data['date_sortie']),
            $nom,
            $phone,
            html_entity_decode(stripslashes($data['village'])),
            $eta,
            $action


        );
    }
}

echo json_encode($arr_list);
