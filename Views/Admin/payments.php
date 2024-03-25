<?php 
include_once ("../Layouts/header2.php");
include_once ("../../connection/connect.php");

// Query to fetch data from the borrowed_books table where status is 'Returned'
$query = "SELECT * FROM borrowed_books WHERE status = 'Returned'";
$result = mysqli_query($con, $query);

?>

<!-- Display borrowed books data -->
<div class="container">
    <form class="d-flex m-5 mb-2" id="searchForm">
        <input id="searchInput" name="searchValue" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>
<div class="container">
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
                                <th class="">AMOUNT</th>
                                <th class="">STATUS</th>
                                <th class="">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch rows from the result set
                                while ($book = mysqli_fetch_assoc($result)) { 
                                    // Calculate difference in days between borrowed and return dates
                                    $borrowedDate = strtotime($book['borrowed_date']);
                                    $returnDate = strtotime($book['return_date']);
                                    $difference = $returnDate - $borrowedDate;
                                    $days = round($difference / (60 * 60 * 24));
                                    // Calculate amount
                                    $amount = $days * 100; // Assuming Rs. 100 per day
                                    ?>
                                    <tr>
                                        <td><?= $book['id'] ?></td>
                                        <td><?= $book['book_name'] ?? ""; ?></td>
                                        <td><?= $book['user_name'] ?? ""; ?></td>
                                        <td><?= $book['borrowed_date'] ?? ""; ?></td>
                                        <td><?= $book['return_date'] ?? ""; ?></td>
                                        <td><?= $amount ?></td> <!-- Display calculated amount -->
                                        <td><?= $book['action'] ?? ""; ?></td>
                                        <td>
                                            <div>
                                               <button class='btn btn-sm btn-primary m-2 edit-book' data-id="<?= $book['id'] ?>">PAY</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">No records found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $('.edit-book').click(function() {
            var returnBookId = $(this).data('id');
            var actionColumn = $(this).closest('tr').find('td').eq(6); // Assuming action column is the 7th column (index 6)
            
            // Send AJAX request to update action to 'Paid'
            $.ajax({
                url: '../Update_function/update_action.php', // Adjust URL according to your setup
                method: 'POST',
                data: { return_book_id: returnBookId },
                success: function(response) {
                    if (response === "success") {
                        actionColumn.text('Paid').css('color', 'green'); // Update action text and color
                    } else {
                        alert('Failed to update action.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating action:", error);
                }
            });
        });
        $('#searchForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            // Get the search input value
            var searchValue = $('#searchInput').val();
            
            // Send an AJAX request to fetch filtered data
            $.ajax({
                url: '../search_function/search_payments.php', // Adjust the URL according to your setup
                method: 'POST',
                data: { searchValue: searchValue },
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Update table with filtered data
                    updateTable(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching filtered data:", error);
                }
            });
        });

        // Function to update table with filtered data
        function updateTable(data) {
            var tableBody = $('#userData tbody');
            tableBody.empty(); // Clear existing table rows

            if(data.length > 0) {
                // Iterate through filtered data and add rows to the table
                $.each(data, function(index, book) {
                    // Similar to your existing code for displaying table rows
                    // Append rows to the tableBody
                    // Example:
                    // tableBody.append('<tr>...</tr>');
                });
            } else {
                // No records found
                tableBody.append('<tr><td colspan="8">No records found</td></tr>');
            }
        }
    });
</script>
<?php include_once ("../Layouts/footer2.php"); ?>
