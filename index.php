<?php
require 'config.php';


session_start();

// Check it is the first time log_in or not 
if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
echo "
<script>
alert('Please login to continue');
window.location.href='login.php';
</script>
";
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST index </title>
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
            //PDO

        //query prepare
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);

        //bind statment
        //No need to add any value to this bcz already got all posts from db

        //execute statement
        $stmt->execute();
    
        //$result =$stmt->fetch(PDO::FETCH_ASSOC);//only show 1 row as a result

        $result = $stmt->fetchAll();

        //print '<pre>';
        //print_r($result);

    ?>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <h1>Post Management</h1>
                <div>
                    <a class="btn btn-primary" href="add.php">Create New</a>
                    <a  style="float:right" class="btn btn-success" href="logout.php">Logout</a>
                </div><br>
                <thead >
                    <tr>
                        <th style="text-align: center;">Title</th>
                        <th style="text-align: center;">Description</th>
                        <th style="text-align: center;">Created At</th>
                        <th style="text-align: center;">Logo</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result){
                        foreach ($result as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['title']?></td>
                                <td><?php echo $value['description']?></td>
                                <td><?php echo date('d-m-Y', strtotime($value['created_at'])) ?></td>
                                <td><img src="images/<?php echo $value['image']?>" width="100" height="100" alt=""></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $value['id']?>" class='btn btn-primary'>Edit</a>
                                    <a href="delete.php?id=<?php echo $value['id']?>" class='btn btn-danger'>Delete</a>
                                </td>
                            </tr>
                    <?php
                            # code...
                        }
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>