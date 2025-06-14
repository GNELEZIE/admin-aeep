<style type="text/css">
    table {
        width: 100%;
        color: #515355;
        font-family: helvetica;
        line-height: 5mm;
        border-collapse: collapse;
    }
    h2 { margin: 0; padding: 0; }
    p { margin: 5px; }
    .border th {
        padding: 10px;
        font-size: 12px;
        text-align: center;
        color: #67748e;
    }
    .border td {
        padding: 5px 10px;
        text-align: right;
        color: #67748e;
    }
    .no-border {
        border-right: 1px solid #67748e;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }
    .10p { width: 10%; } .15p { width: 15%; }
    .20p { width: 20%; } .25p { width: 25%; }
    .30p { width: 30%; } .35p { width: 35%; }
    .40p { width: 40%; } .50p { width: 50%; }
    .60p { width: 60%; } .65p { width: 65%; }
    .70p { width: 70%; } .75p { width: 75%; }
    .80p { width: 80%; }
    .100p { width: 100%; }

    hr{color: #67748e;}
    strong,span{
        line-height: 25px;
        font-size: 14px;
    }

    .content-pad{
        padding-top: 15px;
        padding-bottom: 15px
    }
    .text-blue{
        color: #67748e;
    }
    .border-right-radius{
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .border-left-radius{
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }
    .ttc{
        background: #eef0f5;
        border-radius: 12px;
        font-weight: bold;
    }
    thead tr th{
        border : 1px solid #67748e;
    }
    tbody tr td{
        border : 1px solid #67748e;
    }

    .log{
        font-size: 20px;
        color: #67748e;
        margin-top: 20mm;margin-left: 16mm;max-width: 170px;
        font-weight: bold;
    }

    .myLogo{

        max-width: 70px;
        max-height: 70px;
    }
    p{
        margin: 0 !important;
    }

    .color-green{
        color: green !important;
    }

    .color-red{
        color: red !important;
    }

</style>

<page backtop="15mm" backbottom="15mm" backleft="16mm" backright="16mm">
    <page_header>
        <table>
            <tr>
                <th class="100p border-left-radius" style="text-align: center; font-size: 30px; padding-top: 40px; padding-bottom: 30px">
                    CONCOURS MISS AEEP 2024
                </th>
            </tr>
            <tr>
                <th class="100p border-left-radius" style="text-align: center; font-size: 30px; padding-bottom: 15px"><?=html_entity_decode(stripslashes($missData['nom']))?></th>
            </tr>
            <tr>
                <th class="100p border-left-radius" style="text-align: center; font-size: 25px; color: red"><b>Note finale : <?= $missData['note']?> /10</b></th>
            </tr>
        </table>
        <table style="padding-top: 30px; border-collapse: separate; border-spacing: 20px; ">

            <thead>
            <tr>
                <th class="100p" style=""></th>
            </tr>
            </thead>

            <tbody>
            <?php
            $qs = $resultats->getMissById_2($missData['id_miss']);
            $nq = 0;
            while($qDat_a = $qs->fetch()){
                $nq ++;
                $qData = $questions->getQById($qDat_a['q_id'])->fetch();
                ?>
                <tr style="margin-bottom: 15px">
                    <td>
                        <h3><?= html_entity_decode(stripslashes($qData['quest_t']))?></h3>
                        <?php
                        $getRep = $reponses->getRepByQuId2($qData['id_questions'],$missData['id_miss']);
                        $couleur = '';
                        $checked = '';
                        while($getRepData = $getRep->fetch()){
                            if($getRepData['checked'] == 1){
                                if($getRepData['point'] == 2){
                                    echo ' <p style="color: #008000;"> - '.html_entity_decode(stripslashes($getRepData['reponse_s'])).'</p>';
                                }else{
                                    echo ' <p style="color: red;"> - '.html_entity_decode(stripslashes($getRepData['reponse_s'])).'</p>';
                                }
                            }else{
                                echo ' <p> - '.html_entity_decode(stripslashes($getRepData['reponse_s'])).'</p>';
                            }
                        }

                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td class="text-blue" style="width: 100%; font-size: 10px">
                    <div style="width: 100%; text-align: center">Designed and Developed by Ouattara Gnelezie Arouna | Tél : 05 46 85 99 36 | Page [[page_cu]]/[[page_nb]]</div>

                </td>
            </tr>
        </table>
    </page_footer>

    <table style="margin-top: 70px;vertical-align: top;">
        <tr>
            <td class="65p text-blue">
                <span></span><br>
                <span></span>
            </td>
            <td class="35p text-blue">

            </td>
        </tr>
    </table>

</page>