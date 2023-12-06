<?php
include "db_conn.php";
$id = $_GET["id"];
if (filter_var($id, FILTER_VALIDATE_INT)) {
  $id = intval($id); 
} else {
  echo "id error";
}

if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['mail'];

  
  $sql = "UPDATE `crud` SET `first_name`=?, `last_name`=?, `mail`=? WHERE id=?";

  
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)) {

    mysqli_stmt_bind_param($stmt, "sssi", $first_name, $last_name, $email, $id);

    if(mysqli_stmt_execute($stmt)) {
      header("Location: index.php");
      exit();
    } else {
      echo "Failed: " . mysqli_error($conn);
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

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: black; color: white;">
    CRUD
  </nav>

    <?php
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * FROM `crud` WHERE id = ?";
    if (mysqli_stmt_prepare($stmt, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">first name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">last name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">mail:</label>
          <input type="mail" class="form-control" name="mail" value="<?php echo $row['mail'] ?>">
        </div>

        <div>
          <button type="submit" class="btn btn-success me-2" name="submit">Update</button>
          <a href="index.php" class="btn btn-info">Main Page</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>