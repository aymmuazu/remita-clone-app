<title>Home - Remita</title>
<link rel="stylesheet" href="assets/bootstrap.css">
<link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Poppins', sans-serif;
    }
</style>
<div class="container text-center pt-5">
    <div class="">
        <img src="assets/logo.png" alt="" style="width: 10%;">
    </div>
    
    <h2 class="pt-5"><b>Empower</b> your <b>Customers</b> to pay you easily as you <b>grow</b></h2>
    <hr>

    <a href="initilize.php" class="btn btn-danger">Intilize a Simple Payment</a>
    <a href="verify.php" class="btn btn-outline-danger">Verify a Payment Status</a>
    <a href="pay.php" class="btn btn-warning">Pay RRR</a>
    <p>
        <?php
            session_start();
            if (isset($_SESSION['delete'])&&!empty($_SESSION['delete'])) {
                echo '<div class="alert alert-info">'.$_SESSION['delete'].'</div>';
                session_unset();
            }

        ?>
    </p>
    <hr>
    <h3 class="pt-5 mb-4">List of Initiated RRR</h3>

    <table class="table">
        <thead>
            <th>S/N</th>
            <th>PAYEES NAME</th>
            <th>AMOUNT</th>
            <th>RRR</th>
            <th>STATUS</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <?php
                require 'server.php';
                $query = "SELECT * FROM `pre-payments`";
                $query_run = mysqli_query($con, $query);
                while ($query_row = mysqli_fetch_array($query_run)){
            ?>

            <tr>
                <td><?php echo $query_row['id']?></td>
                <td><?php echo $query_row['name']?></td>
                <td><?php echo $query_row['amount']?></td>
                <td><?php echo $query_row['rrr']?></td>
                <td>
                    <?php
                    
                        $rrr = $query_row['rrr'];
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
                            echo '<span class="badge badge-primary">Pending Transcation</span>';
                        }
                        elseif($status == '01'){
                            echo '<span class="badge badge-success">Paid Already</span>';
                        }
                        elseif($status == '023'){
                            echo '<span class="badge badge-danger">Something Wrong</span>';
                        }
                        else{
                            echo $response;
                        }
                    ?>
                </td>
                <td><a href="del.php?rrr=<?php echo $query_row['rrr']?>">Delete</a></td>
            </tr>

            <?php
                }
            ?>
        </tbody>
    </table>
</div>