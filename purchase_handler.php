<?php
// Establish a database connection here
$user = 'root';
$password = '';

// Database name is emall
$database = 'eshoping';

// Server is localhost with port number 3306

$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_POST['confirm'])) {
    // Retrieve data from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Insert purchase details into the 'sold_items' table
    $sql = "INSERT INTO sold_items (product_id, product_name, quantity, price) VALUES ('$product_id', '$product_name', '$quantity', '$price')";
    
    if ($mysqli->query($sql)) {
        // Successfully inserted into the database
        // Redirect to a confirmation page
        header("Location: confirmation.html");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
