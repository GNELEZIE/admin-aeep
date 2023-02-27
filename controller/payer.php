<?php

$list = $carte->getAllCarte();
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
        "apikey" : "1841878195633ffd186cad60.31947873",
        "transaction_id":"'.$id.'",
        "site_id": "872975"


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
    }
    else{
        $res = json_decode($response,true);
        if($res['message'] == 'SUCCES' OR $res['message'] == 'succes'){
            $etat = 1;
            $upd = $carte->updateEtat($propriete,$etat,$data['id_carte']);
        }

    }
}