<?php 
    include_once ("../Layouts/user_header.php");
    include_once ("../../connection/connect.php");

    // Include database connection file
    include_once("../../connection/connect.php");
    
    // Query to fetch data from the borrowed_books table
    $query = "SELECT * FROM borrowed_books";
    $result = mysqli_query($con, $query);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store borrowed books
        $borrowedBooks = array();
    
        // Fetch rows from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the borrowedBooks array
            $borrowedBooks[] = $row;
        }
    } else {
        // No borrowed books found
        $borrowedBooks = array();
    }
?>

<!-- Display borrowed books data -->
<div class="container">
<form class="d-flex m-5 mb-2">
        <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="button">Search</button>
    </form>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($borrowedBooks as $key => $book) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $book['book_name'] ?? ""; ?></td>
                                    <td><?= $book['user_name'] ?? ""; ?></td>
                                    <td><?= $book['borrowed_date'] ?? ""; ?></td>
                                    <td><?= $book['return_date'] ?? ""; ?></td>
                                    <td><?= $book['status'] ?? ""; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add this script at the end of your HTML code -->
<script>
    $(document).ready(function() {
        // Add event listener for the search button click
        $('#searchButton').click(function() {
            // Get the search query from the input field
            var searchQuery = $('#searchInput').val().toLowerCase();

            // Loop through each row in the table body
            $('#userData tbody tr').each(function() {
                var found = false;
                // Loop through each cell in the current row
                $(this).find('td').each(function() {
                    var cellText = $(this).text().toLowerCase();
                    // Check if the cell text contains the search query
                    if (cellText.indexOf(searchQuery) !== -1) {
                        found = true;
                        return false; // Break out of the inner loop
                    }
                });
                // Show or hide the row based on search result
                if (found) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
