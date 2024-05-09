<html>
<head>
    <title>Q1</title>
</head>
    <style>

        body {
            background-color: rgb(123, 106, 170);
            font-family: 'Poppins', sans-serif;
        }

        #large-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 35vw;
            margin: auto;
        }

        #table-container {
            display: flex;
            justify-content: center;
            max-width: 80%;
            width: 50vh;
        }

        table {
            width: 100%;
        }

        td {
            border: 3px solid #000;
            border-radius: 10px;
            padding: 10px;
        }

        input#complete {

        }

        /* CSS */
        .button-27 {
            appearance: none;
            background-color: #000000;
            border: 2px solid #1A1A1A;
            border-radius: 15px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: Roobert,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            font-size: 16px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            min-height: 20px;
            min-width: 0;
            outline: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: 60%;
            will-change: transform;
        }

        .button-27:disabled {
            pointer-events: none;
        }

        .button-27:hover {
            box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
            transform: translateY(-2px);
        }

        .button-27:active {
            box-shadow: none;
            transform: translateY(0);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>

<body>
    
    <div id="large-container">
        <div id="table-container">
        <?php
            error_reporting(0);
            $db = mysqli_connect("127.0.0.1","root","root","db5");
            $id = $_GET['complete'];

            $deleteQuery = "DELETE FROM orders WHERE id = $id";
            $deleteResults = mysqli_query($db,$deleteQuery);

            // Display all orders:
            $ordersQuery = "SELECT * FROM orders";
            $orderResults = mysqli_query($db,$ordersQuery);
            $orderRows = mysqli_num_rows($orderResults);

            print " <table>
                        <tr>
                            <th>All Orders:</th>
                        </tr>
                        ";
            for ($i = 0; $i < $orderRows; $i++) {
                $row = mysqli_fetch_assoc($orderResults);
                $id = $row['id'];
                $name = $row['name'];
                $card = $row['card'];
                $address = $row['address'];
                $subtotal = 0;

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

                $total = 0;
                $total = $subtotal * 1.06;
                $total = number_format((float)$total, 2, '.', '');

            print "     <tr>
                            <td><strong>ID:</strong> $id<br><strong>Burger:</strong> $burger<br><strong>Pizza:</strong> $pizza<br>
                            <strong>Soda:</strong> $soda<br><strong>Name:</strong> $name<br><strong>Card:</strong> $card<br>
                            <strong>Address:</strong> $address<br><strong>Cost:</strong> $$total</td>
                        </tr>";
            }
            print "</table>";

        ?>
        </div>
        <br>
        <form method="get" action="update.php">
            <label for="complete"><strong>Complete Order:</strong></label>
            <input type="text" name="complete" placeholder="Enter order ID to complete" autocomplete="off" id="complete" required>
            <br>
            <button class="button-27" role="button">Submit</button>
        </form>

    </div>
</body>
</html>