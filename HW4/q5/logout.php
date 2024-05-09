<?php
    session_start();
    $db = mysqli_connect("127.0.0.1","root","root","db8");
    $user_id = $_SESSION['user_id'];

    date_default_timezone_set("America/Detroit");
    $last_visit = date("l h:i:s");

    session_destroy();

    header("Location: http://localhost:8000/in-class-demo/q5/login.html");
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