<?php
    session_start();
    error_reporting(0);
    $logout = $_SESSION['logout'];
    $user_id = $_SESSION['user_id'];

    $db = mysqli_connect("127.0.0.1","root","root","db7");

    $tableQuery = "SELECT * FROM users WHERE id = $user_id";
    $tableResults = mysqli_query($db,$tableQuery);
    $tableRows = mysqli_num_rows($tableResults);

    $row = mysqli_fetch_assoc($tableResults);
    $name = $row['name'];
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

label, p, h1 {
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>

    <?php
        print "<h1>Welcome: $name!</h1>";
    ?>

    <div id="large-container">
        <form method="post" class="inner-containers" id="inner-container">
            <div class="inputs">
                <input type="submit" onclick="submitForm('home.php')" value="Home" class="btn">
                <input type="submit" onclick="submitForm('profile.php')" value="Profile" class="btn">
                <input type="submit" onclick="submitForm('logout.php')" value="Logout" class="btn">
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function submitForm(action) {
          var form = document.getElementById('inner-container');
          form.action = action;
          form.submit();
        }
      </script>

</body>
</html>