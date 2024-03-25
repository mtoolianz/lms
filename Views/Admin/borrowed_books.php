<?php 
    include_once ("../Layouts/header2.php");
    include_once ("../../connection/connect.php");

    // Fetch book titles from the add_books table
    $bookQuery = "SELECT book_title FROM add_books";
    $bookResult = mysqli_query($con, $bookQuery);
    $bookTitles = array();
    while ($row = mysqli_fetch_assoc($bookResult)) {
        $bookTitles[] = $row['book_title'];
    }

    // Function to calculate payment
    function calculatePayment($borrowedDate, $returnDate) {
        // Calculate the difference in days between borrowed and return dates
        $borrowedDateTime = strtotime($borrowedDate);
        $returnDateTime = strtotime($returnDate);
        $difference = $returnDateTime - $borrowedDateTime;
        $days = round($difference / (60 * 60 * 24));

        // Calculate payment
        $oneDayCost = 10;
        $payment = $days * $oneDayCost;

        return $payment;
    }

    // Function to decrease quantity in add_books table
    function decreaseQuantity($bookName) {
        global $con;
        $query = "UPDATE add_books SET number_of_copies = number_of_copies - 1 WHERE book_title = '$bookName'";
        mysqli_query($con, $query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from the form
        $bookName = $_POST['book_name'];
        $userName = $_POST['user_name'];
        $borrowedDate = $_POST['borrowed_date'];
        $returnDate = $_POST['return_date'];

        // Calculate payment
        $payment = calculatePayment($borrowedDate, $returnDate);

        // Decrease quantity in add_books table
        decreaseQuantity($bookName);

        // SQL query to insert data into borrowed_books table with default action value
        $query = "INSERT INTO borrowed_books (book_name, user_name, borrowed_date, return_date, status, action) 
                  VALUES ('$bookName', '$userName', '$borrowedDate', '$returnDate', 'Not Returned', 'Pending')";

        if (mysqli_query($con, $query)) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    }
?>

<!-- Form to input data -->
<div class="card m-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Borrowed Books</h5>
        <small class="text-muted float-end"></small>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">User Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="user_name" placeholder="User Name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="book_name">Book Name</label>
                <div class="col-sm-10">
                    <select class="form-select" id="book_name" name="book_name" required>
                        <option value="" selected disabled>Select Book</option>
                        <?php foreach ($bookTitles as $title) { ?>
                            <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                  <label for="borrowed-date" class="col-md-2 col-form-label">Borrowed Date</label>
                <div class="col-md-10">
                   <input class="form-control" type="date" id="borrowed-date" name="borrowed_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>

            <div class="mb-3 row">
                  <label for="return-date" class="col-md-2 col-form-label">Return Date</label>
                <div class="col-md-10">
                  <input class="form-control" type="date" id="return-date" name="return_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // When the form is submitted
        $('form').submit(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: '<?php echo $_SERVER['PHP_SELF']; ?>', // URL to submit the form data
                method: 'POST',
                data: formData, // Form data
                success: function(response) {
                    // Display success message or handle response
                    console.log(response);
                    // Example: If the response is "Record inserted successfully."
                    // You can display an alert or update the page content accordingly
                    alert(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error("Error:", error);
                    // Example: Display an error message
                    alert("Error: " + error);
                }
            });
        });
    });
</script>
