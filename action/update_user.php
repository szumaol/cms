<?php
//require "time_odhlas.php";
include "../db.php";
if (isset($_POST["new_role"]) AND isset($_POST["id"])) {
    # code...
    $sql = "UPDATE users SET who = :who WHERE id = :id";
    $con = $db->prepare($sql);
    $con->bindValue(":who", $_POST["new_role"], PDO::PARAM_STR);
    $con->bindValue(":id", $_POST["id"], PDO::PARAM_INT);
    $con->execute();
}

header("location:../admin/main.php?page=users");


?>