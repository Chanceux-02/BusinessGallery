<?php

if (isset($_POST['submit'])) { 

    $id = $_POST['id'];
    $tit = $_POST['title'];
    $desc = $_POST['desc'];
    // echo $id;

    include_once "../classes/dbh.inc.php";
    $sql = "UPDATE gallery SET title = '$tit', description = '$desc' WHERE id = '$id';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed! Error: selecting from gallery";
    } else {
        mysqli_stmt_execute($stmt);
        // print_r($row);
    }
    header("Location: ../index.php?edit=successfull!");

}else{
    echo "You are not allowed here!";
}