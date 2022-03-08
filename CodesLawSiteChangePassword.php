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
            <form action="checkLogin.php" method="post">
                <label>Password: <input minlength="8" class="margin text" type="password" name="password"></label><br><br>
                <label>Re-enter Password: <input minlength="8" class="margin text" type="password" name="rePassword"></label><br><br>
                <input class="button" type="submit">
            </form><br>
        </div>
        <button class="border button" onclick="location.href='CodesLawSiteOptions.php'">Back</button>

    </div>
</div>
</body>