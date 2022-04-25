<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>Codes Law Leaderboard</title>
    <link rel="stylesheet" href="Style%20Login.css">
</head>
<body>
<div class="centerChild">
    <div class="center">
        <div class="center center2">
            <br><br><br><br><br><br>
            <form action="checkPassword.php" method="post">
                <label for="password">Password: </label>
                <input minlength="8" class="margin text" type="password" id="password" name="password"><br><br>
                <label for="rePassword">Re-enter Password: </label>
                <input minlength="8" class="margin text" type="password" id="rePassword" name="rePassword"><br><br>
                <input class="button" type="submit">
            </form><br>
        </div>
        <button class="border button" onclick="location.href='CodesLawSiteOptions.php'">Back</button>

    </div>
</div>
</body>