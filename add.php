<?php
require 'config.php';


if (!empty($_POST)) {
    //query prepare

    // print "<pre>";
    // print_r($_FILES);
    // exit();



    $targetFile = 'images/'.($_FILES['image'] ['name']);
    //check image extension
    $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);

    // print"<pre>";
    // print_r($imageType);
    // exit();
    if($imageType != 'png' && $imageType != 'PNG' && $imageType != 'jpg' && $imageType != 'JPG' && $imageType != 'jpeg' && $imageType != 'JPEG') {
        echo "<script>alert('Image must be png, jpg or jpeg');</script>";

    }else {
        $move = move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);
        if($move){
            $sql = "INSERT INTO posts(title,description,created_at,image) VALUES(:title, :description, :created_at, :image)";
            $stmt = $pdo->prepare($sql);
        
            //bind
            $stmt->bindValue(':title',$_POST['title']);
            $stmt->bindValue(':description',$_POST['description']);
            $stmt->bindValue(':created_at',$_POST['created_at']);
            $stmt->bindValue(':image',$_FILES['image'] ['name']);
        
            //execute
            $result = $stmt->execute();
        
            if($result){
                echo 'SUCCESSFULLY Add new post';
            }

        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Record</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="card_body">
           
            <h1>Add New Post</h1>
            <form class="" action="add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input class="form-control" type="text" name="description" value="" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" value="" required>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="date" name="created_at" value="" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="" value="ADD">
                    <a  class="btn btn-warning" href="index.php">Back</a>
                </div>

            </form>

        </div>
    </div>
    
</body>
</html>