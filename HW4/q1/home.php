<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Q1</title>
    
    
    <style>

        body {
            background-color: rgb(123, 106, 170);
            font-family: 'Poppins', sans-serif;
        }

        .large-container {
            display: flex;
            justify-content: center;
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
            margin: auto;
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

        #form {
            display: flex;
            justify-content: center;
            flex-direction: column;
            border: solid 3px #000;
            border-radius: 10px;
            padding: 10px;
        }

        table {
            margin: 10px;
        }

        .food-images {
            max-width: 10vw;
            border: solid 2px #000;
            border-radius: 5px;
        }

        td {
            width: 15vw;
        }

    </style>


</head>
<body>
    <div class="large-container">
        <form method="get" action="customer.php" id="form">
                <table>
                    <tr>
                        <td><label for="name">Enter Name:</label></td>
                        <?php
                            if (isset($_COOKIE["name"])) {
                                $name = $_COOKIE["name"];
                                print "<td><input type='text' name='name' autocomplete='off' value='$name' required></td>";
                            } else {
                                print "<td><input type='text' name='name' autocomplete='off' required></td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td><label for="card">Enter Credit Card Number:</label></td>
                        <td><input type="text" name="card" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><label for="address">Enter Address:</label></td>
                        <?php
                            if (isset($_COOKIE["address"])) {
                                $address = $_COOKIE["address"];
                                print "<td><input type='text' name='address' autocomplete='off' value='$address' required></td>";
                            } else {
                                print "<td><input type='text' name='address' autocomplete='off' required></td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td><img src="Assets/image-3-1024x684.png" alt="Hamburger" class="food-images"></td>
                        <td><img src="Assets/classic-cheese-pizza-FT-RECIPE0422-31a2c938fc2546c9a07b7011658cfd05.jpg" alt="Pizza" class="food-images"></td>
                        <td><img src="Assets/odessa-ukraine-20-january-2022-coca-cola-bott-2022-05-02-03-25-35-utc-scaled.jpg" alt="Soda" class="food-images"></td>
                    </tr>
                    <tr>
                        <td> <!-- $9.99 -->
                            <label for="burger">Burger</label>
                            <input type="checkbox" name="burger">
                            <span><i>$9.99</i></span>
                        </td>
                        <td> <!-- $11.99 -->
                            <label for="pizza">Pizza</label>
                            <input type="checkbox" name="pizza">
                            <span><i>$11.99</i></span>
                        </td>
                        <td> <!-- $1.99 -->
                            <label for="soda">Soda</label>
                            <input type="checkbox" name="soda">
                            <span><i>$1.99</i></span>
                        </td>
                    </tr>
                </table>
            <button type="submit" class="button-27" role="button">Submit</button>
        </form>
    </div>
</body>
</html>