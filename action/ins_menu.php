<?php
session_start();
include "../db.php";
$_SESSION["error"] = "";

if (isset($_POST["nazev"])) {
    if (empty($_POST["nazev"])) {
        $_SESSION["error"] = "Error, nevyplneny nazev";
    }
}

if (isset($_POST["popis"])) {
    if (empty($_POST["popis"])) {
        $_SESSION["error"] = "Error, nevyplneny popis";
    }
}

if (isset($_POST["cena"])) {
    if (empty($_POST["cena"])) {
        $_SESSION["error"] = "Error, nevyplnena cena";
    }
}
if (!(empty($_POST["id"])) AND is_numeric($_POST["id"]) AND empty($_SESSION["error"])) {
    # code...
            $sql = "UPDATE menu SET 
            id = :id, 
            nazev = :nazev, 
            popis = :popis, 
            cena = :cena 
            WHERE id = :id";
                $update_menu = $db->prepare($sql);
                $update_menu->bindValue(":id", $_POST["id"], PDO::PARAM_INT);
                $update_menu->bindValue(":nazev", $_POST["nazev"], PDO::PARAM_STR);  
                $update_menu->bindValue(":popis", $_POST["popis"], PDO::PARAM_STR);
                $update_menu->bindValue(":cena", $_POST["cena"], PDO::PARAM_INT); 
                $update_menu->execute();
            if ($update_menu->rowCount() > 0) {
                $_SESSION["norm"] = "Aktualizovano";
                unset($_SESSION["error"]);
                var_dump($update_menu->rowCount());
                unset($_SESSION["data"]);
            }
} elseif (isset($_SESSION["error"]) AND empty($_SESSION["error"]) AND empty($_POST["id"]) AND isset($_POST["nazev"]) AND isset($_POST["popis"]) AND isset($_POST["cena"])) {
        $sql = "INSERT INTO menu(id, nazev, popis, cena) VALUES (:id, :nazev, :popis, :cena)";
        $zapis = $db->prepare($sql);
        $zapis->bindValue(":id", null, PDO::PARAM_INT);
        $zapis->bindValue(":nazev", $_POST["nazev"], PDO::PARAM_STR);  
        $zapis->bindValue(":popis", $_POST["popis"], PDO::PARAM_STR);
        $zapis->bindValue(":cena", $_POST["cena"], PDO::PARAM_INT); 
        $zapis->execute();
        $_SESSION["norm"] = "Do menu jste zadali novou polozku";
    }
header("location:../admin/main.php?page=menu");
exit;
?>