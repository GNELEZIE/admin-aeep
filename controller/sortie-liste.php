<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    $liste = $reunion->inscritsForSortie();

    while ($data = $liste->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer(' . $data['id_sortie'] . ')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';

        $nom =  html_entity_decode(stripslashes($data['nom'])) .' '. html_entity_decode(stripslashes($data['prenom']));
        $phone =  $data['phone'];
        $arr_list['data'][] = array(
            date_fr($data['date_sortie']),
            $nom,
            $phone,
            html_entity_decode(stripslashes($data['village'])),
            $action


        );
    }
}

echo json_encode($arr_list);
