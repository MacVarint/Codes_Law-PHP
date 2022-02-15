<?php

include_once 'DatabaseCredentials.php';

//$loginCheck = $conn->query('SELECT * FROM accounts  WHERE hash = "' . $_POST["password"] . '" AND Email = "' . $_POST["eMail"] . '";');
/** @var $conn */
$loginCheck = $conn->query('SELECT * FROM accounts  WHERE hash = "' . $_POST["password"] . '" AND Email = "' . $_POST["eMail"] . '";');

//Checks if there are any results in the database.
if ($loginCheck->rowCount() > 0)
{
    //I don't know what this is supposed to mean, I actually can't recall writing this down.
    //It probably loops though all the array elements to find the correct one.

    foreach ($loginCheck as $row)
    {
        //This echos the ids
        echo $row['idaccount'];
    }
}else{
    //If there are no results, print 'PASS' in the console.
    echo "PASS";
}
?>