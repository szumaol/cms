<?php
function timeout($timeout) {
    if (!isset($_SESSION["id"])) {
        $_SESSION["error"] = "Nebyl jste přihlášen";
        header("Location: ../login/log_form.php");
        exit;
    }

    if (isset($_SESSION["last_activity"])) {
        $nonactive = time() - $_SESSION["last_activity"];
        if ($nonactive > $timeout) {
            unset($_SESSION["id"]);
            unset($_SESSION["email"]);
            unset($_SESSION["last_activity"]);
        
            $_SESSION["error"] = "Byl jste odhlášen z důvodu neaktivity";
            header("Location: ../login/log_form.php");
            exit;
        }
    }

    $_SESSION["last_activity"] = time();
}
$timeout = 300;
timeout($timeout);
?>