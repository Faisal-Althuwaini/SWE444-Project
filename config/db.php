<?php
// Database Connection Parameters
$host = 'localhost';
$dbname = 'bookstore_db';
$username = 'root';
$password = '';

try {

    // The connection string ("mysql:host=$host;dbname=$dbname;charset=utf8") specifies:
    //     mysql: The type of database being used.
    //     host=$host: The hostname of the database server.
    //     dbname=$dbname: The name of the database.
    //     charset=utf8: Specifies that UTF-8 character encoding should be used for the connection, which helps avoid issues with character encoding.
    //     The $username and $password variables are passed to authenticate the user.
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Echo to confirm connection success (for testing only)
    // echo "Connected successfully";
} catch (PDOException $e) {
    // Display an error message if connection fails
    die("Database connection failed: " . $e->getMessage());
}
?>
