<?php 

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "todo";

$con = mysqli_connect($server,$username,$password,$database);

$heading = "";

$show = true;


if(isset($_POST["title"])){


    $taskTitle = $_POST['title'];

    $description = $_POST['description'];

   


    if(!$con){
     
        die("unable to connect to database " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `task`(`Title`, `Description`) VALUES ('$taskTitle','$description')";

    if($con -> query($sql)){

        echo '<script>alert("added succesfull");</script>';
    }

}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Todo</title>
    <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    background-color: white;
    color: black;
}

    </style>
</head>
<body>
<div class="min-vh-100 border-primary d-flex flex-column align-items-center"  id="container">
    <h4 class="mt-2"><?php echo "$heading" ?></h4>
    <form method="POST" action="index.php" class="d-flex flex-column w-25 gap-3 pt-4">
        <div>
        <h5>Title</h5>
        <input type="text" name="title" class="form-control w-100 rounded">
        </div>
        <div>
        <?php if($show) {?>

        <h5>Discription</h5>

        <?php } ?>
        
        <input name="description" class="form-control w-100 rounded border-2"/>
        </div>
        <button name="btn" class="btn btn-primary">Add Task</button>
    </form>

    <div class="w-25 mt-3">

    
    <?php

        $result = mysqli_query($con, "SELECT * FROM todo.task");

        while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="shadow d-flex justify-content-between align-items-center px-2 py-1 rounded-4 mb-2">
            <div>
                <h3 class="fw-normal">' . $row["Title"] . '</h3>
                <p>' . $row["Description"] . '</p>
            </div>
            <form method="POST" action="index.php">
            <input type="hidden" name="id" value="' . $row["id"] . '">
            <button type="submit"  class="btn btn-danger" name="delete">Delete</button>
        </form>
        </div>';
        }

        $arr = array();

        $obj = {};

        

        if(isset($_POST['delete'])){


            $id = $_POST["id"];
            $deleteQuery = "DELETE FROM task WHERE id = '$id'";
            if (mysqli_query($con, $deleteQuery)) {
                $heading = "task deleted successfully";
            } else {
                $heading = "Error deleting task: " . mysqli_error($con);
            }
            
        }
    ?>

    </div>
</div>
</body>
</html>

