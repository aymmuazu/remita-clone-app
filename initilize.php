<title>Initiate a Transaction - Remita-Clone App</title>
<?php include('header.php') ?> 

<div class="container pt-2">
    <h3 class="pt-2 font-weight-bold text-center mb-2">Initiate a Transaction</h3>
    <?php
    require 'server.php';

        if(isset($_POST['name']) 
            && isset($_POST['email']) 
            && isset($_POST['phone']) 
            && isset($_POST['description']) 
            && isset($_POST['amount']) 
            )
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $description = $_POST['description'];
            $amount = $_POST['amount'];
            $baseUrl = 'https://demo.remita.net/remita/exapp/api/v1/send/api';
            $merchantId = 2547916;
            $apiKey = 1946;
            $serviceTypeId = 4430731;
            $amount = $amount;
            $orderId = rand(92343459459, 93438458488);
            $user_ip_address = $_SERVER['REMOTE_ADDR'];


            if (!empty($name) && !empty($email) && !empty($phone) && !empty($description) && !empty($amount)) {
            
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
                "payerName": "'.$name.'",
                "payerEmail": "'.$email.'",
                "payerPhone": "'.$phone.'",
                "description": "'.$description.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: remitaConsumerKey='.$merchantId.',remitaConsumerToken='.hash('sha512', $merchantId.''.$serviceTypeId.''.$orderId.''.$amount.''.$apiKey).''
                ),
                ));
                
                $response = curl_exec($curl);

                curl_close($curl);

                $substr = substr($response, 7, -1);

                $obj = json_decode($substr, true);
                
                $rrr = $obj['RRR'];

                if ($rrr == NULL) {

                    echo '<div class="alert alert-danger">There is an error from the remita API.</div>';
                    
                }else{
                    $query = "INSERT INTO `payments` (`id`, `name`, `email`, `phone`, `description`, `amount`, `orderId`, `serviceTypeId`, `rrr`, `user_ip_address`, `created_at`, `updated_at`) 
                                VALUES (NULL, '".$name."', '".$email."', '".$phone."', '".$description."', '".$amount."','".$orderId."', '".$serviceTypeId."', '".$rrr."', '".$user_ip_address."', NOW(), NOW())";
                    
                    if ($query_run = mysqli_query($con, $query)) {

                        echo '<div class="alert alert-success">Payment Generated.</div>';
                    }else{
                        echo '<div class="alert alert-danger">Error occur please try again.</div>';
                    }
                }                
            }
            else{
                echo '<div class="alert alert-danger">All fields are required.</div>';
            }

        }

    ?>
    <form action="initilize.php" method="POST" class="offset-md-3 col-md-6">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Phone:</label>
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="name">Description:</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Amount:</label>
                    <input type="text" name="amount" class="form-control">
                    <small class="form-text text-muted">Not that your amount is in KOBO</small>
                </div>
                <div class="form-group pt-2">
                    <button type="submit" class="btn btn-danger">Generate RRR</button>
                    <a href="index.php" class="btn btn-outline-primary">Home</a>
                </div>
            </div>
        </div>
        
    </form>
</div>

<?php include('footer.php') ?> 