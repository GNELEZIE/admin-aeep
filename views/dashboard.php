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
//require_once 'controller/note-upd.php';
$nbV = $carte->getNbAllCarteValid();
if($nbrV = $nbV->fetch()){
    $nbrCarteValid = $nbrV['nb'] ;
}else{
    $nbrCarteValid = 0;
}

$nbE = $carte->getNbAllCarteEnAttent();
if($nbrE = $nbE->fetch()){
    $nbrCarteE = $nbrE['nb'] ;
}else{
    $nbrCarteE = 0;
}

$nbtotal = $carte->getNbAllCarte();
if($nbrtto = $nbtotal->fetch()){
    $nbrTotalCarte = $nbrtto['nb'] ;
}else{
    $nbrTotalCarte = 0;
}
$mont = 0;
$nbtotals = $reunion->nbSortie();
if($nbrttosortie = $nbtotals->fetch()){
    $nbrttosorties = $nbrttosortie['nb'] ;
    $mont = $nbrttosorties*970;
}else{
    $nbrttosorties = 0;
}



$nbt = $carte->getNbAllByEtatCarte();
if($nbrt = $nbt->fetch()){
    $nbrCarte = $nbrt['nb'] ;
}else{
    $nbrCarte = 0;
}
//include_once $controller.'/payer-sortie.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;


require_once 'layout/head.php';
?>

<div class="main-content app-content  mt-5 pt-5">
    <div class="side-app  mt-5 pt-5">
        <div class="main-container container-fluid pt-5 mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="fw-semibold"><b>Concours miss AEEP 2024</b></h3>
                        </div>
                        <div class="card-body">
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
            </div>
        </div>
    </div>
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
