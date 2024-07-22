<title>PayNow - Remita-Clone App</title>
<?php include('header.php') ?> 

<div class="container text-center">
    <p>
        <?php
            session_start();
            if (isset($_SESSION['delete'])&&!empty($_SESSION['delete'])) {
                echo '<div class="alert alert-info">'.$_SESSION['delete'].'</div>';
                session_unset();
            }

        ?>
    </p>
    <?php
        $rrr = $_GET['rrr'];
        $apiKey = 1946;
        $merchantId =  2547916;
        $hash = hash('sha512', $merchantId.''.$rrr.''.$apiKey);
    ?>
    <a href="https://demo.remita.net/remita/onepage/biller/<?php echo $_GET['rrr'];?>/payment.spa" class="btn btn-danger btn-lg">Let's Pay Now</a>
</div>

<?php include('footer.php') ?> 