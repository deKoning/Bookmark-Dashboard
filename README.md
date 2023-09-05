# Bookmark Dashboard Web Application

The Bookmark Dashboard is a web application that allows users to save and manage their bookmarks. Users can add, view, edit, and delete bookmarks, each with a name, URL, tags, and an optional image.

![Bookmark Dashboard Screenshot](screenshot.png)

## Features

- **Add Bookmarks:** Easily add new bookmarks with a name, URL, tags, and an image.
- **View Bookmarks:** View all your saved bookmarks in a convenient dashboard layout.
- **Edit Bookmarks:** Edit existing bookmarks to update their information.
- **Delete Bookmarks:** Remove bookmarks you no longer need.

## Getting Started

These instructions will help you set up and run the Bookmark Dashboard web application on your local machine.

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) or similar web server software.
- A modern web browser.

### Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/dekoning/Bookmark-Dashboard.git

Start your XAMPP or web server and ensure it's running.

Copy the project files to your web server's document root (e.g., htdocs in XAMPP).

Create an SQLite database named database.db in the project folder.

Import the SQL schema to create the necessary tables:

bash

sqlite3 database.db < schema.sql

Open your web browser and navigate to http://localhost/bookmark-dashboard/dashboard.php to access the application.

Usage

    Add Bookmark: Click the "Add Bookmark" button on the dashboard to add a new bookmark.
    Edit Bookmark: Click the "Edit" icon on a card to edit its details.
    Delete Bookmark: Click the "Delete" icon on a card to delete it.

Customization

You can customize the application further by modifying the code and styles to match your preferences. The project structure is organized as follows:

    database.php: Configuration for the SQLite database.
    add_bookmark.php: Page for adding new bookmarks.
    edit.php: Page for editing existing bookmarks.
    dashboard.php: Main dashboard page to view and manage bookmarks.
    style.css: CSS styles for the application.
    js/script.js: JavaScript code for interactions (e.g., delete confirmation).

Contributing

Contributions are welcome! If you have ideas for improvements or new features, feel free to open an issue or submit a pull request.
License

This project is licensed under the MIT License - see the LICENSE file for details.
Acknowledgments

    This project was inspired by the need for a simple bookmark management solution.
