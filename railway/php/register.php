<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<div style ="text-align:center;">
<img style="width:70px; height = 50px;" src="logo.png" alt="D">

</div>

<h1 style ="text-align:center;front-size:40px;color:orange;">Bangladesh Railway </h1>

<div style ="text-align:center;">
<a style="padding-right: 20px;" href="home.html">Home</a>
<a style="padding-right: 20px;" href="http://localhost/railway/php/login.php">Login</a>
<a style="padding-right: 20px;" href="http://localhost/railway/php/register.php">Register</a>
<a style="padding-right: 20px;" href="train information.html">Train Information</a>
<a style="padding-right: 20px;" href="contact us.html">Contact us</a>
</div>

<hr>

<div style ="text-align:center;">

<div class="container">
        <div class="h" style ="color:red;">
            Registration Form
        </div><br>
        <div style ="text-align:center;">
</div>

        <form action="register.php" method="post">
            <div class="group">
                <label>First Name</label><br>
                <input type="text" name="First_Name"><br>
                <label>Last Name</label><br>
                <input type="text" name="Last_name"><br>
                <label>Mobile Number</label><br>
                <input type="text" name="Mobile_number"><br>
                <label>Email</label><br>
                <input type="text" name="Email"><br>
                <label>Password</label><br>
                <input type="text" name="Pass"><br>
                <label>Gender</label><br>
                <input type="text" name="Gender"><br><br>
                <input class="m" type="submit" name="save" value="Submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>


<?php
include "config.php";

if(isset($_POST['save']))
{
    $firstName = mysqli_real_escape_string($conn,$_POST['First_Name']);
    $lastName = mysqli_real_escape_string($conn,$_POST['Last_name']);
    $mobileNumber = mysqli_real_escape_string($conn,$_POST['Mobile_number']);
    $password = mysqli_real_escape_string($conn,md5($_POST['Pass'])); // Corrected the variable name here
    $email = mysqli_real_escape_string($conn,$_POST['Email']);
    $gender = mysqli_real_escape_string($conn,$_POST['Gender']);

    
    $stmt = $conn->prepare("INSERT INTO register (First_Name, Last_name, Mobile_number, Pass, Email, Gender) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    
    $stmt->bind_param("ssssss", $firstName, $lastName, $mobileNumber, $password, $email, $gender);

   
    $execVal = $stmt->execute();

    if ($execVal) {
        echo "Registration successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>


