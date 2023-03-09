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

if(isset($doc[1]) and !isset($doc[2])){
    $list = $carte->getUserBySlug($doc[1]);
    if($dataCarte = $list->fetch()){

    }else{
        header('location:'.$domaine_admin.'/error');
        exit();
    }
}else{
    header('location:'.$domaine_admin);
    exit();
}

require_once 'controller/refuser-carte.php';
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
require_once 'layout/head.php'
?>



<div class="main-content app-content mt-0">
<div class="side-app">
<div class="main-container container-fluid">
<div class="row mt-5">
<div class="col-xl-12 mt-5">
    <div class="card">
        <div class="card-body" id="refreshData">
            <div class="row row-sm">
                <div class="col-md-12">
                    <?php if(!empty($errors)){ ?>
                        <div class="alert alert-danger" style="font-size: 14px" role="alert">
                            <?php foreach($errors as $error){ ?>
                                <?php echo $error ?>
                            <?php }?>
                        </div>
                    <?php }?>
                    <?php if(!empty($success)){ ?>
                        <div class="alert alert-success" style="font-size: 14px" role="alert">
                            <?php foreach($success as $suc){ ?>
                                <?php echo $suc ?>
                            <?php }?>
                        </div>
                    <?php }?>
                </div>
                <div class="col-xl-5 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="product-carousel">
                                <div class="carousel-item active">
                                    <img src="<?=$domaine?>/uploads/<?=$dataCarte['photo']?>" alt="img" class="img-carte mx-auto d-block">
                                    <?php
                                    if($dataCarte['statut'] != 1){
                                        ?>
                                      <div class="row" style="padding-top: 20px">
                                          <div class="col-md-6">
                                              <a href="javascript:void(0);" class="btn ripple btn-success me-2" onclick="valider(<?=$dataCarte['id_carte']?>)"><i class="fe fe-valid"> </i>Terminer</a>
                                          </div>
                                          <div class="col-md-6">
                                              <a class="modal-effect btn btn-danger-light d-grid mb-3" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modaldemo8">Refuser</a>
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
                <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                    <div class="mt-2 mb-4">
                        <h3 class="mb-3 fw-semibold"><?=html_entity_decode(stripslashes($dataCarte['nom'])).' '.html_entity_decode(stripslashes($dataCarte['prenom']))?></h3>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Date de naissance :</span><span class="fw-bold text-success"><?=date_fr($dataCarte['date_nais']);?></span></div>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Lieu de naissance :</span><span class="fw-bold text-success"><?=html_entity_decode(stripslashes($dataCarte['lieu_nais']))?></span></div>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Niveau d'étude  :</span><span class="fw-bold text-success"><?=html_entity_decode(stripslashes($dataCarte['niveau']))?></span></div>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Village :</span><span class="fw-bold text-success"><?=village_name($dataCarte['village']);?></span></div>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Genre :</span><span class="fw-bold text-success"><?=html_entity_decode(stripslashes($dataCarte['genre']))?></span></div>
                        <div class=" mt-4 mb-5"><span class="fw-bold me-2">Téléphone :</span><span class="fw-bold text-success"><?=$dataCarte['dial_phone'].' '.$dataCarte['phone'];?></span></div>

                        <hr>
                        <div class=" mt-4">
                            <hr>
                            <a href="<?=$domaine.'/uploads/'.$dataCarte['photo']?>" class="btn ripple btn-primary me-2" target="_blank"><i class="fe fe-download"> </i> Télécharger la photo</a>
<<<<<<< HEAD
                            <a href="<?=$domaine.'/uploads/'.$dataCarte['piece']?>" class="btn ripple btn-secondary me-2" target="_blank"><i class="fe fe-download"> </i>  Télécharger la pièce</a>
                            </div>
=======
                            <a href="<?=$domaine.'/uploads/'.$dataCarte['piece']?>" class="btn ripple btn-secondary" target="_blank"><i class="fe fe-download"> </i> Télécharger la pièce</a>
                        </div>
>>>>>>> 30da3104572b50eeaf0ebc67e511dd535b4bd805
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
<div class="modal fade" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <form id="refuserForm" method="post">
                <div class="modal-header">
                    <h6 class="modal-title">Motivation</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                     <textarea class="form-control input-style" name="message" id="message" rows="5" placeholder="Motif du rejet" required></textarea>
                     <input type="hidden" name="user" id="user" value="<?=$dataCarte['id_carte']?>"/>
                     <input type="hidden" class="form-control " name="formkey" value="<?= $token ?>">
                 </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Refuser</button>
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
    function downloadFile(url, fileName) {
        fetch(url, {
            method: 'get',
            mode: 'no-cors',
            referrerPolicy: 'no-referrer'
        })
            .then(res => res.blob()).then( res => {
            const aElement = document.createElement('a');
        aElement.setAttribute('download', fileName);
        const href = URL.createObjectURL(res);
        aElement.href = href;
        aElement.setAttribute('target', '_blank');
        aElement.click();
        URL.revokeObjectURL(href);
    });
    }
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
