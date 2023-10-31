<!-- PHP code to establish connection with the localserver -->
<?php

// username is root
$user = 'root';
$password = '';

// Database name is emall
$database = 'eshoping';

// Server is localhost with port number 3306

$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

// checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}

// SQL query to select data from database
// Table name is also emall
$sql = "SELECT * FROM product_for_sale WHERE STATUS = 'pending'";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eMALL Online Shopping</title>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }

        td {
            background-color: #E4F5D4;
        }

        th,
        td {
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
        }

        td {
            font-weight: lighter;
        }

        section {
            background-color: pink;
            width: 800px;
            border-radius: 3px;
            padding-bottom: 50px;
        }
    </style>
</head>
<body>
    <section>
        <h1 id="head">eMALL Products</h1>
        <table>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity Available</th>
                <th scope="col">Price</th>
            </tr>
            <?php
                while($rows = $result->fetch_assoc()) {
            ?>
            <tr class="items" data-productid="<?php echo $rows['product_id']; ?>">
                <td class="product-id"><?php echo $rows['product_id']; ?></td>
                <td><?php echo $rows['Product_name']; ?></td>
                <td><?php echo $rows['Quantity']; ?></td>
                <td class="price"><?php echo $rows['price']; ?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
<form action="approve.php" method="post">
    <label for="productid">Product ID</label>
    <input type="number" name="productid" id="productid"><br>
    <input type="submit" name="action" value="approve"/>
    <input type="submit" name="action" value="reject"/>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productRows = document.querySelectorAll(".items");

        productRows.forEach(function (row) {
            row.addEventListener("click", function () {
                const productId = row.querySelector(".product-id").textContent;
                document.getElementById("productid").value = productId;
            });
        });
    });
</script>
</html>
