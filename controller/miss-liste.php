<?php

$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    $liste = $miss->getAllQuestion();

     $nb = 0;
    while ($data = $liste->fetch()) {
        $nb++;
        $action = '<div class="btn-list text-center">
                                        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_questions'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
                                        <a href="#" class="btn  btn-sm btn-red-transparent">
                                            <span class="fe fe-eye"> </span>
                                        </a>
                                    </div>';



//        $nbr = $reponses->nbRepByQuId($data['id_questions'])->fetch();
//
//        $getRep = $reponses->getRepByQuId($data['id_questions']);
//        $repo = '';
//
//        $n_b = 0;
//        while($getRepData = $getRep->fetch()){
//            $n_b++;
//
//            $repo .= '<span>'.$n_b.'-'. html_entity_decode(stripslashes($getRepData['reponse_s'])).'</span><br>';
//        }
//        $reponsess = '<a class="badge bg-success rounded-pill" data-bs-effect="effect-sign" data-bs-toggle="modal"
//                     data-id="'.$data["id_questions"].'"
//                     data-repo="'.$repo.'"
//                     data-quest_t="'.html_entity_decode(stripslashes($data['quest_t'])).'"
//                     href="#modalReponseShow">'.$nbr['nb'].'</a>';


        $arr_list['data'][] = array(
            $nb,
            date_fr($data['date_miss']),
            html_entity_decode(stripslashes($data['nom'])),
            html_entity_decode(stripslashes($data['phone'])),
            html_entity_decode(stripslashes($data['village'])),
            $nb,
            $action


        );
    }
}

echo json_encode($arr_list);
