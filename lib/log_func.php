<?php

function error(){
        if (isset($_SESSION["error"]) AND !empty($_SESSION["error"])) {
        # code...
        echo "<h1 class='h1'>" . $_SESSION["error"] . "</h1>";
        unset($_SESSION["error"]);
    }
}

function unset_pass($pass_reg, $pass_cont_reg){
    unset($pass_cont_reg);
    unset($pass_reg);
    unset($_POST["pass_reg"]);
    unset($_POST["pass_cont_reg"]);
}

function manual_logout() {
    session_start();
    session_unset();
    session_destroy();

    session_start();
    $_SESSION["error"] = "Byl jste úspěšně odhlášen";
    header("Location: ../login/log_form.php");
    exit;
}

?>