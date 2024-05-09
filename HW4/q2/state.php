<?php
    $status = $_POST['grad_status'];
    setcookie("status",$status);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Q2</title>
</head>
<body>
    <div id="large-container">

        <form method="post" action="calculate.php" id="inner-container">
            <h1 align="center">University Cost Calculator</h1>

            <div class="center" id="state_status">
                <input type="radio" name="state_status" value="In State" id="in-state" checked="checked"><p>In State</p>
                <input type="radio" name="state_status" value="Out of State" id="out-state"><p>Out of State</p>
            </div>
            <div>
                <button type="submit" class="btn">Next</button>
            </div>
        </form>
    </div>
</body>
</html>