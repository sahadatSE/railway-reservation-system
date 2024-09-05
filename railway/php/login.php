<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

<div style ="text-align:center;">
<img style="width:70px; height = 50px;" src="logo.png" alt="D">
</div>

<h1 style ="text-align:center;font-size:40px;color:orange;">Bangladesh Railway </h1>

<div style ="text-align:center;">
    <a style="padding-right: 20px;" href="file:///C:/xamgfbh/htdocs/railway/html/home.html">Home</a>
    <a style="padding-right: 20px;" href="http://localhost/railway/php/login.php">Login</a>
    <a style="padding-right: 20px;" href="http://localhost/railway/php/register.php">Register</a>
    <a style="padding-right: 20px;" href="train information.html">Train Information</a>
    <a style="padding-right: 20px;" href="contact us.html">Contact us</a>
</div>

<hr>

<div class="hero" style ="text-align:center;" >
    <div class="h" style ="color:green;">
        Login Form
    </div><br><br>
    <form class="group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="on">
        <label>Email</label> <br>
        <input type="email" name="Email" placeholder="Enter your Email"><br>
        <label>Password</label> <br>
        <input type="password" name="Pass" placeholder="Enter your Password"><br><br>
        <input class="m" type="submit" name="save" value="login">
    </form>
</div>

</body>

</html>

<?php

include "config.php";

if (isset($_POST['save'])) {
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Password = mysqli_real_escape_string($conn, md5($_POST['Pass']));
    $sql = "SELECT First_Name, Email, Gender FROM register WHERE Email = '{$Email}' AND Pass = '{$Password}'";
    $result = mysqli_query($conn, $sql) or die("query failed");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION["Email"] = $row['Email'];
            $_SESSION["First_Name"] = $row['First_Name'];
            $_SESSION["Gender"] = $row['Gender'];

            header("Location: http://localhost/railway/php/main.php");
        }
    } else {
        echo "<p>Email and Password not match</p>";
    }
}
?>
