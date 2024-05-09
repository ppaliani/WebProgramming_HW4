<?php
    session_start();
    $db = mysqli_connect("127.0.0.1","root","root","db7");
    $user_id = $_SESSION['user_id'];

    date_default_timezone_set("America/Detroit");
    $last_visit = date("l h:i:s");

    $visitsQuery = "UPDATE `users` SET last = '$last_visit' WHERE id = $user_id";
    mysqli_query($db,$visitsQuery);

    session_destroy();

    header("Location: http://localhost:8000/in-class-demo/q4/login.html");
    exit();
?>

<html>
<head>
    <title>Logout</title>
</head>
<body>
    <?php
        print "<p>Last Visit: $last_visit</p>";
    ?>
</body>
</html>