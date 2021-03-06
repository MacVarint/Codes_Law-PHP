<?php
session_start();
include_once "DatabaseCredentials.php";
/** @var $conn */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codes Law Leaderboard</title>
    <link rel="stylesheet" href="Style%20Leaderboard.css">
</head>
<body>
<div id="floatRight">
    <?php
    if (isset($_SESSION["userId"]))
    {
        $stmt = $conn->prepare('SELECT Name FROM accounts WHERE idaccount = ' . $_SESSION["userId"] . ';');
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row)
        {
            echo "<label>Welcome " . $row[0] . "</label>";
        }
    }
    else
    {
        echo "<label>Not logged in</label>";
    }
    ?>
    <button class="border button" onclick="location.href='CodesLawSiteBridge.php'">Login</button>
</div>
<div id="floatLeft">
<?php
$search = "";
if (!isset($_POST['name']) && !isset($_POST['level']))
{
    $_POST['name'] = "";
    $_POST['level'] = "";
}
$level =  intval($_POST['level']);
if($_POST['name'] == "" && $_POST['level'] == "")
{
    $runs = $conn->query("
    SELECT accounts.Name, accounts.idaccount, statsOfRun.account_idaccount, statsOfRun.minutes, statsOfRun.seconds, statsOfRun.milliseconds, statsOfRun.terminalsHacked, statsOfRun.doorsOpened, statsOfRun.level 
    FROM accounts 
    JOIN statsOfRun ON accounts.idaccount = statsOfRun.account_idaccount
    ORDER BY minutes, seconds, milliseconds, terminalsHacked, doorsOpened, level ASC
    LIMIT 100;");
}
else if ($_POST['name'] != "" && $_POST['level'] != "")
{
    $runs = $conn->query("
    SELECT accounts.Name, accounts.idaccount, statsOfRun.account_idaccount, statsOfRun.minutes, statsOfRun.seconds, statsOfRun.milliseconds, statsOfRun.terminalsHacked, statsOfRun.doorsOpened, statsOfRun.level 
    FROM accounts 
    JOIN statsOfRun ON accounts.idaccount = statsOfRun.account_idaccount
    WHERE accounts.Name = '" . $_POST['name'] . "' AND statsOfRun.level = '" . $level . "'
    ORDER BY minutes, seconds, milliseconds, terminalsHacked, doorsOpened, level ASC;");
}
else if ($_POST['name'] != "")
{
    $runs = $conn->query("
    SELECT accounts.Name, accounts.idaccount, statsOfRun.account_idaccount, statsOfRun.minutes, statsOfRun.seconds, statsOfRun.milliseconds, statsOfRun.terminalsHacked, statsOfRun.doorsOpened, statsOfRun.level 
    FROM accounts 
    JOIN statsOfRun ON accounts.idaccount = statsOfRun.account_idaccount
    WHERE accounts.Name = '" . $_POST['name'] . "'
    ORDER BY minutes, seconds, milliseconds, terminalsHacked, doorsOpened, level ASC;");
}
else if ($_POST['level'] != "")
{
    $runs = $conn->query("
    SELECT accounts.Name, accounts.idaccount, statsOfRun.account_idaccount, statsOfRun.minutes, statsOfRun.seconds, statsOfRun.milliseconds, statsOfRun.terminalsHacked, statsOfRun.doorsOpened, statsOfRun.level 
    FROM accounts 
    JOIN statsOfRun ON accounts.idaccount = statsOfRun.account_idaccount
    WHERE statsOfRun.level = '" . $_POST['level'] . "'
    ORDER BY minutes, seconds, milliseconds, terminalsHacked, doorsOpened, level ASC
    LIMIT 100;");
}
echo '<form action="CodesLawSite.php" method="post">';
echo '<p>Name: </p><input class="margin" type="text" name="name" value= "' . $_POST["name"] . '"><br><br>';
echo '<p>Level: </p><input class="margin" type="number" name="level" value= "' . $_POST["level"] . '"><br><br>';
echo '<input class="button" type="submit">';
echo '</form><br>';
echo "<table class='border'>";
echo "<tr>
        <th class='border'>Name</th>
        <th class='border'>Minutes</th>
        <th class='border'>Seconds</th>
        <th class='border'>Milliseconds</th>
        <th class='border'>Terminals hacked</th>
        <th class='border'>Doors opened</th>
        <th class='border'>Level</th>
    </tr>";

foreach ($runs as $run) {
    echo "<tr>";
    echo "<td class='border'>" . $run['Name'] . "</td>";
    echo "<td class='border'>" . $run['minutes'] . "</td>";
    echo "<td class='border'>" . $run['seconds'] . "</td>";
    echo "<td class='border'>" . $run['milliseconds'] . "</td>";
    echo "<td class='border'>" . $run['terminalsHacked'] . "</td>";
    echo "<td class='border'>" . $run['doorsOpened'] . "</td>";
    echo "<td class='border'>" . $run['level'] . "</td>";
    echo "</tr>";
}
echo "</table>";
unset($_POST);
$_POST = array();
?>
</div>
</body>