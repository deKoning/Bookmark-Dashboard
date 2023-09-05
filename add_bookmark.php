<?php
include('database.php'); // Include the database configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $url = $_POST['url'];
    $tags = $_POST['tags'];

    // Upload image (you'll need to handle image uploading separately)
    $image = $_FILES['image']['name'];
    $image_path = 'uploads/' . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    // Insert data into the database
    $query = "INSERT INTO bookmarks (name, url, tags, image) VALUES ('$name', '$url', '$tags', '$image_path')";
    $db->exec($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JavaScript from CDN (jQuery and Popper.js are also required) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
    <h1>Add Bookmark</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="url">URL:</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags">
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="dashboard.php" class="btn btn-secondary">Go Back</a>
    </form>
</div>

</body>
</html>
