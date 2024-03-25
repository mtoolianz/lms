<?php 
    // Include header file
    include_once("../Layouts/user_header.php");
    
    // Include database connection file
    include_once("../../connection/connect.php");

    // Query to fetch data from the add_books table
    $query = "SELECT * FROM add_books";
    $result = mysqli_query($con, $query);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store books
        $books = array();

        // Fetch rows from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the books array
            $books[] = $row;
        }
    } else {
        // No books found
        $books = array();
    }
?>

<!-- HTML code to display the books -->
<div class="container">
    <form class="d-flex m-5 mb-2">
        <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="button">Search</button>
    </form>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="">Book id</th>
                                <th class="">Books NAME</th>
                                <th class="">Author</th>
                                <th class="">Publisher</th>
                                <th class="">Year</th>
                                <th class="">AVAILABILITY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $key => $book) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $book['book_title'] ?? ""; ?></td>
                                    <td><?= $book['author'] ?? ""; ?></td>
                                    <td><?= $book['publisher'] ?? ""; ?></td>
                                    <td><?= $book['year'] ?? ""; ?></td>
                                    <td><?= $book['number_of_copies'] ?? ""; ?></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchText = $('#searchInput').val().toLowerCase();
            // Loop through all table rows
            $('tbody tr').each(function() {
                var found = false;
                // Loop through all table cells in this row
                $(this).find('td').each(function() {
                    var cellText = $(this).text().toLowerCase();
                    // Check if the cell text contains the search text
                    if (cellText.indexOf(searchText) !== -1) {
                        found = true;
                        return false; // Exit the loop if found
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
