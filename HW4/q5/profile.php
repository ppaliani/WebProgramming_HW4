<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $db = mysqli_connect("127.0.0.1","root","root","db8");

    $tableQuery = "SELECT * FROM users WHERE id = $user_id";
    $tableResults = mysqli_query($db,$tableQuery);
    $tableRows = mysqli_num_rows($tableResults);

    $row = mysqli_fetch_assoc($tableResults);
    $id = $row['id'];
    $pwd = $row['pwd'];
    $name = $row['name'];
    $address = $row['address'];
    $card = $row['card'];
?>

<html lang="en">
<style>

body {
    background-color: rgb(14, 15, 59);
    font-family: 'Poppins', sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#large-container {
    width: 10vw;
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

label, p, h1 {
    color: aliceblue;
}

.inputs {
    margin: 10px;
}

#form-container {
    border: solid 2px aliceblue;
    border-radius: 8px;
    margin: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#outer-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

table#inner-container {
    color: aliceblue;
    margin: 15px;
}

.info {
    margin: 10px;
}

h2 {
    margin: 0px;
    margin-top: 15px;
    color: aliceblue;
}

</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

    <?php
        print "<h1>Welcome: $name!</h1>";
    ?>

    <div id="form-container">
        <h2>User Info:</h2>
        <form method="post" action="home.php" id="outer-container">
            <table id="inner-container">
                <tr class='info'>
                    <td><label for='user_id'>User ID:</label></td>
                    <?php
                        print "<td><input name='user_id' id='user_id' Value='$id' autocomplete='off' readonly></td>";
                    ?>
                </tr>
                <tr class='info'>
                    <td><label for='password'>Password:</label></td>
                    <?php
                        print "<td><input name='password' id='password' Value='$pwd' autocomplete='off'></td>";
                    ?>
                </tr>
                <tr class='info'>
                    <td><label for='name'>Name:</label></td>
                    <?php
                        print "<td><input name='name' id='name' Value='$name' autocomplete='off'></td>";
                    ?>
                </tr>
                <tr class='info'>
                    <td><label for='address'>Address:</label></td>
                    <?php
                        print "<td><input name='address' id='address' Value='$address' autocomplete='off'></td>";
                    ?>
                </tr>
                <tr class='info'>
                    <td><label for='card'>Credit Card:</label></td>
                    <?php
                        print "<td><input name='card' id='card' Value='$card' autocomplete='off'></td>";
                    ?>
                </tr>
            </table>
            <input type='submit' value='Submit' class='btn'>
        </form>
    </div>

    <div id="large-container">
        <form method="post" class="inner-containers" id="form" action='home.php'>
            <input type="submit" value="Home" class="btn">
        </form>
    </div>
</body>
</html>