<?php
session_start();

include("connection.php");    
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username)){

        
        //read from database

        $query = "select * from users where username = '$username' limit 1";
        

        $result = mysqli_query($con, $query);

        if($result){

            if($result && mysqli_num_rows($result) > 0){

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password){
                    
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }

        }
        echo "Wrong Username or password!";
    }
    else{
        echo "Please enter the valid information!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <style type = "text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
            
        }

        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: Lightblue;
            border: none;
        }
        
        #box{
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;

        }
    </style>

    <div id = "box">
        <form method = "post">
            <div style="font-size: 20px; margin: 10px; color: white;">
                Login
            </div>

            <input id = "text" type = "text" name = "username" placeholder = "Username"><br><br>
            <input id = "text" type = "password" name = "password" placeholder = "Password"><br><br>
            
            <input id = "button" type = "submit" value = "Login" style = "cursor: pointer;" ><br><br>
            
            <div style = "display: flex;">
                <div style ="font-size: 15px; margin: 10px;">
                    Are you a new user?
                </div>
            
                <a href = "signup.php" style ="font-size: 15px; margin: 10px;">
                    Sign up
                </a><br><br>
            </div>
        </form>

    </div>
</body>
</html>