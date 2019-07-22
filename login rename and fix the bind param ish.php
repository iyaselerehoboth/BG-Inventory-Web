<?php


// DONT FORGET TO CHANGE BACK TO PREVENT SQL INJECTION


include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $myusername = mysqli_real_escape_string($db_con,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db_con,$_POST['password']);
        
    //$sql = "SELECT * FROM hq_login_table WHERE email = '$myusername' AND password = PASSWORD('$mypassword')";
    
    $sql = "SELECT * FROM process_login_table WHERE name =? AND password = PASSWORD(?)";
    $stmt = $db_con->prepare($sql);
    $stmt->bind_param("si", $myusername,$mypassword);
    $stmt->execute();

    //$sql = "SELECT * FROM process_login_table WHERE name =? AND password = PASSWORD(?)";
    
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $sessionrow = $result->fetch_assoc();

    /*$result = mysqli_query($db_con,$sql);
    $sessionrow = $result->fetch_assoc();*/

    /*print($sessionrow['level']);
    print $mypassword;*/

    //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
   /* $result = $stmt->get_result();
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);*/
        
    $count = mysqli_num_rows($result);
    
    //If the user exists, the count would be 1.
    if($myusername == 'admin' AND $mypassword == 'bg1234-admin'){
        
        $_SESSION['sessionlevel'] = 3;
        $_SESSION['login_user'] = $myusername;
        header("location:admin_view_inventory.php");
        
    }
   
    else if($count == 1)
        
    {
/*        session_register("myusername");*/
        $_SESSION['sessionlevel'] = $sessionrow['level'];
        $_SESSION['login_user'] = $sessionrow['name'];
        header("location: welcome.php");
        /*header("location:create_transaction.php");*/
    }else{
        
    ?>

    <script>
        
        window.alert("Incorrect login details");
    </script>

    <?php
    }
    
}

?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    
    <head>
        <title>BG Inventory Management Application</title>
        <link rel="stylesheet" type="text/css" href="login_style.css">
    </head>
    
    
    <body>
    
        <div class="loginbox">
            <img src="head_icon.png" class="avatar" width="20"s height="20">
            <h1>Login Here</h1>
            <center>
            <form action = "" method = "post">
                <p>Username: </p><input type = "text" name = "username" placeholder="Enter your Email" class = "box"/>
                <p>Password: </p><input type = "password" name = "password" placeholder="Enter Password" class = "box"/>
                <input type = "submit" name = "login" value = "Log-in" />
            </form>
            </center>
            </div>
    
            
            
    
    </body>
    
</html>