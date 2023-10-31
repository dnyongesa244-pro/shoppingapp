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
        const price = document.querySelectorAll("#price");

        text = document.createTextNode("Buy");
        let button = document.createElement('button');
        button.textContent = 'Buy';
        button.className = "buy";
        button.style.color = 'green';
        button.style.fontSize = '25px';
        button.style.borderRadius = '3px';
        button.style.border = '1px solid green';
        button.style.backgroundColor = 'lightgrey';
        button.style.marginTop = '5px';
        button.style.marginLeft = '25%';
        button.setAttribute('type', 'submit');


        const trow = document.querySelectorAll(".items");
        trow.forEach((rows) => {
            rows.addEventListener('click', (ele)=> {
                document.body.appendChild(button);
                const btn = document.querySelector('.buy');
                btn.onclick = ()=>{
                    // NB REPLACE TEXT addproduct.html with another
                    // I guess it should redirect to a form where user enters product quantity to buy
                    // on clicking the button it currently redirects to a random webpage
                    // location.href = 'addproduct.html';
                    location.href ='https://stackoverflow.com/questions/16562577/how-can-i-make-a-button-redirect-my-page-to-another-page'
                }
                btn.addEventListener('mouseover', ()=>{
                    btn.style.backgroundColor = 'lightgreen';
                })
                btn.addEventListener('mouseout', ()=>{
                    btn.style.backgroundColor = 'lightgrey';
                })
            })
            rows.addEventListener('dblclick', ()=>{
                document.body.removeChild(button);
            })
        })

    </script>
</body>
</html>

