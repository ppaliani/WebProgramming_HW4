<html>
<head>
    <title>Q3</title>
</head>

<style>

    body {
        background-color: rgb(123, 106, 170);
        font-family: 'Poppins', sans-serif;
    }

    table {
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
        width: 50%;
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
    <div id="large-container">
    <?php
        // Connecting to database
        $db = mysqli_connect("127.0.0.1","root","root","db6");

        $passwordQuery = "SELECT * FROM password";
        $passwordResults = mysqli_query($db,$passwordQuery);
        $passwordRows = mysqli_num_rows($passwordResults);

        for ($i = 0; $i < $passwordRows; $i++) {
            $row = mysqli_fetch_assoc($passwordResults);
            $pwd = $row['pwd'];
        }

        $password = $_GET['pwd'];

        if ($password != $pwd) {
            print "<h2>Incorrect password entered. Please try again</h2>";
        } else {

            $showQuery = "SELECT * FROM students";
            $showResults = mysqli_query($db,$showQuery);
            $showRows = mysqli_num_rows($showResults);

            print"  <table>
                        <tr>
                            <th><strong>Name</strong></th>
                            <th><strong>Code</strong></th>
                            <th><strong>Seen</strong></th>
                            <th><strong>Completed</strong></th>
                            <th><strong>Score</strong></th>
                        </tr>";

            for ($i = 0; $i < $showRows; $i++) {
                $row = mysqli_fetch_assoc($showResults);
                $name = $row['name'];
                $code = $row['code'];
                $seen = $row['seen'];
                $complete = $row['complete'];
                $score = $row['score'];

                if ($complete == 1) {
                    $complete = "Yes";
                } else {
                    $complete = "No";
                }

                if ($seen == 1) {
                    $seen = "Yes";
                } else {
                    $seen = "No";
                }

                print " <tr>
                            <td>$name</td>
                            <td>$code</td>
                            <td>$seen</td>
                            <td>$complete</td>
                            <td>$score</td>
                        </tr>";
            }

            print "</table";

        }


    ?>
    </div>
</body>
</html>