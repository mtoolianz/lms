<?php 
    include_once ("../Layouts/header2.php");
    include_once ("../../connection/connect.php");
   
    // Query to fetch data from the add_books table
    $query = "SELECT * FROM add_books";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        $books = $result->fetch_all(MYSQLI_ASSOC); // Fetch all records as an associative array
    } else {
        // Handle the case where the query failed
        $books = array(); // Initialize an empty array
        echo "Error: " . $con->error; // Display error message
    }
?>

<!-- Get database Data -->
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
                                <th style="width: 200px">Options</th>
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
                                    <td>
                                        <div>
                                            <button class='btn btn-sm btn-info m-2 edit-book' data-id="<?= $book['book_id'] ?>">Edit</button>
                                            <button class='btn btn-sm btn-danger m-2 delete-book' data-id="<?= $book['book_id'] ?>">Delete</button>
                                        </div>
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

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit book details -->
                <form id="editBookForm">
                    <input type="hidden" id="editBookId" name="editBookId">
                    <div class="mb-3">
                        <label for="editBookTitle" class="form-label">Book Title</label>
                        <input type="text" class="form-control" id="editBookTitle" name="editBookTitle">
                    </div>
                    <div class="mb-3">
                        <label for="editBookAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="editBookAuthor" name="editBookAuthor">
                    </div>
                    <div class="mb-3">
                        <label for="editBookPublisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" id="editBookPublisher" name="editBookPublisher">
                    </div>
                    <div class="mb-3">
                        <label for="editBookYear" class="form-label">Year</label>
                        <input type="text" class="form-control" id="editBookYear" name="editBookYear">
                    </div>
                    <div class="mb-3">
                        <label for="editBookAvailability" class="form-label">Availability</label>
                        <input type="text" class="form-control" id="editBookAvailability" name="editBookAvailability">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $(".edit-book").click(function() {
            var bookId = $(this).data("id");
            $.ajax({
                url: "../get_details/get_book_details.php",
                method: "POST",
                data: { book_id: bookId },
                dataType: "json",
                success: function(response) {
                    // Populate form fields with book details
                    $("#editBookId").val(response.book_id);
                    $("#editBookTitle").val(response.book_title);
                    $("#editBookAuthor").val(response.author);
                    $("#editBookPublisher").val(response.publisher);
                    $("#editBookYear").val(response.year);
                    $("#editBookAvailability").val(response.number_of_copies);
                    // Show modal containing the form
                    $('#editBookModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $("#editBookForm").submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = $(this).serialize();

            // Send AJAX request to update database
            $.ajax({
                url: "../Update_function/update_book.php", // PHP script to handle update
                method: "POST",
                data: formData,
                success: function(response) {
                    // Handle success (if needed)
                    console.log(response);
                    // Reload the page or update the table with the new data
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error (if needed)
                    console.error(xhr.responseText);
                }
            });
        });

        $(".delete-book").click(function() {
            var bookId = $(this).data("id");
            // Confirm deletion
            if (confirm("Are you sure you want to delete this book?")) {
                // Send AJAX request to
                                // Send AJAX request to delete book
                                $.ajax({
                    url: "../delete_function/delete_book.php",
                    method: "POST",
                    data: { book_id: bookId },
                    success: function(response) {
                        // Handle success (if needed)
                        console.log(response);
                        // Reload the page or update the table with the new data
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error (if needed)
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        $("#searchButton").click(function() {
            var searchInput = $("#searchInput").val().trim();
            if (searchInput !== "") {
                // Send AJAX request to search for books
                $.ajax({
                    url: "../search_function/search_books.php",
                    method: "POST",
                    data: { search_query: searchInput },
                    dataType: "json",
                    success: function(response) {
                        // Clear table body
                        $("tbody").empty();
                        // Populate table with search results
                        $.each(response, function(index, book) {
                            var row = "<tr>" +
                                "<td>" + (index + 1) + "</td>" +
                                "<td>" + book.book_title + "</td>" +
                                "<td>" + book.author + "</td>" +
                                "<td>" + book.publisher + "</td>" +
                                "<td>" + book.year + "</td>" +
                                "<td>" + book.number_of_copies + "</td>" +
                                "<td>" +
                                "<div>" +
                                "<button class='btn btn-sm btn-info m-2 edit-book' data-id='" + book.book_id + "'>Edit</button>" +
                                "<button class='btn btn-sm btn-danger m-2 delete-book' data-id='" + book.book_id + "'>Delete</button>" +
                                "</div>" +
                                "</td>" +
                                "</tr>";
                            $("tbody").append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

    });
</script>
