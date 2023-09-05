<?php
include('database.php'); // Include the database configuration

// Retrieve bookmarks from the database
$query = "SELECT * FROM bookmarks";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JavaScript from CDN (jQuery and Popper.js are also required) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>
    <h1>Bookmarks</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>URL</th>
            <th>Tags</th>
            <th>Image</th>
        </tr>
        <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></td>
                <td><?php echo $row['tags']; ?></td>
                <td><img src="<?php echo $row['image']; ?>" width="100"></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Update the link to point to add_bookmark.php -->
    <a href="add_bookmark.php">Add Bookmark</a>

    <div class="container">
    <h1>Bookmarks</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Tags</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></td>
                    <td><?php echo $row['tags']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" width="100"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="add_bookmark.php" class="btn btn-primary">Add Bookmark</a>
</div>

<div class="container">
    <h1>Bookmarks</h1>
    <div class="row">
        <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Bookmark Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></p>
                        <p class="card-text"><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <a href="add_bookmark.php" class="btn btn-primary">Add Bookmark</a>
</div>


</body>
</html>
