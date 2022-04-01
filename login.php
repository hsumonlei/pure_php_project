<?php
session_start();
require 'config.php';

if (!empty($_POST)) {
    # code...
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    //current user email fetching
        //query prepare
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);

        //bind statment
     $stmt->bindValue(':email',$email);

        //execute statement
    $stmt->execute();

    $user =$stmt->fetch(PDO::FETCH_ASSOC);
    //print '<pre>';
    //print_r($user);

        //check password
    if(empty($user)) {
            echo "<script>alert('Incorrect credentials, Try Again')</script>";
    }else {
        $validPassword = password_verify($pwd, $user['password']);
        if ($validPassword) {
                # code..
            $_SESSION ['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();

                //go to next page
            header('Location: index.php');
            exit();

        }else{
            echo "<script>alert('Incorrect credentials, Try Again')</script>";
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
    <title>Login Form</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
        <div class="card_body">
           
            <h1>Login</h1>
            <form class="" action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" value="" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" value="" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="" value="Login">
                    <a href="register.php">Register</a>
                </div>

            </form>

        </div>
    </div>
    
</body>
</html>