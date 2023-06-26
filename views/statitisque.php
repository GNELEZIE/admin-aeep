<?php
if(isset($doc[1])){
    $return = $doc[0]."/".$doc[1];
}else{
    $return = $doc[0];
}
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>



<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="row pt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Les inscrits par village</div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <?php
                                $vil = 0;
                                while($vil < 17 ) {
                                    $vil ++;

                                    $nb = $carte->getNbAllCarteByVillage($vil)->fetch();
                                    $nbvalid = $carte->getNbAllCarteValid()->fetch();
                                    ?>
                                    <div class="col-md-4">
                                        <div class="card-body mt-0">
                                            <div class="chats-wrap media-list">
                                                <div class="chat-details mb-1 p-3">
                                                    <h4 class="mb-0">
                                                        <span class="h5 fw-normal"><?=village_name($vil)?></span>
                                                    <span class="float-end p-1  btn btn-sm text-default">
                                                       <b class="text-danger"><?=$nb['nb']?></b> inscrits soit <b class="text-success"><?=pourcentage($nbvalid['nb'],$nb['nb'])?>%</b></span>
                                                    </h4>

                                                    <div class="progress progress-sm mt-3">
                                                        <div class="progress-bar  bg-success" style="width: <?=pourcentage($nbvalid['nb'],$nb['nb'])?>%;"></div>
                                                    </div>
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
                </div>
            </div>
        </div>










    </div>

</div>

<?php
require_once 'layout/foot.php';
?>



<script>

    function valider(id = null){
        if(id){
            swal({
                    title: "Voulez vous valider la carte ?",
                    text: "L'action va valider la carte",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0acf97",
                    confirmButtonText: "Oui, valider",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false
                },

                function(isConfirm){
                    if (isConfirm) {
                        $('.confirm').html('<i class="loader-btn"></i> Oui, Valider');
                        $.post('<?=$domaine_admin?>/controle/valider-carte', {token : '<?=$token?>',id : id}, function (data) {
                            if(data == "ok"){
                                $("#refreshData").load(window.location.href + " #refreshData" );
                                swal("Opération effectuée avec succès!","", "success");
                            }else{
                                swal("Impossible de valider la carte!", "Une erreur s'est produite lors du traitement des données.", "error");
                            }
                        });
                    }
                });
        }else{
            alert('actualise');
        }
    }
</script>
