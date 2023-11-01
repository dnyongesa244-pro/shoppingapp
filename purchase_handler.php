<?php
// Establish a database connection here
$user = 'root';
$password = '';
$database = 'eshoping';
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
    $insert_sql = "INSERT INTO sold_items (product_id, product_name, quantity, price) VALUES ($product_id, '$product_name', $quantity, $price)";
    
    if ($mysqli->query($insert_sql)) {
        // Successfully inserted into the 'sold_items' table

        // Now, let's update the 'product_for_sale' table with the remaining quantity
        // First, retrieve the current quantity from the 'product_for_sale' table
        $select_sql = "SELECT quantity FROM product_for_sale WHERE product_id = $product_id";
        $result = $mysqli->query($select_sql);

        if ($result && $row = $result->fetch_assoc()) {
            // Calculate the remaining quantity
            $current_quantity = $row['quantity'];
            $remaining_quantity = $current_quantity - $quantity;
            
            // Update the 'product_for_sale' table
            $update_sql = "UPDATE product_for_sale SET quantity = $remaining_quantity WHERE product_id = $product_id";

            if ($mysqli->query($update_sql)) {
                // Successfully updated the 'product_for_sale' table
                // Redirect to a confirmation page
                header("Location: confirmation.html");
                exit();
            } else {
                echo "Error updating product_for_sale: " . $mysqli->error;
            }
        } else {
            echo "Error retrieving current quantity: " . $mysqli->error;
        }
    } else {
        echo "Error inserting into sold_items: " . $mysqli->error;
    }
}
?>
