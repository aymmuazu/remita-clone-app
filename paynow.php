
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
    
     <?php
        $rrr = $_GET['rrr'];
        $apiKey = 1946;
        $merchantId =  2547916;
        $hash = hash('sha512', $merchantId.''.$rrr.''.$apiKey);
    ?>
    <form action="https://remitademo.net/remita/ecomm/finalize.reg" method="POST">
        <input name="merchantId" value="2547916" type="hidden"> 
        <input name="hash" value="<?php echo $hash?>" type="hidden"> 
        <input name="rrr"  value="<?php echo $_GET['rrr'];?>" type="hidden"> 
        <input name="responseurl" value="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>/response.php" type="hidden"> 
        <input type="submit"value="Pay Now Via Remita" class="btn btn-danger btn-lg">
    </form> 
    
</div>
