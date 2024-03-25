<?php 
include_once("../Layouts/header2.php");
include_once ("../../connection/connect.php"); 


// Query to fetch data from the add_books table
$query = "SELECT * FROM user_table";
$result = $con->query($query);

// Check if the query was successful
if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC); // Fetch all records as an associative array
} else {
    // Handle the case where the query failed
    $users = array(); // Initialize an empty array
    echo "Error: " . $con->error; // Display error message
}
?>
<!-- Get database Data -->
<form id="searchForm" class="d-flex m-5 mb-2">
    <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button id="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
</form>
<section class="content m-3">
    <div class="container-fluid">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="">User id</th>
                            <th class="">Name</th>
                            <th class="">User Type</th>
                            <th class="">Email</th>
                            <th class="">Address</th>
                            <th class="">Contact</th>
                            <th class="">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php foreach ($users as $key => $c) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $c['user_name'] ?? ""; ?> </td>
                            <td><?= $c['user_type'] ?? ""; ?> </td>
                            <td><?= $c['user_email'] ?? ""; ?> </td>
                            <td><?= $c['user_address'] ?? ""; ?> </td>
                            <td><?= $c['user_contact'] ?? ""; ?></td>
                            <td>
                                <div>
                                    
                                    <button class="btn btn-sm btn-info m-2 edit-user" data-id="<?= isset($c['user_id']) ? $c['user_id'] : '' ?>">Edit</button>
                                    <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= isset($c['user_id']) ? $c['user_id'] : '' ?>">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div style="text: center;">
                <button class="btn btn-sm btn-primary m-2 create-user" data-id="">Create</button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit user details -->
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="editUserId">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUserName" name="editUserName">
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="editUserEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editUserAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editUserAddress" name="editUserAddress">
                    </div>
                    <div class="mb-3">
                        <label for="editUserContact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="editUserContact" name="editUserContact">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to create a new user -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="createUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="createUserName" name="createUserName">
                    </div>
                    <div class="mb-3">
                        <label for="createUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="createUserEmail" name="createUserEmail">
                    </div>
                    <div class="mb-3">
                        <label for="createUserEmail" class="form-label">User Type</label>
                       <select name="user_type" id="user_type" required>
                        <option value="choose">Choose</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br>
                    </div>
                    <!-- password feield -->
                    <div class="form-outline mb-4">
                        <label for="creatUserPassword" class="form-label">Password</label>
                        <input type="password" id="creatUserPassword" class="form-control" autocomplete="off" required="required" name="creatUserPassword">
                    </div>
                    <!-- confirm password feield -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" autocomplete="off" required="required" name="conf_user_password">
                    </div>
                    <div class="mb-3">
                        <label for="createUserAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="createUserAddress" name="createUserAddress">
                    </div>
                    <div class="mb-3">
                        <label for="createUserContact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="createUserContact" name="createUserContact">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    $(".edit-user").click(function() {
        var userId = $(this).data("id");
        $.ajax({
            url: "../get_details/get_user_details.php",
            method: "POST",
            data: { user_id: userId },
            dataType: "json",
            success: function(response) {
                // Populate form fields with user details
                $("#editUserId").val(response.user_id);
                $("#editUserName").val(response.user_name);
                $("#editUserType").val(response.user_type);
                $("#editUserEmail").val(response.user_email);
                $("#editUserAddress").val(response.user_address);
                $("#editUserContact").val(response.user_contact);
                // Show modal containing the form
                $('#editUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $("#editUserForm").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        // Get form data
        var formData = $(this).serialize();
        // Send AJAX request to update user data
        $.ajax({
            url: "../Update_function/update_user.php",
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
    $(".delete-user").click(function() {
            var userId = $(this).data("id");
            // Confirm deletion
            if (confirm("Are you sure you want to delete this user?")) {
                // Send AJAX request to delete user
                $.ajax({
                    url: "../Delete_function/delete_user.php",
                    method: "POST",
                    data: { user_id: userId },
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
        var searchTerm = $("#searchInput").val(); // Get the value of the search input
        $.ajax({
            url: "../search_function/search_user.php", // PHP script to handle the search operation
            method: "POST",
            data: { search_term: searchTerm }, // Send the search term to the PHP script
            dataType: "html", // Expect HTML response
            success: function(response) {
                // Replace the table body with the filtered data
                $("tbody").html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    // Show create user modal when the create button is clicked
    $(".create-user").click(function() {
        $('#createUserModal').modal('show');
    });

    // Handle form submission to create a new user
    $("#createUserForm").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        // Get form data
        var formData = $(this).serialize();
        // Send AJAX request to create a new user
        $.ajax({
            url: "../Create_function/create_user.php",
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
});

</script>