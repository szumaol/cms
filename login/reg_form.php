<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/style.css">
</head>
<body>
<?php
if (isset($_SESSION["error_reg"]) AND !empty($_SESSION["error_reg"])) {
    echo "<h1 class='alert alert-danger' role='alert'>".$_SESSION["error_reg"]."</h1>";
    unset($_SESSION["error_reg"]);
}

if (isset($_SESSION["norm"]) AND !empty($_SESSION["norm"])) {
    echo "<h1 class='alert alert-success' role='alert'>".$_SESSION["norm"]."</h1>";
    unset($_SESSION["norm"]);
  # code...
}

?>
<div class="form_seen">
  <form action="reg_back.php" method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" class="form-control" id="name_reg" name="name_reg" aria-describedby="emailHelp" value="<?php echo $_SESSION["data"]["name_reg"] ?? '' ?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Surname</label>
      <input type="text" class="form-control" id="surname_reg" name="surname_reg" aria-describedby="emailHelp" value="<?php echo $_SESSION["data"]["surname_reg"] ?? '' ?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="mail_reg" name="mail_reg" aria-describedby="emailHelp" value="<?php echo $_SESSION["data"]["mail_reg"] ?? '' ?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="pass_reg" name="pass_reg">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="pass_cont_reg" name="pass_cont_reg">
    </div>
    <input type="submit" class="btn btn-primary" value="Submit">
    <a class="link" href="log_form.php">Přihlásit se</a>
  </form>
</div>
</body>
</html>