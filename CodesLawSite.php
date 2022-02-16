<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codes Law Leaderboard</title>
    <link rel="stylesheet" href="Style%20Leaderboard.css">
</head>
<body>
<?php
include_once "DatabaseCredentials.php";
/** @var $conn */
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
/*WHERE accounts.Name = " . $search . "*/
echo '<form action="CodesLawSite.php" method="post">';
echo '<p>Name: </p><input type="text" name="name" value= "' . $_POST["name"] . '"><br><br>';
echo '<p>Level: </p><input type="text" name="level" value= "' . $_POST["level"] . '"><br><br>';
echo '<input type="submit">';
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
</body>