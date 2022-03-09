<?php
session_start();
include_once 'DatabaseCredentials.php';
/** @var $conn */
$userId = $_SESSION["userId"];
$password = $_POST["password"];
$rePassword = $_POST["rePassword"];
//Checks if the passwords match
if ($password === $rePassword) {
    //passwords are matching
    $saltQuery = $conn->query('SELECT salt FROM accounts WHERE idaccount = "' . $userId . '";');
    foreach ($saltQuery as $row) {
        $salt = $row['salt'];
    }
    $currentHash = crypt($password, $salt);

    $idUser = $conn->query('SELECT idaccount FROM accounts WHERE idaccount = "' . $userId . '";');
    //Checks if there are any results in the database.
    if ($idUser->rowCount() == 1) {
        $conn->query('INSERT INTO accounts (hash) VALUES (' . $currentHash . ') WHERE idaccount = "' . $userId . '"');
        echo "Password changed";
        header("Location: CodesLawSite.php");
    } else {
        echo "Something went wrong";
    }
} else {
    echo "passwords don't match";
}
?>