<?php 
    include_once ("../Layouts/header2.php");
    include_once ("../../connection/connect.php");

    // Function to increase quantity in add_books table
    function increaseQuantity($bookName) {
        global $con;
        $query = "UPDATE add_books SET number_of_copies = number_of_copies + 1 WHERE book_title = '$bookName'";
        mysqli_query($con, $query);
    }

    // Handle return action
    if (isset($_POST['return_book_id'])) {
        $returnBookId = $_POST['return_book_id'];
        
        // Update status in borrowed_books table to 'Returned'
        $returnQuery = "UPDATE borrowed_books SET status = 'Returned' WHERE id = $returnBookId";
        mysqli_query($con, $returnQuery);

        // Send success response
        echo "success";
        exit;
    }

    // Query to fetch data from the borrowed_books table
    $query = "SELECT * FROM borrowed_books";
    $result = mysqli_query($con, $query);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store borrowed books
        $users = array();
    
        // Fetch rows from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the users array
            $users[] = $row;
        }
    } else {
        // No borrowed books found
        $users = array();
    }
?>

<!-- Get database Data -->
<div class="container">
    <form class="d-flex m-5 mb-2" id="searchForm">
        <input id="searchInput" name="searchValue" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped" id="userData">
                        <thead>
                            <tr>
                                <th style="">Book id</th>
                                <th class="">Books NAME</th>
                                <th class="">USER NAME</th>
                                <th class="">BORROWED DATE</th>
                                <th class="">RETURN DATE</th>
                                <th class="">STATUS</th>
                                <th class="">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $c) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['book_name'] ?? ""; ?></td>
                                    <td><?= $c['user_name'] ?? ""; ?></td>
                                    <td><?= $c['borrowed_date'] ?? ""; ?></td>
                                    <td><?= $c['return_date'] ?? ""; ?></td>
                                    <td><?= $c['status'] ?? ""; ?></td>
                                    <td>
                                        <?php if ($c['status'] !== 'Returned') { ?>
                                            <button class='btn btn-sm btn-info m-2 edit-book' data-id="<?= $c['id'] ?>">Return</button>
                                        <?php } else { ?>
                                            <button class='btn btn-sm btn-info m-2' disabled>Returned</button>
                                        <?php } ?>
                                    </td>
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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-book').click(function() {
            var returnBookId = $(this).data('id');
            var returnButton = $(this); // Store reference to the button
            
            // Send AJAX request to handle return action
            $.ajax({
                url: 'return_bookS.php',
                method: 'POST',
                data: { return_book_id: returnBookId },
                success: function(response) {
                    if (response === "success") {
                        // Change status to 'Returned' and disable button
                        returnButton.text('Returned').prop('disabled', true);
                    } else {
                        alert('Failed to return book.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error returning book:", error);
                }
            });
        });
        $('#searchForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally
        
        // Get the search input value
        var searchValue = $('#searchInput').val();
        
        // Send an AJAX request to fetch filtered data
        $.ajax({
            url: '../search_function/search_return_books.php', // Adjust the URL according to your setup
            method: 'POST',
            data: { searchValue: searchValue },
            success: function(response) {
                // Update table with filtered data
                $('#userData tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching filtered data:", error);
            }
        });
    });
    });
</script>