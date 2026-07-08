<?php
include "../db.php";
session_start();

if (!(empty($_POST["pass_login"]))) {
    $hash_login = hash('sha512', $_POST["pass_login"]) . hash('sha256', $_POST["pass_login"]) . hash("whirlpool", $_POST["pass_login"]);
    $combo = substr($hash_login, 119);
    unset($_POST["pass_login"]);
}

if (!(empty($_POST["mail_login"]))) {
        $mail_login = $_POST["mail_login"];

}

if (isset($combo) AND isset($mail_login)) {
    if (!(empty($combo)) AND !(empty($mail_login))) {
    $sql = "SELECT id, mail, who FROM users WHERE mail = :mail AND pass = :pass";
    $con_log = $db->prepare($sql);
    $con_log->bindValue(":mail", $mail_login, PDO::PARAM_STR);
    $con_log->bindValue(":pass", $combo, PDO::PARAM_STR);
    $con_log->execute();
    $user = $con_log->fetchAll(PDO::FETCH_ASSOC);
//var_dump($con_log);
//var_dump($data_one[0]["who"]);
    if ($con_log->rowCount() > 0) {
            $_SESSION["last_activity"] = time();
            $_SESSION["who"] = $user[0]["who"];
            $_SESSION["id"] = $user[0]["id"];
        if ($_SESSION["who"] == "User") {
            # code...
            $_SESSION["error"] = "Zatim nemate udelený přistup";
            header("location:log_form.php");
            exit;
        }
        else{
            header("location:../admin/main.php");
            exit;   
        }
 
    } else {
        $_SESSION["error"] = "<p>Nesprávný e-mail nebo heslo</p>";
    }
}

} else {
    $_SESSION["error"] = "<p>Vyplňte prosím přihlašovací údaje</p>";
}
header("location:log_form.php");
exit;
?>