<?php

$list = $reunion->inscritsForSortie();
$propriete ='etat';

while($data = $list->fetch()){
    $id = $data['trans_id'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-checkout.cinetpay.com/v2/payment/check',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "apikey" : "1822785962633ac60986b536.85899562",
        "transaction_id":"'.$id.'",
        "site_id": "5868685"


    }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo $err;
    }else{
        $res = json_decode($response,true);
        if($res['message'] == 'SUCCES' OR $res['message'] == 'succes'){
            $etat = 1;
            $upd = $reunion->updateEtatSortie($propriete,$etat,$data['id_sortie']);
        }

    }
}