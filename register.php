<?php

include_once 'DatabaseCredentials.php';
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];
//$columns = [
//    "Name",
//];
//
//$stmt = $conn->prepare("SELECT * FROM accounts WHERE (" . implode(", ", $columns) . ") = (:firstValue)") or die("Error preparing.");
//$stmt->execute([
//    ":firstValue" => intval($_POST["name"]),
//]) or die ("Error executing. " . $stmt->errorCode());


/** @var $conn */
$nameCheck = $conn->query('SELECT * FROM accounts WHERE Name = "' . $name . '";');

$mailCheck = $conn->query('SELECT * FROM accounts WHERE EMail = "' . $email . '";');

if ($nameCheck->rowCount() == 0 and $mailCheck->rowCount() == 0)
{
//        $conn->query('INSERT INTO accounts (Name, hash, Email)
//        VALUES ("' . $_POST["name"] . '", "' . $_POST["password"] . '", "' . $_POST["eMail"] . '");');
    $salt = "\$5\$rounds=5000\$" . "MarcIsMarc" . $name . "\$";
    $hash = crypt($password, $salt);

    $columns = [
        "Name",
        "hash",
        "salt",
        "Email"
    ];
    $stmt = $conn->prepare("INSERT INTO accounts (" . implode(', ', $columns) . ") VALUES (:firstValue, :secondValue, :thirdValue, :fourthValue)") or die("Error preparing.");
        $stmt->execute([
            ":firstValue" => $name,
            ":secondValue" => $hash,
            ":thirdValue" => $salt,
            ":fourthValue" => $email
        ]) or die ("Error executing. " . $stmt->errorCode());

}
?>