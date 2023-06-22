<?php
$arr_list = array('data' => array());
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']){


    $liste=$carte->getAllCarte();
    while($data = $liste->fetch()) {
        if($data['statut'] == 1){
            $statut =' <span class="btn-success-light bradius mystat">Disponible</span>';
        }elseif($data['statut'] == 2){
            $statut =' <span class="btn-danger-light bradius mystat">Refusé</span>';
        }else{
            $statut =' <span class="btn-warning-light bradius mystat">En attente</span>';
        }
        if($data['etat'] == 1){
            $pay =' <span class="btn-success-light bradius mystat">Soldé</span>';
        }else{
            $pay =' <span class="btn-danger-light bradius mystat">Impayé</span>';
        }

        $nom = html_entity_decode(stripslashes($data['nom'])).' '.html_entity_decode(stripslashes($data['prenom'])).'
        <br><small>'.$data['phone'].'</small><br>'.html_entity_decode(stripslashes($data['niveau']));
        $imag ='<img src="'.$domaine.'/uploads/'.$data['photo'].'" class="rounded-img"> ';
        $action = '<a href="'.$domaine_admin.'/inscrits/'.$data['slug'].'" class="btn-info-light bradius mystat" target="_blank"> <i class="fa fa-eye"></i> voir </a>
        <a href="javascript:void(0);" id="bDel" type="button" class="btn  btn-sm btn-red-transparent" onclick="supprimer('.$data['id_carte'].')">
                                            <span class="fe fe-trash-2"> </span>
                                        </a>
        ';


        $arr_list['data'][] = array(
            date_fr($data['date_carte']),
            $imag,
            $nom,
            village_name($data['village']),
            $pay,
            $statut,
            $action
        );
    }
}

echo json_encode($arr_list);
