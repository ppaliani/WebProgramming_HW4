<?php
    session_start();
    $db = mysqli_connect("127.0.0.1","root","root","db8");

    $passcodeQuery = "SELECT * FROM passcode";
    $passcodeResults = mysqli_query($db,$passcodeQuery);
    $row = mysqli_fetch_assoc($passcodeResults);
    $passcode = $row['passcode'];

    if (isset($_POST['passcode'])) {
        $passcode_entered = $_POST['passcode'];
    }

    if (isset($_POST['options'])) {
        $option = $_POST['options'];
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Home</title>
</head>
<style>

    body {
        background-color: rgb(14, 15, 59);
        font-family: 'Poppins', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
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

    #outer-container {
        width: 100vw;
    }

    #form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    table {
        border: solid 2px aliceblue;
        border-radius: 10px;
        padding: 25px;
    }

    tr {
        margin: 10px 0px;
    }

    td, th {
        color: aliceblue;
        padding: 5px;
    }

    div#error-msg {
        border: solid 2px red;
        border-radius: 8px;
        padding: 10px;
    }

    div#error-msg > p {
        color: red;
    }

    #table-container {
        display: flex;
        justify-content: center;
        flex-direction: column;
        margin: 10px;
    }

    #results-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    p {
        color: aliceblue;
    }

