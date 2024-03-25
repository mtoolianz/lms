<?php 
include_once ("../Layouts/header2.php");
include_once ("../../connection/connect.php"); 


?>

<div class="col-xxl m-4">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add Books</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Book Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Book_Title" name="Book_Title" placeholder="Enter Book Title" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-company">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Author" name="Author" placeholder="Enter Author" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">Publisher</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="text" id="Publisher" name="Publisher" class="form-control" placeholder=" Enter Publisher" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Year</label>
                    <div class="col-sm-10">
                        <input type="text" id="basic-default-Year" name="Year" class="form-control phone-mask" placeholder="Enter Year" aria-label="year" aria-describedby="basic-default-year" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">Number of Copies</label>
                    <div class="col-sm-10">
                        <input type="text" id="basic-default-text" name="Number_of_Copies" class="form-control" placeholder="Enter Number of Copies" aria-label="Number of Copies" aria-describedby="basic-default-Copies" required>
                    </div>
                </div>
                <?php
                    if(isset($_POST['submit'])){
                      // Retrieve form data
                      $book_title = mysqli_real_escape_string($con, $_POST['Book_Title']);
                      $author = mysqli_real_escape_string($con, $_POST['Author']);
                      $publisher = mysqli_real_escape_string($con, $_POST['Publisher']);
                      $year = mysqli_real_escape_string($con, $_POST['Year']);
                      $number_of_copies = mysqli_real_escape_string($con, $_POST['Number_of_Copies']);
                      
                      $sql = "INSERT INTO `add_books` (book_title, author, publisher, year, number_of_copies) 
                              VALUES ('$book_title', '$author', '$publisher', '$year', '$number_of_copies')";
                      $login_query = mysqli_query($con, $sql);
                      
                      if($login_query) {
                          echo "<div class='alert alert-success alert-dismissible' role='alert'>
                          Book Add Successfully
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                      } else {
                          echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
                      }
                  }
                ?>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
