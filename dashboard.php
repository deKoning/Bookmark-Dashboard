<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Bookmarks</h1>
    <div class="row row-cols-1 row-cols-md-4">
        <?php
        include('database.php'); // Include the database configuration

        // Retrieve bookmarks from the database
        $query = "SELECT * FROM bookmarks";
        $result = $db->query($query);

        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Bookmark Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">
                                <a href="<?php echo $row['url']; ?>" target="_blank" class="card-link"><?php echo $row['url']; ?></a>
                            </p>
                            <p class="card-text"><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
                            
                            <!-- Icon Container -->
                            <div class="icon-container d-flex justify-content-between mt-auto">
                                <!-- Delete Icon -->
                                <i class="fas fa-trash-alt delete-icon delete-btn" data-toggle="modal" data-target="#confirmDeleteModal" data-cardid="<?php echo $row['id']; ?>"></i>
                                <!-- Edit Icon -->
                                <a href="edit.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit edit-icon"></i></a>
                            </div>
                            
                            <!-- 
                            Delete Button
                            <button class="btn btn-danger delete-btn mt-auto" data-toggle="modal" data-target="#confirmDeleteModal" data-cardid="<?php echo $row['id']; ?>">Delete</button>
                            Edit Button
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary edit-btn">Edit</a>
                            -->
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p>No bookmarks found.</p>';
        }
        ?>
    </div>
    <a href="add_bookmark.php" class="btn btn-primary">Add Bookmark</a>
</div>

<!-- Confirmation Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this bookmark?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirm-delete-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        var cardIdToDelete; // Variable to store the card ID to be deleted

        // When the delete button is clicked, store the card ID and show the confirmation modal
        $('.delete-btn').click(function() {
            cardIdToDelete = $(this).data('cardid');
        });

        // When the confirmation modal's confirm button is clicked, perform the delete action
        $('.confirm-delete-btn').click(function() {
            if (cardIdToDelete !== undefined) {
                // Perform the delete action here
                // You can use AJAX to send a request to delete the card from the database
                // Once deleted, you can remove the card from the UI
                // Here, we'll simply remove the card from the UI
                $('[data-cardid="' + cardIdToDelete + '"]').closest('.col').remove();
                $('#confirmDeleteModal').modal('hide');
                cardIdToDelete = undefined; // Reset the card ID
            }
        });
    });
</script>

<!-- JavaScript for Delete -->
<script>
    $(document).ready(function() {
        var cardIdToDelete; // Variable to store the card ID to be deleted

        // When the delete button is clicked, store the card ID and show the confirmation modal
        $('.delete-btn').click(function() {
            cardIdToDelete = $(this).data('cardid');
        });

        // When the confirmation modal's confirm button is clicked, perform the delete action
        $('.confirm-delete-btn').click(function() {
            if (cardIdToDelete !== undefined) {
                // Send an AJAX request to delete the data from the database
                $.ajax({
                    url: 'delete.php', // Create a separate PHP script for deletion (e.g., delete.php)
                    method: 'POST',
                    data: { cardId: cardIdToDelete },
                    success: function(response) {
                        if (response === 'success') {
                            // Data deleted successfully, remove the card from the UI
                            $('[data-cardid="' + cardIdToDelete + '"]').closest('.col').remove();
                            $('#confirmDeleteModal').modal('hide');
                            cardIdToDelete = undefined; // Reset the card ID
                        } else {
                            // Handle deletion failure, show an error message or log it
                            alert('Error deleting the card.');
                        }
                    }
                });
            }
        });
    });
</script>


<!-- Include Bootstrap JS (usually placed at the end of the page) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</script>

</body>
</html>