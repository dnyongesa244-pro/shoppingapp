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
$sql = "SELECT * FROM product_for_sale WHERE STATUS = 'approved'";
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
            /* border: 1px solid black; */

        }
 
        th,
        td {
            font-weight: bold;
            /* border: 1px solid black; */
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
        }
 
        td {
            font-weight: lighter;
        }
        /* style the body */
        section{
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
        <!-- Table construction -->
        <table>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity Available</th>
                <th scope="col" >Price</th>
               <!-- <th scope="col">Image</th> -->
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // loop till end of data
                while($rows=$result->fetch_assoc())
                {
            ?>
            <!-- Product Name Quantity Price -->
            <tr class="items">
                <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                <td id="pid"><?php echo $rows['product_id'];?></td>
                <td><?php echo $rows['Product_name'];?></td>
                <td><?php echo $rows['Quantity'];?></td>
                <td id="price"><?php echo $rows['price'];?></td>
             <!--   <td><img src="<?php echo $rows['image']; ?>" alt="Product Image" width="100"></td> --> 
             <!--the above code not loading image as indended-->
            </tr>
            <?php
                }
            ?>
            
        </table>
        
    </section>
<script>
    const trow = document.querySelectorAll(".items");

    trow.forEach((rows) => {
        rows.addEventListener('click', () => {
            const productId = rows.querySelector("#pid").textContent;
            const productName = rows.querySelector("td:nth-child(2)").textContent;
            const availableQuantity = parseInt(rows.querySelector("td:nth-child(3)").textContent);
            const price = parseFloat(rows.querySelector("#price").textContent);

            // Ask the user if they want to buy the product
            const wantToBuy = confirm(`Do you want to buy ${productName}?`);

            if (wantToBuy) {
                // Ask for the quantity
                const quantity = prompt(`Enter the quantity of ${productName} you want to buy:`);

                if (quantity !== null && !isNaN(quantity) && quantity > 0) {
                    if (quantity <= availableQuantity) {
                        // Calculate the total price
                        const totalPrice = price * quantity;

                        // Construct the URL with product details
                        const url = `purchase.php?product_id=${productId}&product_name=${productName}&quantity=${quantity}&total_price=${totalPrice}`;

                        // Navigate to the next page
                        location.href = url;
                    } else {
                        alert(`Sorry, there are only ${availableQuantity} available for ${productName}.`);
                    }
                }
            }
        });
    });
</script>

</body>
</html>

