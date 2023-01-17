<?php

if (isset($_POST['submit'])) { 

    $id = $_POST['id'];
    // echo $id;

    include_once "../classes/dbh.inc.php";
    $sql = "SELECT * FROM gallery WHERE id = $id;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed! Error: selecting from gallery";
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        // print_r($row);
        $delete = "DELETE FROM gallery WHERE id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $delete)) {
            echo "SQL statement failed! Error: selecting from gallery 222";
        }else{
            mysqli_stmt_execute($stmt);
            unlink("../images/gallery/" . $row['imgName']);
        }
    }
    header("Location: ../index.php?delete=successfull!");

}else{
    echo "You are not allowed here!";
}