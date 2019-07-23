<?php

// DONT FORGET TO CHANGE BACK TO PREVENT SQL INJECTION
include("config.php");
session_start();
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>BG Inventory Management Application</title>
    <link rel="stylesheet" type="text/css" href="login_style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>

<body>

    <div class="loginbox">
        <img src="head_icon.png" class="avatar" width="20" s height="20">
        <h1>Login Here</h1>
        <center>
            <form action="" method="post">

                <p>Username: </p><input type="text" name="username" placeholder="Enter your Email" class="box" />
                <p>Password: </p><input type="password" name="password" placeholder="Enter Password" class="box" />

                <input type="submit" name="login" value="Log-in" />

            </form>
        </center>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db_con, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db_con, $_POST['password']);
    $sql = "SELECT * FROM hq_login_table WHERE email = '$myusername' AND password = PASSWORD('$mypassword')";

    $result = mysqli_query($db_con, $sql);
    $sessionrow = $result->fetch_assoc();

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    //If the user exists, the count would be 1.
    if ($myusername == 'admin' and $mypassword == 'bg1234-admin') {

        $_SESSION['sessionlevel'] = 3;
        $_SESSION['login_user'] = $myusername;
        //header("location: admin_view_inventory.php");
        ?>
        <script type="text/javascript">
            location.href = "admin_view_inventory.php";
        </script>
    <?php

    } else if ($count == 1) {

        $_SESSION['sessionlevel'] = $sessionrow['level'];
        $_SESSION['login_user'] = $sessionrow['name'];
        //header("location: welcome.php");
        ?>
        <script type="text/javascript">
            location.href = "welcome.php";
        </script>
    <?php

    } else {
        ?>

        <script>
            swal.fire("Oops...", "Incorrect Login Details", "error");
        </script>

    <?php
    }
}
?>