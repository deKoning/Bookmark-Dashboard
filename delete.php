<?php
include('database.php'); // Include the database configuration

if (isset($_POST['cardId'])) {
    $cardIdToDelete = $_POST['cardId'];

    // Perform the deletion in the database
    $query = "DELETE FROM bookmarks WHERE id = :cardId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cardId', $cardIdToDelete, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        echo 'success'; // Send a success response back to the AJAX request
    } else {
        echo 'error'; // Send an error response if deletion fails
    }
}
