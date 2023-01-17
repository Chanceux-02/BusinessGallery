<?php

if (isset($_POST['submit'])) {

    $newFileName = $_POST['filename'];
    if (empty($newFileName)) {
        $newFileName = "gallery";
    }else{
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    //grabbing data from form
    $imageTitle = $_POST['title'];
    $imageDescription = $_POST['description'];
    $file = $_FILES['file'];
    $path = $_POST['path'];

    if (!empty($_POST['path'])) {
        $path = $_POST['path'];
    }else if(!empty($_POST['path']) && !empty($_POST['path1'])){
        $path = $_POST['path'];
    }else{
        $path = $_POST['path1'];
    }
    

    //grabbing data from file that you upload ($files)
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTemapName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //print_r($fileExt); //checking if it's working

    $allowed = ["jpg", "jpeg", "png", "jfif"];
    if (!in_array($fileActualExt, $allowed)) {
        echo "You need to upload a proper file type!";
        exit();
    }else{
        if ($fileError !== 0) {
            echo "There was an error!";
            exit();
        }else{
            if ($fileSize > 2000000) {
                echo "The file is too big!";
                exit();
            }else{
                $imageFullName = $newFileName . "." . uniqid("", false) . "." . $fileActualExt;
                $fileDestination = "../images/gallery/" . $imageFullName;

                include_once "../classes/dbh.inc.php";

                if (empty($imageTitle) || empty($imageDescription)) {
                    header("Location: ../index.php?upload=ImageTitleOrDescriptionIsEmpty");
                    exit();
                }else{
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed!";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageORder = $rowCount + 1;

                        $sql = "INSERT INTO gallery (title, description, imgName, orderGallery, status) VALUES (?,?,?,?,?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "Uploading image in database failed!";
                        }else{
                            mysqli_stmt_bind_param($stmt, "sssss", $imageTitle, $imageDescription, $imageFullName, $setImageORder, $path);
                            mysqli_stmt_execute($stmt);
                        }

                        move_uploaded_file($fileTemapName, $fileDestination);
                        header("Location: ../index.php?upload=successfull");
                    }
                }
            }
        }
    }
}else{
    echo "You are not allowed here!";
}