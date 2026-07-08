<?php
include "../db.php";
include "../lib/log_func.php";
session_start();
$_SESSION["error_reg"] = null;
if (isset($_POST["name_reg"])) {
    if (!(empty($_POST["name_reg"]))) {
    $name = $_POST["name_reg"];
    } else {
        $_SESSION["error_reg"] = "Zadejte sve jmeno";
    }

}

if (isset($_POST["surname_reg"])) {
    if (!(empty($_POST["surname_reg"]))) {
    $surname = $_POST["surname_reg"];
    } else {
        $_SESSION["error_reg"] = "Zadejte sve prijmeni";
    }
}

if (isset($_POST["mail_reg"])) {
    if (!(empty($_POST["mail_reg"]))) {
    $mail = $_POST["mail_reg"];
    } else {
        $_SESSION["error_reg"] = "Zadejte svuj email";
    }
}

if (isset($_POST["pass_reg"])) {
    if (!(empty($_POST["pass_reg"]))) {
        $pass_reg = $_POST["pass_reg"];
    } else {
        $_SESSION["error_reg"] = "Zadejte sve heslo";
    }
}

if (isset($_POST["pass_cont_reg"])) {
    if (!(empty($_POST["pass_cont_reg"]))) {
        $pass_cont_reg = $_POST["pass_cont_reg"];
    } else {
        $_SESSION["error_reg"] = "Zadejte sve heslo jeste jednou pro kontrolu";
    }
}



if (empty($_SESSION["error_reg"]) AND !empty($name) AND !empty($surname) AND !empty($mail) AND !empty($pass_reg) AND !empty($pass_cont_reg)) {
    if (strlen($pass_reg >= 8)) {
        if (preg_match('/[a-z]/', $pass_reg) AND preg_match('/[A-Z]/', $pass_reg) AND preg_match('/[0-9]/', $pass_reg)){
            if ($pass_reg == $pass_cont_reg) {
                $sql_select = "SELECT * FROM users WHERE mail = :mail";
                $con_select = $db->prepare($sql_select);
                $con_select->bindValue(":mail", $mail, PDO::PARAM_STR);
                $con_select->execute();
                
                if ($con_select->rowCount() === 1) {
                    $_SESSION["error_reg"]="Už jsi zaregistrovan, přihlaš se";
                    unset_pass($pass_reg, $pass_cont_reg);
                }
                else{
                    $hash_cont = hash('sha512', $pass_reg) . hash('sha256', $pass_reg) . hash("whirlpool", $pass_reg);
                    $combo_cont = substr($hash_cont,119);
                    $sql = "INSERT INTO users(id, surname, name, mail, pass, who) VALUES (:id, :surname, :name, :mail, :pass, :who)";
                    $con = $db->prepare($sql);
                    $con->bindValue(":id", null, PDO::PARAM_INT);
                    $con->bindValue(":surname", $surname, PDO::PARAM_STR);
                    $con->bindValue(":name", $name, PDO::PARAM_STR);
                    $con->bindValue(":mail", $mail, PDO::PARAM_STR);
                    $con->bindValue(":pass", $combo_cont, PDO::PARAM_STR);
                    $con->bindValue(":who", "User", PDO::PARAM_STR);
                    $zaznam = $con->execute();
                    $_SESSION["norm"] = "Odesláno";
                    unset($_SESSION["error_reg"]); 
                    unset_pass($pass_reg, $pass_cont_reg);
                    }
            }
            else{
                $_SESSION["error_reg"]="Hesla se neshodují";
                $_SESSION["data"] = $_POST;
            } 
        }
        else{
            $_SESSION["error_reg"] = "Heslo musisplnovat podminky hesla( velka a mala pismena, čislice )";
            $_SESSION["data"] = $_POST;
        }    
    } else {
        $_SESSION["error_reg"] = "Minimalni delka hesla je 8 znaku";
        $_SESSION["data"] = $_POST;
    }

}
var_dump($_SESSION);
header("location: reg_form.php");

?>