<?php

//PDO connection, the error is an IDE bug.
require_once 'DatabaseCredentials.php';

//This query inserts the data.
//$conn->query("INSERT INTO statsOfRun (account_idaccount,milliseconds, seconds, minutes, terminalsHacked, doorsOpened, level) VALUES ('" . intval($_POST["account_idaccount"])  . "', '" . intval($_POST["milliseconds"]) . "', '" . intval($_POST["seconds"]) . "', '" . intval($_POST["minutes"]) . "', '" . intval($_POST["terminalsHacked"]) . "', '" . intval($_POST["doorsOpened"]) . "', '" . intval($_POST["level"]) . "');");

$columns = [
    "account_idaccount",
    "milliseconds",
    "seconds",
    "minutes",
    "terminalsHacked",
    "doorsOpened",
    "level"
];
//Intval converts them into integers
/** @var $conn */
$stmt = $conn->prepare("INSERT INTO statsofrun (" . implode(', ', $columns) . ") VALUES (:firstValue, :secondValue, :thirdValue, :fourthValue, :fifthValue, :sixthValue, :seventhValue)") or die("Error preparing.");
$stmt->execute([
    ":firstValue" => intval($_POST["account_idaccount"]),
    ":secondValue" => intval($_POST["milliseconds"]),
    ":thirdValue" => intval($_POST["seconds"]),
    ":fourthValue" => intval($_POST["minutes"]),
    ":fifthValue" => intval($_POST["terminalsHacked"]),
    ":sixthValue" => intval($_POST["doorsOpened"]),
    ":seventhValue" => intval($_POST["level"])
]) or die ("Error executing. " . $stmt->errorCode());

?>