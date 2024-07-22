<?php
    if (isset($_GET['RRR']) && isset($_GET['orderID']) ) {
        $rrr = $_GET['RRR'];
        $orderId = $_GET['orderID'];
        $merchantId = 2547916;
        $apiKey = 1946;
        $apiHash = hash('sha512', $rrr.''.$apiKey.''.$merchantId);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://demo.remita.net/remita/exapp/api/v1/send/api/echannelsvc/'.$merchantId.'/'.$rrr.'/'.$apiHash.'/status.reg',
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
    elseif($status == '00'){
    }
    else{
        echo '<script>window.location.href="pay.php";</script>';
    }
?>

<title>Callback - Remita-Clone App</title>
<?php include('header.php') ?> 

<div class="container pt-0">
    
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
        <a onclick="print()" class="btn btn-danger">Print Page</a>
        <a onclick="window.location.href='index.php'" class="btn btn-primary">Home</a>
    </p>
</div>

<?php include('footer.php') ?> 

<?php
}else{
    echo '<script>window.location.href="pay.php";</script>';
}
?>