</style>
<body>
    <div id="outer-container">
        <form method="post" id="form" action="store.php">
            <table>
                <tr>
                    <th align="center">Options</th>
                    <th align="center" colspan="2">Actions</th>
                </tr>
                <tr>
                    <td><label for="users">Display all users:</label></td>
                    <td><input type="radio" name="options" group="options" value="users"></td>
                </tr>
                <tr>
                    <td><label for="items">Display all items:</label></td>
                    <td><input type="radio" name="options" group="options" value="items"></td>
                </tr>
                <tr>
                    <td><label for="orders">Display all orders</label></td>
                    <td><input type="radio" name="options" group="options" value="orders"></td>
                </tr>
                <tr>
                    <td><label for="not_shipped">Display non-shipped orders</label></td>
                    <td><input type="radio" name="options" group="options" value="not_shipped"></td>
                </tr>
                <tr>
                    <td rowspan="2"><label for="ship">Ship an order:</label></td>
                    <td><input type="radio" name="options" group="options" value="ship"></td>
                </tr>
                <tr>
                    <td><input type="text" name="orderID" autocomplete="off" placeholder="OrderID"></td>
                </tr>
                <tr>
                    <td rowspan="2"><label for="add_item">Add an item:</label></td>
                    <td><input type="radio" name="options" group="options" value="add_item"></td>
                </tr>
                <tr>
                    <td><input type="text" name="itemID" autocomplete="off" placeholder="Item ID"></td>
                    <td><input type="text" name="itemName" autocomplete="off" placeholder="Item Name"></td>
                    <td><input type="text" name="itemPrice" autocomplete="off" placeholder="Item Price"></td>
                </tr>
                <tr>
                    <td rowspan="2"><label for="remove_item">Remove an item:</label></td>
                    <td><input type="radio" name="options" group="options" value="remove_item"></td>
                </tr>
                <tr>
                    <td><input type="text" name="item_ID" autocomplete="off" placeholder="Item ID"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Submit" class="btn"></td>
                    <td colspan="2"><input type="text" name="passcode" placeholder="Passcode" autocomplete='off'></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="results-container">
    <?php

        if (!isset($_POST['options'])) {
            print "
            <div id='error-msg'>
                <p>No option chosen! Please try again</p>
            </div>
        ";
        } else if (!isset($_POST['passcode']) || $_POST['passcode'] == "" || $passcode_entered != $passcode) {
            print "
                <div id='error-msg'>
                    <p>Incorrect passcode entered! Please try again.</p>
                </div>
            ";
        } else {
            if ($option == 'users') {
                $usersQuery = "SELECT * FROM users";
                $userResults = mysqli_query($db, $usersQuery);
                $usersRows = mysqli_num_rows($userResults);
    
                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Card</th>
                        </tr>
                ";

                for ($i = 0; $i < $usersRows; $i++) {
                    $row = mysqli_fetch_assoc($userResults);
                    $id = $row['id'];
                    $name = $row['name'];
                    $address = $row['address'];
                    $card = $row['card'];
    
                    print "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$address</td>
                            <td>$card</td>
                        </tr>
                    ";
                }

                print "
                    </table>
                </div>
                ";
            }

            if ($option == 'items') {
                $Query = "SELECT * FROM items";
                $Results = mysqli_query($db, $Query);
                $Rows = mysqli_num_rows($Results);
    
                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
    
                    print "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$price</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";
            }

            if ($option == 'orders') {
                $Query = "SELECT * FROM orders";
                $Results = mysqli_query($db, $Query);
                $Rows = mysqli_num_rows($Results);

                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Shipped</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $id = $row['orderID'];
                    $userID = $row['userID'];
                    $itemID = $row['itemID'];
                    $quantity = $row['quantity'];

                    if ($row['shipped'] == 0) {
                        $shipped = "No";
                    } else {
                        $shipped = "Yes";
                    }

                    $nameQuery = "SELECT * FROM users WHERE id = $userID";
                    $nameResults = mysqli_query($db,$nameQuery);
                    $nameRows = mysqli_num_rows($nameResults);

                    $nameRow = mysqli_fetch_assoc($nameResults);
                    $name = $nameRow['name'];

                    $itemQuery = "SELECT * FROM items WHERE id = $itemID";
                    $itemResults = mysqli_query($db,$itemQuery);
                    $itemRows = mysqli_num_rows($itemResults);

                    $itemRow = mysqli_fetch_assoc($itemResults);
                    $itemName = $itemRow['name'];
                    $price = $itemRow['price'];

                    $total = $quantity * $price;
                    print "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$itemName</td>
                            <td>$quantity</td>
                            <td>$$total.00</td>
                            <td>$shipped</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";
            }

            if ($option == 'not_shipped') {
                $Query = "SELECT * FROM orders WHERE shipped = '0'";
                $Results = mysqli_query($db, $Query);
                $Rows = mysqli_num_rows($Results);

                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>Card</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $id = $row['orderID'];
                    $userID = $row['userID'];
                    $itemID = $row['itemID'];
                    $quantity = $row['quantity'];

                    $nameQuery = "SELECT * FROM users WHERE id = $userID";
                    $nameResults = mysqli_query($db,$nameQuery);
                    $nameRows = mysqli_num_rows($nameResults);

                    $nameRow = mysqli_fetch_assoc($nameResults);
                    $name = $nameRow['name'];
                    $address = $nameRow['address'];
                    $card = $nameRow['card'];

                    $itemQuery = "SELECT * FROM items WHERE id = $itemID";
                    $itemResults = mysqli_query($db,$itemQuery);
                    $itemRows = mysqli_num_rows($itemResults);

                    $itemRow = mysqli_fetch_assoc($itemResults);
                    $itemName = $itemRow['name'];
                    $price = $itemRow['price'];

                    $total = $quantity * $price;

                    print "
                        <tr>
                            <td>$id</td>
                            <td>$itemName</td>
                            <td>$quantity</td>
                            <td>$$total.00</td>
                            <td>$name</td>
                            <td>$address</td>
                            <td>$card</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";
            }

            if ($option == 'ship') {
                $orderID = $_POST['orderID'];

                $Query = "UPDATE `orders` SET `shipped`='1' WHERE `orderID`=$orderID";
                mysqli_query($db, $Query);

                $orderQuery = "SELECT * FROM orders WHERE orderID = $orderID";
                $Results = mysqli_query($db,$orderQuery);
                $Rows = mysqli_num_rows($Results);

                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Item ID</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Shipped</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $orderID = $row['orderID'];
                    $userID = $row['userID'];
                    $itemID = $row['itemID'];
                    $quantity = $row['quantity'];

                    if ($row['shipped'] == 0) {
                        $shipped = "No";
                    } else {
                        $shipped = "Yes";
                    }

                    $nameQuery = "SELECT * FROM users WHERE id = $userID";
                    $nameResults = mysqli_query($db,$nameQuery);
                    $nameRows = mysqli_num_rows($nameResults);

                    $nameRow = mysqli_fetch_assoc($nameResults);
                    $name = $nameRow['name'];
                    $address = $nameRow['address'];
                    $card = $nameRow['card'];

                    $itemQuery = "SELECT * FROM items WHERE id = $itemID";
                    $itemResults = mysqli_query($db,$itemQuery);
                    $itemRows = mysqli_num_rows($itemResults);
                    $itemRow = mysqli_fetch_assoc($itemResults);
                    $price = $itemRow['price'];

                    $total = $quantity * $price;

                    print "
                        <tr>
                            <td>$orderID</td>
                            <td>$userID</td>
                            <td>$itemID</td>
                            <td>$quantity</td>
                            <td>$$total.00</td>
                            <td>$shipped</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";
            }

            if ($option == 'add_item') {
                $itemID = $_POST['itemID'];
                $itemName = $_POST['itemName'];
                $itemPrice = $_POST['itemPrice'];

                $Query = "INSERT INTO `items`(`id`, `name`, `price`) VALUES ('$itemID','$itemName','$itemPrice')";
                mysqli_query($db, $Query);

                $orderQuery = "SELECT * FROM items WHERE id = $itemID";
                $Results = mysqli_query($db,$orderQuery);
                $Rows = mysqli_num_rows($Results);

                print "
                <div id='table-container'>
                    <table id='info-table'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $item_ID = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];

                    print "
                        <tr>
                            <td>$item_ID</td>
                            <td>$name</td>
                            <td>$$price.00</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";
            }

            if ($option == 'remove_item') {
                $itemID = $_POST['item_ID'];

                $Query = "DELETE FROM `items` WHERE id ='$itemID'";

                $orderQuery = "SELECT * FROM items WHERE id ='$itemID'";
                $Results = mysqli_query($db,$orderQuery);
                $Rows = mysqli_num_rows($Results);

                print "
                <div id='table-container'>
                    <p><strong>The selected item has been removed.</strong></p>
                    <table id='info-table'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                ";

                for ($i = 0; $i < $Rows; $i++) {
                    $row = mysqli_fetch_assoc($Results);
                    $item_ID = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];

                    print "
                        <tr>
                            <td>$item_ID</td>
                            <td>$name</td>
                            <td>$$price.00</td>
                        </tr>
                    ";
    
                }
                print "
                    </table>
                </div>    
                ";

                mysqli_query($db, $Query);
            }
        }
    ?>
    </div>
</body>
</html>