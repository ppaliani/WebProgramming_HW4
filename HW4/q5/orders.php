<?php
    session_start();
    // error_reporting(0);
    $db = mysqli_connect("127.0.0.1","root","root","db8");
    $user_id = $_SESSION['user_id'];

    $orderQuery = "SELECT * FROM orders WHERE userID = $user_id";
    $orderResults = mysqli_query($db,$orderQuery);
    $orderRows = mysqli_num_rows($orderResults);

    $id_array = array();
    $name_array = array();
    $price_array = array();
?>

<html>
<head>
    <title>Order Confirmation</title>
</head>
<style>

body {
    background-color: rgb(14, 15, 59);
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
}

.inner-containers {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 15px;
    border: solid 2px aliceblue;
    border-radius: 10px;
}

.btn {
    padding: 5px;
    border: solid rgb(125, 113, 255) 3px;
    border-radius: 5px;
}

.btn:hover {
    cursor: pointer;
    background-color: rgb(198, 198, 198);
}

table#info-table {
    border-collapse: collapse;
}

table {
    margin: 20px;
}

label, p, th, h1, td {
    color: aliceblue;
}

td, th {
    border: dashed 2px aliceblue;
    padding: 10px;
}

#smallest-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}
    
</style>
<body>
    <div id='large-container'>
        <div class='inner-containers'>
            <h1>Orders for User: <?php 
                $nameQuery = "SELECT * FROM users WHERE id = $user_id";
                $nameResults = mysqli_query($db,$nameQuery);
                $row = mysqli_fetch_assoc($nameResults);
                $name = $row['name'];
                print "$name"; ?></h1>
            <div id='smallest-container'>
                <table id='info-table'>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Shipped</th>
                    </tr>
                    <?php
                        for ($i = 0; $i < $orderRows; $i++) {
                            $row = mysqli_fetch_assoc($orderResults);
                            $orderID = $row['orderID'];
                            $userID = $row['userID'];
                            $itemID = $row['itemID'];
                            $quantity = $row['quantity'];
                            if ($row['shipped']==1) {
                                $shipped = "Yes";
                            } else {
                                $shipped = "No";
                            }

                            $itemNameQuery = "SELECT * FROM items WHERE id = $itemID";
                            $itemNameResults = mysqli_query($db, $itemNameQuery);
                            $row = mysqli_fetch_assoc($itemNameResults);
                            $item_name = $row['name'];
                            $price = $row['price'];
                            $total = $price * $quantity;

                            print "
                                <tr>
                                    <td>$item_name</td>
                                    <td>$$price.00</td>
                                    <td>$quantity</td>
                                    <td>$$total.00</td>
                                    <td>$shipped</td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>
        <form method="post" id="form" action='home.php'>
            <input type="submit" value="Home" class="btn">
        </form>
        </div>
    </div>



</body>
</html>