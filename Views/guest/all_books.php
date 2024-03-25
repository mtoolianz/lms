<?php 
    // Include header file
    // include_once("../Layouts/user_header.php");
    
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
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Font awsome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>

<!-- HTML code to display the books -->
<div class="container">
    <form class="d-flex mx-5  mt-5">
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
