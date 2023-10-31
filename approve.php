<?php
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['productid'];
            $action = $_POST['action'];
        
            // Assuming you have a database connection established already
            $servername = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'eshoping';
        
            $mysqli = new mysqli($servername, $user, $password, $database);
        
            if ($mysqli->connect_error) {
                die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
            }
        
            // Prepare and execute an SQL statement to update the status
            $status = ($action === 'approve') ? 'approved' : 'rejected';
            $updateSql = "UPDATE product_for_sale SET status = '$status' WHERE product_id = $productId";
        
            if ($mysqli->query($updateSql) === TRUE) {
                // The update was successful
                echo "Status updated successfully";
            } else {
                // An error occurred during the update
                echo "Error updating status: " . $mysqli->error;
            }
        
            // Close the database connection
            $mysqli->close();
        }
        
?>