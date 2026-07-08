<?php
session_start();
include "../lib/user_func.php";
include "../db.php";
require "../action/time_odhlas.php";
$_SESSION["error"] = "";

if (isset($_POST["surname"])) {
    if (empty($_POST["surname"])) {
        $_SESSION["error"] = "Error, nevyplnene prijmeni";
    }
}

if (isset($_POST["name"])) {
    if (empty($_POST["name"])) {
        $_SESSION["error"] = "Error, nevyplnene jmeno";
    }
}

if (isset($_POST["mail"])) {
    if (empty($_POST["mail"])) {
        $_SESSION["error"] = "Error, nevyplneny mail";
    }
}
if (!(empty($_POST["id"])) AND is_numeric($_POST["id"]) AND empty($_SESSION["error"])) {
    # code...
            $sql = "UPDATE users SET 
            surname = :surname, 
            name = :name, 
            mail = :mail 
            WHERE id = :id";
                $update_my = $db->prepare($sql);
                $update_my->bindValue(":id", $_POST["id"], PDO::PARAM_INT);  
                $update_my->bindValue(":surname", $_POST["surname"], PDO::PARAM_STR);  
                $update_my->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
                $update_my->bindValue(":mail", $_POST["mail"], PDO::PARAM_STR); 
                $update_my->execute();
            if ($update_my->rowCount() > 0) {
                $_SESSION["norm"] = "Aktualizovano";
                unset($_SESSION["error"]);
                var_dump($update_my->rowCount());
                unset($_SESSION["data"]);
            }
}
header("location:../admin/main.php?page=myinfo");
?>