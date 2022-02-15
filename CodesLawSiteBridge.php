<?php
include_once "DatabaseCredentials.php";
$search = "";
/** @var $conn */
$runs = $conn->query("
SELECT accounts.Name, accounts.idaccount, statsOfRun.account_idaccount, statsOfRun.minutes, statsOfRun.seconds, statsOfRun.milliseconds, statsOfRun.terminalsHacked, statsOfRun.doorsOpened, statsOfRun.level 
FROM accounts 
JOIN statsOfRun ON accounts.idaccount = statsOfRun.account_idaccount;");
/*WHERE accounts.Name = " . $search . "*/
echo "<style>
.border{border: solid black 1px}
</style>";
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