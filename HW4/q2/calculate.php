<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Q11</title>
</head>

    <style>
        body {
            background-color: rgb(14, 15, 59);
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table, th, td {
            color: aliceblue;
            border-collapse: collapse;
            padding: 5px;
        }

        th, td {
            border: solid 2px #FFF;
        }

        h1, h2 {
            color: aliceblue;
        }

    </style>
<title>Q2</title>
<body>
    <h1>University Cost Calculator:</h1>
    <table>
    <?php
    error_reporting(0);
        $credits = $_COOKIE['credits'];
        $grad_status = $_COOKIE['status'];
        $state_status = $_POST['state_status'];
        $tuition = 0;

        if ($credits < 1 || $credits > 18) {
            print "<h2>Invalid amount of credits entered. Please try again.</h2>";
        } else {

            if ($grad_status == "Undergraduate" && $state_status == "In State") {
                $tuition += 200;
            } else if ($grad_status == "Graduate" && $state_status == "In State") {
                $tuition += 300;
            } else if ($grad_status == "Undergraduate" && $state_status == "Out of State") {
                $tuition += 400;
            } else if ($grad_status == "Graduate" && $state_status == "Out of State") {
                $tuition += 600;
            }

            $tuition = $tuition * $credits;
            $tuition = number_format((float)$tuition, 2, '.', ',');

            print " <tr>
                        <th>Category</th>
                        <th>Price</th>
                    <tr>
                    <tr>
                        <td><strong>Credits: </strong></td>
                        <td>$credits</td>
                    <tr>
                    <tr>
                        <td><strong>Academic Status: </strong></td>
                        <td>$grad_status</td>
                    <tr>
                    <tr>
                        <td><strong>State Status: </strong></td>
                        <td>$state_status</td>
                    <tr>
                    <tr>
                        <td><strong>Tuition: </strong></td>
                        <td>$$tuition</td>
                    <tr>";
        }

    ?>
    </table>

    <div>
        <button type="reset" class="btn"><a href="http://localhost:8000/in-class-demo/q2/start.html">Restart</a></button>
    </div>
</body>
</html>