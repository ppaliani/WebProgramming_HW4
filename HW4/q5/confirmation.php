<?php
    session_start();
    // error_reporting(0);
    $db = mysqli_connect("127.0.0.1","root","root","db8");

    $quantity_array = array();
    $item_array = array();
    $index_array = array();

    $itemQuery = "SELECT * FROM items";
    $itemResults = mysqli_query($db,$itemQuery);
    $itemRows = mysqli_num_rows($itemResults);

    $id_array = array();
    $name_array = array();
    $price_array = array();

    for ($i = 0; $i < $itemRows; $i++) {
        $row = mysqli_fetch_assoc($itemResults);
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $id_array[$i] = $id;
        $name_array[$i] = $name;
        $price_array[$i] = $price;
    }

    $count = 0;

    if ($_POST['quantity1'] != "") {
        $quantity1 = $_POST['quantity1'];
        array_push($quantity_array,$quantity1);
    }
    if ($_POST['quantity2'] != "") {
        $quantity2 = $_POST['quantity2'];
        array_push($quantity_array,$quantity2);
    }
    if ($_POST['quantity3'] != "") {
        $quantity3 = $_POST['quantity3'];
        array_push($quantity_array,$quantity3);
    }
    if ($_POST['quantity4'] != "") {
        $quantity4 = $_POST['quantity4'];
        array_push($quantity_array,$quantity4);
    }
    if ($_POST['quantity5'] != "") {
        $quantity5 = $_POST['quantity5'];
        array_push($quantity_array,$quantity5);
    }
    if ($_POST['quantity6'] != "") {
        $quantity6 = $_POST['quantity6'];
        array_push($quantity_array,$quantity6);
    }
    if ($_POST['quantity7'] != "") {
        $quantity7 = $_POST['quantity7'];
        array_push($quantity_array,$quantity7);
    }
    if ($_POST['quantity8'] != "") {
        $quantity8 = $_POST['quantity8'];
        array_push($quantity_array,$quantity8);
    }
    if ($_POST['quantity9'] != "") {
        $quantity9 = $_POST['quantity9'];
        array_push($quantity_array,$quantity9);
    }
    if ($_POST['quantity10'] != "") {
        $quantity10 = $_POST['quantity10'];
        array_push($quantity_array,$quantity10);
    }

    if (isset($_POST['Hammer'])) {
        $hammer = $_POST['Hammer'];
        array_push($item_array,$hammer);
        array_push($index_array, array_search($hammer,$name_array));
    }
    if (isset($_POST['Screwdriver'])) {
        $screwdriver = $_POST['Screwdriver'];
        array_push($item_array,$screwdriver);
        array_push($index_array, array_search($screwdriver,$name_array));
    }
    if (isset($_POST['Wrench'])) {
        $wrench = $_POST['Wrench'];
        array_push($item_array,$wrench);
        array_push($index_array, array_search($wrench,$name_array));
    }
    if (isset($_POST['Drill'])) {
        $drill = $_POST['Drill'];
        array_push($item_array,$drill);
        array_push($index_array, array_search($drill,$name_array));
    }
    if (isset($_POST['Nail'])) {
        $nail = $_POST['Nail'];
        array_push($item_array,$nail);
        array_push($index_array, array_search($nail,$name_array));
    }
    if (isset($_POST['Screw'])) {
        $screw = $_POST['Screw'];
        array_push($item_array,$screw);
        array_push($index_array, array_search($screw,$name_array));
    }
    if (isset($_POST['Sandpaper'])) {
        $sandpaper = $_POST['Sandpaper'];
        array_push($item_array,$sandpaper);
        array_push($index_array, array_search($sandpaper,$name_array));
    }
    if (isset($_POST['Pen'])) {
        $pen = $_POST['Pen'];
        array_push($item_array,$pen);
        array_push($index_array, array_search($pen,$name_array));
    }
    if (isset($_POST['Pencil'])) {
        $pencil = $_POST['Pencil'];
        array_push($item_array,$pencil);
        array_push($index_array, array_search($pencil,$name_array));
    }
    if (isset($_POST['Sharpie'])) {
        $sharpie = $_POST['Sharpie'];
        array_push($item_array,$sharpie);
        array_push($index_array, array_search($sharpie,$name_array));
    }

    $user_id = $_SESSION['user_id'];

    $shipped_default = 0;
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
            <h1>Order Confirmed!</h1>
            <div id='smallest-container'>
                <table id='info-table'>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    $totalSum = 0;
                        for ($i = 0; $i < sizeof($item_array); $i++) {
                            $item_id = $id_array[$i];
                            $name = $item_array[$i];
                            $quantity = $quantity_array[$i];
                            $temp = $index_array[$i];
                            $queryIndex = $temp + 1;

                            $priceQuery = "SELECT * FROM items WHERE id = $queryIndex";
                            $priceResults = mysqli_query($db,$priceQuery);
                            $priceRows = mysqli_num_rows($priceResults);

                            $row = mysqli_fetch_assoc($priceResults);
                            $price = $row['price'];

                            $total = 0;
                            $total = $price * $quantity;
                            $totalSum = $totalSum + $total;
                            $orderQuery = "INSERT INTO `orders`(userID, itemID, quantity, shipped) VALUES ('$user_id','$item_id','$price',$shipped_default)";
                            mysqli_query($db,$orderQuery);
                            print "
                            <tr>
                                <td>$name</td>
                                <td>$$price.00</td>
                                <td>$quantity</td>
                                <td>$$total.00</td>
                            </tr>
                            ";
                        }
                    ?>
                </table>
                <table>
                    <tr>
                        <?php

                            $infoQuery = "SELECT * FROM users WHERE id = $user_id";
                            $infoResults = mysqli_query($db,$infoQuery);
                            $row = mysqli_fetch_assoc($infoResults);

                            $card = $row['card'];
                            $address = $row['address'];

                            print "
                                <td>Total Cost:</td>
                                <td><strong>$$totalSum.00</strong></td>
                                </tr>
                                <tr>
                                <td>Credit Card:</td>
                                <td><strong>$card</strong></td>
                                </tr>
                                <tr>
                                <td>Address:</td>
                                <td><strong>$address</strong></td>
                            ";
                        ?>
                    </tr>
                </table>
            </div>
        <form method="post" id="form" action='home.php'>
            <input type="submit" value="Home" class="btn">
        </form>
        </div>
    </div>



</body>
</html>