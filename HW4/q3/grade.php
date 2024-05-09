<?php
    session_start();
    $updatedTime = time();
    $time = $_SESSION["time"];
    $passcode = $_SESSION['passcode'];

    $db = mysqli_connect("127.0.0.1","root","root","db6");
?>

<html>
<head>
    <title>Q3</title>
</head>

    <style>

        body {
            background-color: rgb(123, 106, 170);
            font-family: 'Poppins', sans-serif;
        }

        form {
            border: solid 2px #000;
            border-radius: 10px;
            padding: 20px;
        }

        #large-container {
            display: flex;
            flex-direction: column;
            align-items: center;
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
            width: 25%;
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

    </style>

<body>


    <?php
        $score = 0;

        $completeQuery = "SELECT complete FROM students WHERE code='$passcode'";
        $completeResults = mysqli_query($db,$completeQuery);
        $completeRows = mysqli_num_rows($completeResults);

        for ($i = 0; $i < $completeRows; $i++) {
            $row = mysqli_fetch_assoc($completeResults);
            $complete = $row['complete'];
        }
    
        if ($complete != 0) {
            print "<h2 style='display:flex;justify-content:center;'>User has already completed the exam!</h2>";
        } else if ($updatedTime - $time > 240) {
            print "<h2 style='display:flex;justify-content:center;'>User exceeded time limit!</h2>";
            print "<h2 style='display:flex;justify-content:center;'>Score: $score</h2>";
        } else {
            $updateQuery = "UPDATE students SET complete='1' WHERE code=$passcode";
            $updateResults = mysqli_query($db,$updateQuery);

            if (isset($_GET['q1'])) {
                $a1 = $_GET['q1'];
            } else {
                $a1 = 0;
            }

            if (isset($_GET['q2'])) {
                $a2 = $_GET['q2'];
            } else {
                $a2 = 0;
            }

            if (isset($_GET['q3'])) {
                $a3 = $_GET['q3'];
            } else {
                $a3 = 0;
            }

            if (isset($_GET['q4'])) {
                $a4 = $_GET['q4'];
            } else {
                $a4 = 0;
            }

            if (isset($_GET['q5'])) {
                $a5 = $_GET['q5'];
            } else {
                $a5 = 0;
            }

            if ($a1 == "Java") {
                $score += 1;
            }
            if ($a2 == "JavaScript") {
                $score += 1;
            }
            if ($a3 == "Logical") {
                $score += 1;
            }
            if ($a4 == "Imperative") {
                $score += 1;
            }
            if ($a5 == "The Box Model") {
                $score += 1;
            }

            print "<h2 style='display:flex;justify-content:center;'>Score: $score</h2> <br>";
            print "";

        }

        $updateQuery = "UPDATE students SET complete='1' WHERE code=$passcode";
        $updateResults = mysqli_query($db,$updateQuery);

        $scoreUpdateQuery = "UPDATE students SET score=$score WHERE code=$passcode";
        $scoreUpdateResults = mysqli_query($db,$scoreUpdateQuery);

    ?>



</body>
</html>