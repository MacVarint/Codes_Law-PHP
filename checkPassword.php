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

    $stmt = $conn->prepare('SELECT idaccount FROM accounts WHERE idaccount = "' . $userId . '";');
    $stmt->execute();
    $result = $stmt->fetchAll();

    //Checks if there are any results in the database.
    if (count($result) == 1) {
        $stmt = $conn->prepare('UPDATE accounts SET hash = "' . $currentHash . '" WHERE idaccount = "' . $userId . '"');
        $stmt->execute();
        $result = $stmt->fetchAll();
        header("Location: CodeslawSite.php");
    } else {
        echo "Something went wrong";
    }
} else {
    echo "passwords don't match";
}

function JSC($input){
    echo "<pre>";
    print_r($input);
    echo "</pre>";
}
?>

