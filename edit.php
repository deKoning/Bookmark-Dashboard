<?php
include('database.php'); // Include the database configuration

if (isset($_GET['id'])) {
    $bookmarkId = $_GET['id'];

    // Retrieve the bookmark details from the database
    $query = "SELECT * FROM bookmarks WHERE id = $bookmarkId";
    $result = $db->query($query);

    if ($result) {
        $row = $result->fetchArray(SQLITE3_ASSOC);

        if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $url = $_POST['url'];
            $tags = $_POST['tags'];

            // Handle image upload or removal
            $image = $row['image'];
            if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
                // Check if a new image was uploaded
                $imageTempName = $_FILES['new_image']['tmp_name'];
                $imageExtension = pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION);
                $imageFileName = uniqid('image_') . '.' . $imageExtension;
                $imageDestination = 'uploads/' . $imageFileName;

                // Move the uploaded image to a folder (e.g., "uploads")
                move_uploaded_file($imageTempName, $imageDestination);

                // Update the image path in the database
                $image = $imageDestination;
            } elseif (isset($_POST['remove_image'])) {
                // Check if the remove image checkbox is checked
                // Remove the image from the folder and update the image path in the database
                unlink($image);
                $image = null; // Set image to null to remove it from the database
            }

            // Perform the update action here (e.g., using SQL UPDATE statement)
            $updateQuery = "UPDATE bookmarks SET name = '$name', url = '$url', tags = '$tags', image = '$image' WHERE id = $bookmarkId";
            $db->exec($updateQuery);

            // Redirect back to the dashboard
            header('Location: dashboard.php');
            exit;
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Bookmark</title>
            <!-- Include Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <!-- Include your custom CSS -->
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <div class="container">
                <h1>Edit Bookmark</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?php echo $row['url']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags:</label>
                        <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $row['tags']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="new_image">New Image:</label>
                        <input type="file" class="form-control-file" id="new_image" name="new_image">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image">
                        <label class="form-check-label" for="remove_image">Remove Current Image</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
            <!-- Include Bootstrap JS (usually placed at the end of the page) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }
}
?>
