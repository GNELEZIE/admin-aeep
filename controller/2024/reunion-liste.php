<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    $liste = $reunion->getAllINscrits();

    while ($data = $liste->fetch()) {

        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer(' . $data['id_reunion'] . ')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                    </div>';


        $phone =  $data['phone'];
        $arr_list['data'][] = array(
            date_fr($data['date_reunion']),
            html_entity_decode(stripslashes($data['nom'])),
            $phone,
            html_entity_decode(stripslashes($data['email'])),
            html_entity_decode(stripslashes($data['ville'])),
            $action


        );
    }
}

echo json_encode($arr_list);
