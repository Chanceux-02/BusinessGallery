<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Path</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>
</head>
<body>
    <header class="header">
        <div>
            <h1>Close Open Store</h1>
        </div>
        <nav class="navigation">
            <a href="http://">About</a>
            <a href="http://">Contact</a>
        </nav>
    </header>
   
    <main class="gallery">
        <div class="add">
            <h3>Please select a folder</h3>
            <form action="includes/gallery.inc.php" method="post" enctype="multipart/form-data">
            <select name="path">
            <option value=''>Status</option>"; 

            <?php
                    include_once "classes/dbh.inc.php";
                    $sql = "SELECT DISTINCT status FROM gallery ";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed! Error: selecting from gallery";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        while ($row = mysqli_fetch_assoc($result)) {

                            $stat = $row["status"];
                            // echo '<div style="background-image: url(images/gallery/'.$row["imgName"].');"></div>';
                            //  echo $row["status"];
                              // echo "<br> <a href='$file'> $file </a> <br> "; 
                              echo "<option value='$stat'> $stat</option>"; 
                              // echo "<option value=' $result'> $result</option>";


                        }
                    }
                    ?>
          
                           

           
            </select>
                <input type="text" name="path1" placeholder="Enter a new status">
                <input type="text" name="filename" placeholder="Filename">
                <input type="text" name="title" placeholder="Title">
                <input type="text" name="description" placeholder="Description">
                <input type="file" name="file">
                <button type="submit" name="submit">Add</button>
            </form>
            <br>
            <form action="selectedpath.php" method="post" enctype="multipart/form-data">
            <select name="view">
            <option value=''>Select Filter</option>";
            <?php
                    include_once "classes/dbh.inc.php";
                    $sql = "SELECT DISTINCT status FROM gallery ";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed! Error: selecting from gallery";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt); 
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stat = $row["status"];
                            echo "<option value='$stat'> $stat</option>"; 
                        }
                    }
                    ?>
            </select>
            <button type="submit" name="submit">Filter</button>
            </form>
            <a href="index.php ">View All</a>
        </div>
        <div class="wrapper">
                <div class="gallery-container">
                    <?php
                        if (isset($_POST['submit'])) {
                            $view = $_POST['view'];
                            include_once "classes/dbh.inc.php";
                            $sql = "SELECT * FROM gallery WHERE status = '$view';";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "SQL statement failed! Error: selecting from gallery";
                            }else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <a href="http://">
                                    <?php
                                    echo '<div style="background-image: url(images/gallery/'.$row["imgName"].');"></div>';
                                    ?>
                                    <h3><?= $row["title"];?></h3>
                                    <p><?= $row["description"];?></p>
                                    <form action="includes/delete.inc.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row["id"];?>">
                                        <button type="submit" name="submit">delete</button>
                                    </form>
                                </a>
        
                                <?php
        
                                }
                            }
                        }
                    ?>
                   
            </div>
        </div>
    </main>
</body>
</html>