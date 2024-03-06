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
$nbt = $carte->getNbAllByEtatCarte();
if($nbrt = $nbt->fetch()){
    $nbrCarte = $nbrt['nb'] ;
}else{
    $nbrCarte = 0;
}
/*$mont = $nbrCarte *1000;*/
$mont = 0;
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;

require_once 'layout/head.php';
?>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">
            <div class="row pt-5 mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-secondary img-card box-secondary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?=$nbrTotalCarte?></h2>
                                            <p class="text-white mb-0">Total inscrit</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-eye text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-warning img-card box-primary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?=$nbrCarteE?></h2>
                                            <p class="text-white mb-0">En attente</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card  bg-success img-card box-success-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?=$nbrCarteValid?></h2>
                                            <p class="text-white mb-0">Disponible</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-briefcase text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-info img-card box-info-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?= number_format($mont,0,',',' ')?> CFA</h2>
                                            <p class="text-white mb-0">Solde</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-money text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-semibold">Les inscrits pour la sortie détente</h4> <a href="<?=$domaine_admin?>/facture" class="downl">Télécharger</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap border-bottom" id="TableInscrits">
                                    <thead>
                                    <tr class="border-bottom">
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Nom & Prénom</th>
                                        <th class="wd-15p">Téléphone</th>
                                        <th class="wd-15p">Village</th>
                                        <th class="wd-15p">Payer</th>
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
    var TableInscrits;
    $(document).ready(function() {

        TableInscrits = $('#TableInscrits').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/sortie-liste",
                "data":{
                    token:"<?=$token?>"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            "ordering": false,
            "pageLength": 100,
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
</script>

<script>

    $('#comentUpdForm').submit(function(e){
        e.preventDefault();
        $('.load').html('<i class="loader-btn"></i>');
        var value = document.getElementById('comentUpdForm');
        var form = new FormData(value);

        $.ajax({
            method: 'post',
            url: '<?=$domaine_admin?>/controller/update.comment.php',
            data: form,
            contentType:false,
            cache:false,
            processData:false,
            dataType: 'json',
            success: function(data){
//                    alert(data.data_info);
                if(data.data_info == "ok"){
                    TableInscrits.ajax.reload(null,false);
                    $( "#here" ).load(window.location.href + " #here" );
                    $('.load').html('<i class=""></i>');
                    $('.updSucces').html('<div class="alert alert-success" style="font-size: 14px" role="alert">Commentaire modifié avec succès !</div>');
                }else if(data.data_info == ''){

                }
                else {
                    $('.updError').html('<div class="alert alert-danger" style="font-size: 14px" role="alert">Une erreur s\'est produite lors de la modification du commentaire</div>');
                }
            },
            error: function (error, ajaxOptions, thrownError) {
                alert(error.responseText);
            }
        });
    });


    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer le membre ?",
                    text: "L'action va supprimer le membre sélectionné",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/sortie.delete', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Suppression effectuée avec succès!","", "success");
                                TableInscrits.ajax.reload(null,false);
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
    function supprimers(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer le membre ?",
                    text: "L'action va supprimer le membre",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/carte.delete', {id : id}, function (data) {
                            if(data == "ok"){
                                TableInscrits.ajax.reload(null,false);
                                swal("Opération effectuée avec succès!","", "success");
                            }else{
                                swal("Impossible de supprimer le membre!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }
</script>

