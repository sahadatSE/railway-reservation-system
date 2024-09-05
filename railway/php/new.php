<?php
include "config.php";
session_start();


if (isset($_SESSION["Token"])) {
    $id = $_SESSION["Token"];
    
    
    $sql = "SELECT F, T, D, TBN, s_number FROM ticket WHERE token = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        
        
        mysqli_stmt_bind_result($stmt, $From, $To, $Date, $Tbn, $seat);
        
        if (mysqli_stmt_fetch($stmt)) {
            
            mysqli_stmt_close($stmt);
            
            echo "From: " . htmlspecialchars($From) . "<br>";
            echo "To: " . htmlspecialchars($To) . "<br>";
            echo "Date: " . htmlspecialchars($Date) . "<br>";
            echo "Train Bogie Number: " . htmlspecialchars($Tbn) . "<br>";
            echo "Seat Number: " . htmlspecialchars($seat) . "<br>";
        
        } else {
            echo "No ticket found with the provided token.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    mysqli_close($conn);
} else {
    echo "No session token found. Please log in.";
}
?>
<br>
<br>
<a style="padding-right: 20px;" href="http://localhost/railway/php/main.php">FINISH </a>
