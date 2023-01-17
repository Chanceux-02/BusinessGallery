<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <div class="gallery-container">
    
            <?php
            include_once "classes/dbh.inc.php";
            $id = $_POST["id"];
            $sql = "SELECT * FROM gallery WHERE id=$id;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed! Error: selecting from gallery";
            }else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                
                echo '<div class="edit_div"><div style="background-image: url(images/gallery/'.$row["imgName"].');"></div>';
               
                    ?>
                    <form action="includes/edit.inc.php" method="post">
                        <input type="hidden" name="id" value="<?= $row["id"];?>">
                        <input type="text" name="title" placeholder="<?= $row["title"];?>">  
                        <input type="text" name="desc" placeholder="<?= $row["description"];?>"> 
                        <button type="submit" name="submit">edit</button>
                    </form>
                
            </div>
                <?php

                
            }
            ?>
        </div>
    </div>

    
</body>
</html>