<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Details</title>
</head>
<body>
    <h1>Purchase Details</h1>
    <p>Product ID: <?php echo $_GET['product_id']; ?></p>
    <p>Product Name: <?php echo $_GET['product_name']; ?></p>
    <p>Quantity: <?php echo $_GET['quantity']; ?></p>
    <p>Total Price: $<?php echo $_GET['total_price']; ?></p>

    <form action="purchase_handler.php" method="post">
       <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
       <input type="hidden" name="product_name" value="<?php echo $_GET['product_name']; ?>"> <!-- Add this line -->
       <input type="hidden" name="quantity" value="<?php echo $_GET['quantity']; ?>">
       <input type="hidden" name="price" value="<?php echo $_GET['total_price']; ?>"> <!-- Add this line -->
       <input type="submit" name="confirm" value="Confirm Purchase">
    </form>


    <form action="myindex.php">
        <input type="submit" value="Cancel">
    </form>
</body>
</html>
