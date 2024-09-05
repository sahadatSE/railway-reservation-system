<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>

<div class="contain">
<div style ="text-align:center;">
<img style="width:70px; height = 50px;" src="logo.png" alt="D">
</div>

<h1 style ="text-align:center;font-size:30px;color:orange;">Bangladesh Railway</h1>
<hr>

<div style ="text-align:left;">

<div class="container">
        <div class="h" style ="color:red;">
            Select your Ticket 
        </div><br>
        <div style ="text-align:center;"></div>

        <form action="add.php" method="post">
            <div class="group">
                <label>From</label><br>
                <input type="text" name="F"><br>
                <label>To</label><br>
                <input type="text" name="T"><br>
                <label>Date </label><br>
                <input type="text" name="D"><br>
                <label>Tarin Bogie Number</label><br>
                <input type="text" name="TBN"><br>
                <label>Seat Number</label><br>
                <input type="text" name="s_number"><br>
                <br>
                <input class="m" type="Submit" name="save" value="Submit">
            </div>
        </form>
    </div>
</div>

<div style ="text-align:right;"><img style="width:190px; height = 80px;" src="train seat.png" alt="D"></div>
</body>
</html>


<?php
include "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $From = mysqli_real_escape_string($conn, $_POST['F']);
    $To = mysqli_real_escape_string($conn, $_POST['T']);
    $Date = mysqli_real_escape_string($conn, $_POST['D']);
    $TrainBogieNumber = mysqli_real_escape_string($conn, $_POST['TBN']);
    $SeatNumber = mysqli_real_escape_string($conn, $_POST['s_number']);
    
    // Generate a unique token
    $bytes = random_bytes(16); 
    $uniqueId = bin2hex($bytes);
    $_SESSION['Token'] = $uniqueId;

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO ticket (F, T, D, TBN, s_number, token) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $From, $To, $Date, $TrainBogieNumber, $SeatNumber, $uniqueId);
        if (mysqli_stmt_execute($stmt)) {
            echo "Booking successful";
            // Redirect to another page after successful booking
            header("Location: new.php");
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>