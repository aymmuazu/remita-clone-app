<?php

    $baseUrl = 'https://remitademo.net/remita/exapp/api/v1/send/api';
    $merchantId = 2547916;
    $apiKey = 1946;
    $serviceTypeId = 4430731;
    $amount = 10000;
    $orderId = 34444654594696;


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => ''.$baseUrl.'/echannelsvc/merchant/api/paymentinit',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{ 
      "serviceTypeId": "'.$serviceTypeId.'",
      "amount": "'.$amount.'",
      "orderId": "'.$orderId.'",
      "payerName": "Abdurrahim Yahya Muazu",
      "payerEmail": "aymmuazu@gmail.com",
      "payerPhone": "08137736578",
      "description": "Payment for Septmeber Fees"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: remitaConsumerKey='.$merchantId.',remitaConsumerToken='.hash('sha512', $merchantId.''.$serviceTypeId.''.$orderId.''.$amount.''.$apiKey).''
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

?>
