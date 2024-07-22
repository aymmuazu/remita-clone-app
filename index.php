<title>Home - Remita-Clone App</title>
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
    <hr>
    <h3 class="pt-2 font-weight-bold mb-4">Transactions</h3>

    <table class="table table-bordered">
        <thead>
            <th>S/N</th>
            <th>PAYEES NAME</th>
            <th>AMOUNT</th>
            <th>RRR</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <?php
                require 'server.php';
                $query = "SELECT * FROM `payments`";
                $query_run = mysqli_query($con, $query);
                while ($query_row = mysqli_fetch_array($query_run)){
            ?>

            <tr>
                <td><?php echo $query_row['id']?></td>
                <td><?php echo $query_row['name']?></td>
                <td><?php echo number_format($query_row['amount'],2)?></td>
                <td><?php echo $query_row['rrr']?></td>
                <td><a class="btn btn-danger btn-sm" href="del.php?rrr=<?php echo $query_row['rrr']?>">Delete</a></td>
            </tr>

            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php') ?> 
