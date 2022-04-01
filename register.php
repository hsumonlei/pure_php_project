<?php

require 'config.php';
//var_dump($_POST);

if(!empty($_POST)){
    $u_name = $_POST['username'];
    $e_mail = $_POST['email'];
    $pwd = $_POST['password'];

    if($u_name== '' || $e_mail=='' || $pwd==''){
       echo "Necessary to fill all fields!!!!!!!!!!!" ;
       //exit();
       echo "<script>alert('Necessary to fill all fields!!!!!!!!!!!')</script>";
    }else{    
        //check email is already exist or not in users table 
        //PDO

        //query prepare
        $sql = "SELECT COUNT(email) As num FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);

        //bind statment
        $stmt->bindValue(':email',$e_mail);

        //execute statement
        $stmt->execute();
    
        $row =$stmt->fetch(PDO::FETCH_ASSOC);

        //var_dump($row);
        //exit();
        if ($row['num']> 0) {
            echo "<script>alert('This user email already exist!')</script>";
            # code...
        }else{

        
        //Insert all data into users table 
        //PDO

        $pwdHash = password_hash($pwd, PASSWORD_BCRYPT);
        //query prepare
        $sql = "INSERT INTO users(name,email,password) VALUES(:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        //bind
        $stmt->bindValue(':username',$u_name);
        $stmt->bindValue(':email',$e_mail);
        $stmt->bindValue(':password',$pwdHash);

        //execute
        $result = $stmt->execute();

        if($result){
            echo "Insert Successfully".'<a href="login.php">Login</a>';
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
    <title>Registration Form</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="card_body">
           
            <h1>Register</h1>
            <form class="" action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Name</label>
                    <input class="form-control" type="text" name="username" value="" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" value="" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" value="" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="" value="Register">
                    <a href="login.php">Login</a>
                </div>

            </form>

        </div>
    </div>
    
</body>
</html>