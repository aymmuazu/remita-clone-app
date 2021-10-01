<title>Pay  - Remita</title>
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

                if ($status == '021') {
                    echo '<script>window.location.href="paynow.php?rrr='.$rrr.'"</script>';
                }
                elseif($status == '023'){
                    echo '<div class="alert alert-danger">Invalid RRR</div>';
                }
                elseif($status == '01'){
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

    <form action="pay.php" method="POST" class="offset-md-3 col-md-6">
        <label for="">Enter your RRR:</label>
        <input name="responseurl" value="http://localhost/php/remita/response.php" type="hidden"> 

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" name="rrr" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Pay</button>
                    <a href="index.php" class="btn btn-outline-primary">Home</a>
                </div>
            </div>
        </div>
        
    </form>
</div>