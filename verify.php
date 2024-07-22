<title>Veirfy - Remita-Clone App</title>
<?php include('header.php') ?> 
    <div class="container pt-5">
        <?php
        
            if(isset($_POST['rrr']))
            {
                $rrr_code = $_POST['rrr'];

                if (!empty($rrr_code)) {
                    
                    $rrr = $rrr_code;
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

                    if ($status == '021') {
                        echo '<div class="alert alert-warning">Transaction Pending</div>';
                    }
                    elseif($status == '023'){
                        echo '<div class="alert alert-danger">Invalid RRR</div>';
                    }
                    elseif($status == '00'){
                        echo '<div class="alert alert-success">RRR Already Paid.</div>';
                    }
                    else{
                        echo $response;
                    }
                }
                else{
                    echo '<div class="alert alert-danger">Please provide this field.</div>';
                }

            }

        ?>
        <form action="verify.php" method="POST" class="offset-md-3 col-md-6">
            <label for="">Enter your RRR:</label>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="rrr" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Verify Payments</button>
                        <a href="index.php" class="btn btn-outline-primary">Home</a>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
<?php include('footer.php') ?> 