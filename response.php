<?php
if (isset($_GET['RRR']) && isset($_GET['orderID']) ) {
    $rrr = $_GET['RRR'];
    $orderId = $_GET['orderID'];
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

    $obj = json_decode($response, true);

    $status = $obj['status'];
    $amount = $obj['amount'];
    $paymentDate = $obj['paymentDate'];
    $transactiontime = $obj['transactiontime'];
    $paymentstatus = $obj['message'];

    if ($status == '021') {
        echo '<script>window.location.href="pay.php";</script>';
    }
    elseif($status == '023'){
        echo '<script>window.location.href="pay.php";</script>';
    }
    elseif($status == '01'){
        
    }
    else{
        echo '<script>window.location.href="pay.php";</script>';
    }
?>

<title>Proceed to Pay  - Remita</title>
<link rel="stylesheet" href="assets/bootstrap.css">
<link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Poppins', sans-serif;
    }
</style>
<div class="container pt-5">
    <div class="text-center">
        <img src="assets/logo.png" alt="" style="width: 10%;">
    </div>
    
    <h2 class="pt-5 text-center">All About It's PHP Programming Language API</h2>
    <hr>

    <div class="alert alert-success text-center">
        Congratulations! You just make a payment
    </div>

    <table class="table offset-md-3 col-md-6">
        <tr>
            <td>Remita Retrival Reference</td>
            <td><?php echo $rrr; ?></td>
        </tr>
        <tr>
            <td>Order ID</td>
            <td><?php echo $orderId; ?></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $amount; ?></td>
        </tr>
        <tr>
            <td>Payment Date</td>
            <td><?php echo $paymentDate; ?></td>
        </tr>
        <tr>
            <td>transaction Time</td>
            <td><?php echo $transactiontime; ?></td>
        </tr>
    </table>

    <p class="pt-5 text-center">
        <a onclick="print()" class="btn btn-primary">Print Page</a>
        <a onclick="window.location.href='index.php'" class="btn btn-primary">Home</a>
    </p>

</div>

<?php
}else{
    echo '<script>window.location.href="pay.php";</script>';
}
?>