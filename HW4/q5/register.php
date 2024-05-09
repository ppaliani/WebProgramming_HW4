<?php
    session_start();
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $card = $_POST['card'];
    $db = mysqli_connect("127.0.0.1","root","root","db8");
?>
<html>

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

label, p {
    color: aliceblue;
}

div#error-msg {
    border: solid 2px red;
}

div#error-msg > p {
    color: red;
}

.inputs {
    margin: 10px;
}

</style>
<head>
        <title>Register</title>
</head>
<body>
    

    <?php
    error_reporting(0);
    $idQuery = "SELECT id FROM users";
    $idResults = mysqli_query($db,$idQuery);
    $idRows = mysqli_num_rows($idResults);

    if ($idRows == 0) {
        $insertQuery = "INSERT INTO `users`(`id`, `pwd`, `name`, `address`, `card`) VALUES ('$user_id','$password','$name','$address','$card')";
        mysqli_query($db,$insertQuery);
        header("Location: http://localhost:8000/in-class-demo/q5/login.html");
        exit();
    }

    $id_array = array();
    
    for ($i = 0; $i <= $idRows; $i++) {
        $row = mysqli_fetch_assoc($idResults);
        $id = $row['id'];
        $id_array[$i] = $id;
    }

    if (!in_array($user_id, $id_array)) {
        $insertQuery = "INSERT INTO `users`(`id`, `pwd`, `name`, `address`, `card`) VALUES ('$user_id','$password','$name','$address','$card')";
        mysqli_query($db,$insertQuery);
        header("Location: http://localhost:8000/in-class-demo/q5/login.html");
        exit();
    }
    
    print "
    <div id='large-container'>
        <form method='post' class='inner-containers'>
            <div class='inputs'>
                <label for='user_id'>User ID: </label>
                <input type='text' name='user_id' id='user_id' autocomplete='off'>
            </div>
            <div class='inputs'>
                <label for='password'>Password: </label>
                <input type='text' name='password' id='password' autocomplete='off' value='$password'>
            </div>
            <div class='inputs'>
                <label for='name'>Name: </label>
                <input type='text' name='name' id='name' autocomplete='off' value='$name'>
            </div>
            <div class='inputs'>
                <label for='address'>Address: </label>
                <input type='text' name='address' id='address' autocomplete='off' value='$address'>
            </div>
            <div class='inputs'>
                <label for='card'>Card Number: </label>
                <input type='text' name='card' id='card' autocomplete='off' value='$card'>
            </div>
            <div class='inputs'>
                <input type='submit' onclick='submitForm('register.php')' value='Submit' class='btn'>
            </div>
        </form>
        <div class='inner-containers' id='error-msg'>
            <p><strong?>User ID already taken! Please choose a different user ID.</strong></p>
        </div>
    </div>

    <script type='text/javascript'>
        function submitForm(action) {
        var form = document.getElementById('inner-container');
        form.action = action;
        form.submit();
        }
    </script>";
    ?>

</body>
</html>