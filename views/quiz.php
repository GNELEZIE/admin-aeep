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
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>



<div class="main-content app-content mt-0">
    <div class="side-app mt-5 pt-5">
        <div class="main-container container-fluid mt-5">
            <div class="card mt-5" style="margin-top: 112px !important;">
                <div class="card-header" style="border-bottom: 0 !important;">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class=" "><b>La liste des questions</b></h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-primary" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modalQuiz">Ajouter une question</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modalReponse">Ajouter une réponse</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="table-responsive">
                            <table class="table text-nowrap border-bottom" id="tableQuiz">
                                <thead>
                                <tr class="border-bottom">
                                    <th class="wd-15p">N°</th>
                                    <th class="wd-15p">Date</th>
                                    <th class="wd-15p">Question</th>
                                    <th class="wd-15p" style="text-align: center">Réponses</th>
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

<div class="modal fade" id="modalReponseShow">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h2 class="modal-title" id="quest_t"></h2>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body text-left">
                    <p class="tttt"></p>
                        <p class="repo" id="repo"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light" data-bs-dismiss="modal">Fermer</a>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalReponse">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <form id="reponseForm" method="post">
                <div class="modal-header">
                    <h2 class="modal-title">Ajouter une réponse</h2>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="quest_id">La question</label>

                            <select name="quest_id" id="quest_id" class="form-control input-style" aria-hidden="true">
                                <?php
                                $qust = $questions->getAllQuestion();
                                while($qustData = $qust->fetch()){
                                    ?>
                                    <option value="<?=$qustData['id_questions']?>"><?=html_entity_decode(stripslashes($qustData['quest_t']))?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="reponse_">La réponse</label>
                                <textarea class="form-control input-style" name="reponse_" id="reponse_" rows="2" placeholder="Question" required></textarea>
                                <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="point_">Nombre de point</label>
                                <input class="form-control input-style" name="point_" id="point_" placeholder="Nombre de point" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"> <i class="reponseLoad"></i> Enregistrer </button>
                    <a href="#" class="btn btn-light" data-bs-dismiss="modal">Fermer</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalQuiz">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <form id="quizForm" method="post">
                <div class="modal-header">
                    <h2 class="modal-title">Posez votre question</h2>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control input-style" name="question_" id="question_" rows="3" placeholder="Question" required></textarea>
                        <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"> <i class="quizLoad"></i>  Enregistrer </button>
                    <a href="#" class="btn btn-light" data-bs-dismiss="modal">Fermer</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'layout/foot.php';
?>
<script>
    var tableQuiz;

    $(document).ready(function() {
        tableQuiz = $('#tableQuiz').DataTable({
            "ajax":{
                "type":"post",
                "url":"<?=$domaine_admin?>/controle/questions-liste",
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

        $('#modalReponseShow').on('show.bs.modal', function (e) {
            var Qid = $(e.relatedTarget).data('id');
            var quest_t = $(e.relatedTarget).data('quest_t');
            var repo = $(e.relatedTarget).data('repo');
            var v_f = $(e.relatedTarget).data('v_f');

            $('.tttt').addClass(v_f);
            $('#repo').html(repo);
            $('#quest_t').html(quest_t);
        });


        $('#reponseForm').submit(function(e){
            e.preventDefault();
            $value = $(this);
            $('.reponseLoad').html('<i class="loader-btn"></i>');
            $.post('<?=$domaine_admin?>/controle/reponse.save', $value.serialize(), function (data) {
                if(data == "ok"){
                    tableQuiz.ajax.reload(null,false);
                    $('.reponseLoad').html('');
                    $value[0].reset();
                    Snackbar.show({
                        text: 'Opération effectuée avec succès.',
                        pos: 'top-right',
                        backgroundColor: '#2ab57d',
                        actionText: '<i class="ri-checkbox-circle-line" style="color:#ffffff"></i>'
                    });

                }else {
                    $('.reponseLoad').html('');
                    Snackbar.show({
                        text: 'Oups ! Une erreur s\'est produite.',
                        pos: 'top-right',
                        backgroundColor: '#fd625e',
                        actionText: '<i class="ri-close-circle-line" style="color:#ffffff"></i>'
                    });
                }
            });
        });

        $('#quizForm').submit(function(e){
            e.preventDefault();
            $value = $(this);
            $('.quizLoad').html('<i class="loader-btn"></i>');
            $.post('<?=$domaine_admin?>/controle/question.save', $value.serialize(), function (data) {
                if(data == "ok"){
                    tableQuiz.ajax.reload(null,false);
                    $('.quizLoad').html('');
                    $value[0].reset();
                    Snackbar.show({
                        text: 'Opération effectuée avec succès.',
                        pos: 'top-right',
                        backgroundColor: '#2ab57d',
                        actionText: '<i class="ri-checkbox-circle-line" style="color:#ffffff"></i>'
                    });

                }else {
                    $('.quizLoad').html('');
                    Snackbar.show({
                        text: 'Oups ! Une erreur s\'est produite.',
                        pos: 'top-right',
                        backgroundColor: '#fd625e',
                        actionText: '<i class="ri-close-circle-line" style="color:#ffffff"></i>'
                    });
                }
            });
        });
    });



    // supprimer
    function supprimer(id = null){
        if(id){
            swal({
                    title: "Voulez vous supprimer la question ?",
                    text: "L'action va supprimer la question sélectionnée",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui, supprimer",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $.post('<?=$domaine_admin?>/controle/question.delete', {id : id}, function (data) {
                            if(data == "ok"){
                                swal("Suppression effectuée avec succès!","", "success");
                                tableQuiz.ajax.reload(null,false);
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