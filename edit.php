<?php
require 'config.php';
if(!empty($_POST)){

    //UPDATE DATA

    // print"<pre>";
    // print_r($_POST);
    // print_r($_GET['id']);
    // exit();
$title = $_POST['title'];
$description = $_POST['description'];
$created_at = $_POST['created_at'];
$_id = $_GET['id'];

if ($_FILES) {

    $targetFile = 'images/'.($_FILES['image'] ['name']);
    $imageName = $_FILES['image'] ['name'];
    //check image extension
    $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);

    // print"<pre>";
    // print_r($imageType);
    // exit();
    if($imageType != 'png' && $imageType != 'PNG' && $imageType != 'jpg' && $imageType != 'JPG' && $imageType != 'jpeg' && $imageType != 'JPEG') {
        echo "<script>alert('Image must be png, jpg or jpeg');</script>";

    }else {
        move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);
        $pdo_statement = $pdo->prepare("UPDATE posts set title='$title', description='$description', created_at='$created_at', image='$imageName' WHERE id=$_id");
        $result = $pdo_statement->execute();
        }
    }else {
        $pdo_statement = $pdo->prepare("UPDATE posts set title='$title', description='$description', created_at='$created_at' WHERE id=$_id");
        $result = $pdo_statement->execute();
    }
    if($result){
        echo "<script>alert('record is updated'); window.location.href = 'index.php';</script>";
    }
}
$pdo_statement = $pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
$pdo_statement->execute();

$result = $pdo_statement->fetchAll();

// print "<pre>";
// print_r($result);

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
           
            <h1>Edit Post</h1>
            <form class="" action="" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="id" value="<?php echo $result[0]['id']?>"> -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="<?php echo $result[0]['title']?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input class="form-control" type="text" name="description" value="<?php echo $result[0]['description']?>" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label><br><br>
                    <!-- <img scr= width="100" height="100" alt="post_image"> -->
                    <img src="images/<?php echo $result[0]['image']?>" width="100" height="100" alt="">
                    <input type="file" name="image" value="" >
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="date" name="created_at" value="<?php echo date('Y-m-d',strtotime($result[0]['created_at']))?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="" value="Update">
                    <a  class="btn btn-warning" href="index.php">Back</a>
                </div>

            </form>

        </div>
    </div>
    
</body>
</html>