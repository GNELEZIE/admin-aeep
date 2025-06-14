<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
if(!isset($_SESSION['useraeep'])){
    header('location:'.$domaine_admin.'/login');
    exit();
}
require_once 'controller/note-upd.php';

if(isset($doc[0]) and !isset($doc[1])){

}elseif(isset($doc[1]) and !isset($doc[2])){
    $getMiss = $miss->getMissBySlug($doc[1]);
    if($missData = $getMiss->fetch()){

    }else{
        header('location:'.$domaine_admin.'/error');
        exit();
    }
}else{
    header('location:'.$domaine_admin.'/error');
    exit();
}

$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>


<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <?php
            if(isset($doc[1]) and !isset($doc[2])){
                ?>
                <div class="card" style="margin-top: 112px !important;">
                    <div class="card-header" style="border-bottom: 0 !important;">
                        <h1 class=" "><b><?= html_entity_decode(stripslashes($missData['nom']))?></b> </h1>
                    </div>
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-md-12">
                                <div class="register-form">
                                    <h1 class=" "><b>Note finale : <span class="color-red"><?= $missData['note']?> /10</span></b> </h1>
                                    <form method="post" id="formQuiz">
                                        <?php if(!empty($error_s)){ ?>
                                            <div class="alert alert-danger" style="font-size: 14px" role="alert">
                                                <?php foreach($error_s as $error){ ?>
                                                    <?php echo $error ?>
                                                <?php }?>
                                            </div>
                                        <?php }?>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <?php
                                                $qs = $resultats->getMissById_2($missData['id_miss']);
                                                $nq = 0;
                                                while($qDat_a = $qs->fetch()){
                                                    $nq ++;
                                                    $qData = $questions->getQById($qDat_a['q_id'])->fetch();
                                                    ?>
                                                    <fieldset class="" style="border: 3px dashed #ececf6; padding: inherit; margin-bottom: 10px">
                                                        <legend><?= html_entity_decode(stripslashes($qData['quest_t']))?></legend>
                                                        <?php
                                                        $getRep = $reponses->getRepByQuId2($qData['id_questions'],$missData['id_miss']);
                                                        $couleur = '';
                                                        $checked = '';
                                                        while($getRepData = $getRep->fetch()){
                                                            if($getRepData['checked'] == 1){
                                                                if($getRepData['point'] == 2){
                                                                    $couleur ='color-green blod';
                                                                }else{
                                                                    $couleur ='color-red blod';
                                                                }
                                                                $checked = 'checked';

                                                            }else{
                                                                $checked = '';
                                                                $couleur = '';
                                                            }

                                                            ?>
                                                            <div class="form-group">
                                                                <input type="checkbox" class="text-left" id="rp<?=$getRepData['id_reponses']?>" name="<?=$qData['id_questions']?>_rp_<?=$getRepData['id_reponses']?>" value="<?=$getRepData['point']?>" <?=$checked?> readonly >
                                                                <label for="rp<?=$getRepData['id_reponses']?>" class="<?=$couleur?>"><?= html_entity_decode(stripslashes($getRepData['reponse_s']))?></label>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </fieldset>
                                                <?php
                                                }
                                                ?>

                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-2 text-center mb-3">
                                                <a href="<?=$domaine_admin?>/miss-2024" class="btn btn-primary"> <i class="fa fa-chevron-circle-left"></i> Retour </a>
                                            </div>
                                            <div class="col-md-2 text-center mb-3">
                                                <a href="<?=$domaine_admin?>/result/<?=$doc[1]?>" class="btn btn-success" target="_blank"> <i class="fa fa-download"></i> Télécharger </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }else{
                ?>
                <div class="card" style="margin-top: 112px !important;">
                    <div class="card-header" style="border-bottom: 0 !important;">
                        <h1 class=" "><b>Les résultats</b></h1>
                    </div>
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="table-responsive">
                                <table class="table text-nowrap border-bottom" id="tableMiss">
                                    <thead>
                                    <tr class="border-bottom">
                                        <th class="wd-15p">Rang</th>
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Nom & Prénom</th>
                                        <th class="wd-15p">Téléphone</th>
                                        <th class="wd-15p">Village</th>
                                        <th class="wd-15p">Note</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<?php
require_once 'layout/foot.php';
?>
<script>
    var tableMiss;

    $(document).ready(function() {
        tableMiss = $('#tableMiss').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/miss-liste",
                "data":{
                    token:"<?=$token?>"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            "ordering": false,
            "pageLength": 25,
            "language" : {
                "sProcessing": "Traitement en cours ...",
                "sLengthMenu": "Afficher _MENU_ lignes",
                "sZeroRecords": "Aucun résultat trouvé",
                "sEmptyTable": "Aucune donnée disponible",
                "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                "sInfoEmpty": "Aucune ligne affichée",
                "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                "sInfoPostFix": "",
                "sSearch": "Chercher:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": '<span class="fa fa-circle-notch fa-spin"></span> Chargement...',
                "oPaginate" : {
                    "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria" : {
                    "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
                }
            }
        });


    });

    // supprimer
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer la candidate ?",
                    text: "L'action va supprimer la candidate sélectionnée",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/miss.delete', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Suppression effectuée avec succès!","", "success");
                                tableMiss.ajax.reload(null,false);
                            }else{
                                swal("Impossible de supprimer!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }

</script>