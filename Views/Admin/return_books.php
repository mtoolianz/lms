<?php 
    include_once("../../connection/connect.php");

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

        // Get book name from borrowed_books
        $bookQuery = "SELECT book_name FROM borrowed_books WHERE id = $returnBookId";
        $bookResult = mysqli_query($con, $bookQuery);
        $bookData = mysqli_fetch_assoc($bookResult);
        $bookName = $bookData['book_name'];

        // Increase quantity in add_books table
        increaseQuantity($bookName);

        // Send success response
        echo "success";
        exit;
    }
?>
