<?php
  include "db_conn.php";
  if (!$conn) {
    die("DB conn error: " . mysqli_connect_error());
  }

    //In the if check whether the value in the line is a number and whether the value exists.
  if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    
    //prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    
    $sql = "DELETE FROM `crud` WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: index.php");
            exit();
        } 
        else {
            echo "No deleted.";
        }
    } 
    else {
        echo "Failed: " . mysqli_error($conn);
    }

    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  } 
  else{
    echo "Invalid input";
    mysqli_close($conn);
  }
?>