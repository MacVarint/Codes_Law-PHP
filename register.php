<?php

include_once 'DatabaseCredentials.php';


//$columns = [
//    "Name",
//];
//
//$stmt = $conn->prepare("SELECT * FROM accounts WHERE (" . implode(", ", $columns) . ") = (:firstValue)") or die("Error preparing.");
//$stmt->execute([
//    ":firstValue" => intval($_POST["name"]),
//]) or die ("Error executing. " . $stmt->errorCode());


/** @var $conn */
$nameCheck = $conn->query('SELECT * FROM accounts WHERE Name = "' . $_POST["name"] . '";');

$mailCheck = $conn->query('SELECT * FROM accounts WHERE EMail = "' . $_POST["email"] . '";');

if ($nameCheck->rowCount() == 0 and $mailCheck->rowCount() == 0)
{
//        $conn->query('INSERT INTO accounts (Name, hash, Email)
//        VALUES ("' . $_POST["name"] . '", "' . $_POST["password"] . '", "' . $_POST["eMail"] . '");');

        $columns = [
            "Name",
            "hash",
            "Email"
        ];

        $stmt = $conn->prepare("INSERT INTO accounts (" . implode(', ', $columns) . ") VALUES (:firstValue, :secondValue, :thirdValue)") or die("Error preparing.");
        $stmt->execute([
            ":firstValue" => $_POST["name"],
            ":secondValue" => $_POST["password"],
            ":thirdValue" => $_POST["email"]
        ]) or die ("Error executing. " . $stmt->errorCode());
}
?>