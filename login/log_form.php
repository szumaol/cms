<?php
session_start();
include "../lib/log_func.php";
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
error();
?>
<div class="form_seen">
  <form action="log_back.php" method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="mail_login" name="mail_login" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="pass_login" name="pass_login">
    </div>
    <input type="submit" class="btn btn-primary" value="Submit">
  </form>
</div>
<div>
  <p class="form_link">Jeste nemate ucet?</p><a class="form_seen" href="reg_form.php">Registrovat se</a>
</div>
</body>
</html>