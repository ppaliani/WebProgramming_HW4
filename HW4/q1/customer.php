<?php
    $name = $_GET['name'];
    $address = $_GET['address'];
    setcookie("name",$name,time()+30*24*60*60);
    setcookie("address",$address,time()+30*24*60*60);
?>

<html>
<head>
    <title>Q1</title>
</head>
    <style>

        body {
            background-color: rgb(123, 106, 170);
            font-family: 'Poppins', sans-serif;
        }
        table {
            border: solid 2px #000;
            border-radius: 10px;
            padding: 15px;
        }

        td {
            padding: 5px;
        }

        #large-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 35vw;
            margin: auto;
        }

    </style>

<body>
    
    <div id="large-container">
        <table>
        <?php
            error_reporting(0);
            // Gathering variables
            $name = $_GET['name'];
            $card = $_GET['card'];
            $address = $_GET['address'];

            // Setting variables
            if (isset($_GET['burger'])) {
                $burger = 1;
            } else {
                $burger = 0;
            }

            if (isset($_GET['pizza'])) {
                $pizza = 1;
            } else {
                $pizza = 0;
            }

            if (isset($_GET['soda'])) {
                $soda = 1;
            } else {
                $soda = 0;
            }

            // Connecting to database
            $db = mysqli_connect("127.0.0.1","root","root","db5");

            // Loading orders table with customer information
            $updateQuery = "INSERT INTO orders(name,card,address,burger,pizza,soda)
                            VALUES ('$name','$card','$address','$burger','$pizza','$soda')";
            mysqli_query($db,$updateQuery);

            
            // Retreive order information to display to user
            $callbackQuery = "SELECT * FROM orders WHERE name = '$name' and card = '$card' and address = '$address'";
            $callbackResults = mysqli_query($db,$callbackQuery);
            $callbackRows = mysqli_num_rows($callbackResults);

            for ($i = 0; $i < $callbackRows; $i++) {
                $row = mysqli_fetch_assoc($callbackResults);

                $subtotal = 0;
                $name = $row['name'];
                $card = $row['card'];
                $address = $row['address'];

                if (($row['burger'])==1) {
                    $burger = "Yes";
                    $subtotal += 9.99;
                } else {
                    $burger = "No";
                }

                if (($row['pizza'])==1) {
                    $pizza = "Yes";
                    $subtotal += 11.99;
                } else {
                    $pizza = "No";
                }

                if (($row['soda'])==1) {
                    $soda = "Yes";
                    $subtotal += 1.99;
                } else {
                    $soda = "No";
                }

                $total = $subtotal * 1.06;
                $total = number_format((float)$total, 2, '.', '');

                print " <tr>
                            <th colspan='2'>Order Details:</th>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>$name</td>
                        </tr>
                        <tr>
                            <td>Card:</td>
                            <td>$card</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>$address</td>
                        </tr>
                        <tr>
                            <td>Burger:</td>
                            <td>$burger</td>
                        </tr>
                        <tr>
                            <td>Pizza:</td>
                            <td>$pizza</td>
                        </tr>
                        <tr>
                            <td>Soda:</td>
                            <td>$soda</td>
                        </tr>
                        <tr>
                            <td>Cost:</td>
                            <td>$$total</td>
                        </tr>
                        
                        ";


            }

        ?>

        </table>
        <div style="display: flex; align-items: center; flex-direction: column;">
            <h2>Your order is received! Thank you!</h2>
            <a href="http://localhost:8000/in-class-demo/q1/home.php">Return to online order</a>
        </div>
    </div>
</body>
</html>