<?php
   include "db_conn.php";

   // insert data  
   if (isset($_POST["submit"])) {

   // check conn
   if (!$conn) {
       die("DB conn error: " . mysqli_connect_error());
   }
   

   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['mail']);

   $sql = "INSERT INTO `crud` (`first_name`, `last_name`, `mail`) VALUES (?, ?, ?)";
   $stmt = mysqli_stmt_init($conn);
   
   if (mysqli_stmt_prepare($stmt, $sql)) {
       mysqli_stmt_bind_param($stmt, "sss", $first_name, $last_name, $email);

       mysqli_stmt_execute($stmt);

       if (mysqli_stmt_affected_rows($stmt) > 0) {

           echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           ' . "Data Saved" . '
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

         }  
        else {
           echo "Data not saved.";
       }

       mysqli_stmt_close($stmt);
   }
   else {
      echo "Given data error.";
   }

   mysqli_close($conn);
   
   }
?>

<!-- below is all visual and user insert boxes and insert buttons-->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width">

   <!-- bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD</title>
</head>

<body>
   
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: black; color: white;">
      CRUD
   </nav>
      <div class="container">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Atalay">
               </div>

               <div class="col">
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Arabacı">
               </div>
            </div>

            <div class="mb-5">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="mail" placeholder="name@example.com">
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-info">Main Page</a>
            </div>
         </form>
      </div>
   </div>

   <!-- bootstrap_js -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>