<?php
$db = new SQLite3('database.db'); // Update the database file name
if (!$db) {
    die("Database connection failed: " . $db->lastErrorMsg());
}

// Create the "bookmarks" table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS bookmarks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    url TEXT NOT NULL,
    tags TEXT,
    image TEXT
)";
$db->exec($query);
?>
