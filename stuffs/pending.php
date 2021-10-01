<?php

$rrr = 240008229136;
$merchantId = 2547916;
$apiKey = 1946;
$apiHash = hash('sha512', $rrr.''.$apiKey.''.$merchantId);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://www.remitademo.net/remita/ecomm/'.$merchantId.'/'.$rrr.'/'.$apiHash.'/status.reg',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey='.$merchantId.',remitaConsumerToken='.$apiHash.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;