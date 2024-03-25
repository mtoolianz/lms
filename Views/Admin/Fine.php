<?php 
    // Include header file
    include_once ("../Layouts/header2.php");

    // Include connection file
    include_once ("../../connection/connect.php");

    // Query to fetch data from the borrowed_books table where return date has passed and status is not 'Returned'
    $query = "SELECT *, TIMESTAMPDIFF(DAY, return_date, NOW()) AS days_late, CASE WHEN TIMESTAMPDIFF(DAY, return_date, NOW()) > 0 THEN TIMESTAMPDIFF(DAY, return_date, NOW()) * 50 ELSE 0 END AS fine FROM borrowed_books WHERE status != 'Returned' AND return_date < NOW()";
    $result = mysqli_query($con, $query);

    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
?>
    <section class="content m-5">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                               <th>Book ID</th>
                               <th>Book Name</th>
                               <th>User Name</th>
                               <th>Borrowed Date</th>
                               <th>Return Date</th>
                               <th>Status</th>
                               <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            // Fetch rows from the result set
                            while($row = mysqli_fetch_assoc($result)) {
                        ?>
                               <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['book_name'] ?></td>
                                    <td><?= $row['user_name'] ?></td>
                                    <td><?= $row['borrowed_date'] ?></td>
                                    <td><?= $row['return_date'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['fine'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
<?php
    } else {
        // No rows found
        echo "No records found where return date has passed and status is not 'Returned'.";
    }
    // Close connection
    mysqli_close($con);
?>
