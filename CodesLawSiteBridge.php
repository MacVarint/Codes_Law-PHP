<?php
session_start();

if (isset($_SESSION["userId"])) {
    header('Location: CodesLawSiteOptions.php');
}
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
            <label>Email: <input class="margin text" type="email" name="eMail"></label><br><br>
            <label>Password: <input class="margin text" type="password" name="password" minlength="8"></label><br><br>
            <input class="button" type="submit">
            </form><br>
        </div>
        <button class="border button" onclick="location.href='CodesLawSite.php'">Back</button>

    </div>
</div>
</body>