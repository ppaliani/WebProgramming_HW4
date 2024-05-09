<?php
    $credits = $_POST['credits'];
    setcookie("credits",$credits);
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

        <form method="post" action="state.php" id="inner-container">
            <h1 align="center">University Cost Calculator</h1>

            <div class="center" id="grad_status">
                <input type="radio" name="grad_status" value="Undergraduate" id="undergrad" checked="checked"><p>Undergraduate</p>
                <input type="radio" name="grad_status" value="Graduate" id="grad"><p>Graduate</p>
            </div>
            <div>
                <button type="submit" class="btn">Next</button>
            </div>
        </form>
    </div>
</body>
</html>