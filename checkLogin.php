<?php
session_start();
include_once 'DatabaseCredentials.php';
$idUser = null;
$salt = null;
$email = $_POST["eMail"];
$password = $_POST["password"];

//$loginCheck = $conn->query('SELECT * FROM accounts  WHERE hash = "' . $_POST["password"] . '" AND Email = "' . $_POST["eMail"] . '";');
/** @var $conn */

$emailQuery = $conn->query('SELECT idaccount FROM accounts WHERE Email = "' . $email . '";');
foreach ($emailQuery as $row)
{
    $idUser = $row['idaccount'];
}
$saltQuery = $conn->query('SELECT salt FROM accounts WHERE idaccount = "' . $idUser . '";');
foreach ($saltQuery as $row)
{
    $salt = $row['salt'];
}
$currentHash = crypt($password, $salt);

$loginCheck = $conn->query('SELECT * FROM accounts  WHERE hash = "' . $currentHash . '" AND Email = "' . $email . '";');

//Checks if there are any results in the database.
if ($loginCheck->rowCount() == 1)
{
    //I don't know what this is supposed to mean, I actually can't recall writing this down.
    //It probably loops though all the array elements to find the correct one.

    foreach ($loginCheck as $row)
    {
        //This echos the ids
        echo $row['idaccount'];
        $_SESSION["userId"] = $row['idaccount'];
    }
    header("Location: CodesLawSite.php");
}else{
    //If there are no results, print 'PASS' in the console.
    echo "the password or e-mail is incorrect ";
}
?>