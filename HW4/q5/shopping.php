<?php
    session_start();
    $db = mysqli_connect("127.0.0.1","root","root","db8");

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

?>

<html>
<head>
    <title>Shopping</title>
</head>
<style>

body {
    background-color: rgb(14, 15, 59);
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
}

#large-container {
    width: 20vw;
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

label, p, th {
    color: aliceblue;
}

#info-table {
    border: solid 2px aliceblue;
    border-radius: 8px;
    padding: 15px;
}
    
</style>
<body>

    <div id="table-container">
        <form method='post' id='form'>
            <table id="info-table">
                <tr>
                    <th>Items</th>
                    <th>Purchase</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php
                    $count = 0;
                    for ($i = 0; $i < sizeof($id_array); $i++) {
                        $count=$count+1;
                        print "
                        <tr>
                            <td><p>$name_array[$i]</p></td>
                            <td><input type='checkbox' name='$name_array[$i]' value='$name_array[$i]'></td>
                            <td><p>$$price_array[$i].00</p></td>
                            <td><input type='text' name='quantity$count' autocomplete='off' group='order'></td>
                        </tr>
                        ";
                    }
                ?>
                <tr align='center' id='btn-row'>
                    <td colspan='2'><input type='submit' onclick="submitForm('confirmation.php')" value='Submit' class='btn'></td>
                    <td colspan='2'><input type='submit' onclick="submitForm('home.php')" value='Home' class='btn'></td>
                </tr>
            </table>
        </form>
    </div>

    <script type="text/javascript">
        function submitForm(action) {
          var form = document.getElementById('form');
          form.action = action;
          form.submit();
        }
      </script>

</body>
</html>