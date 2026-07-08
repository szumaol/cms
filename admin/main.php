<?php
session_start();
include "../lib/user_func.php";
include "../db.php";
require "../action/time_odhlas.php";
$page = $_GET["page"] ?? "home";

call_all($page);
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="main.php?page=home">Domů</a>
                    <a class="nav-link" href="main.php?page=users">Uživatele</a>
                    <a class="nav-link" href="main.php?page=menu">Menu</a>
                    <a class="nav-link" href="main.php?page=myinfo">Moje udaje</a>
                    <a class="nav-link odhlas" href="../action/manual_logout.php">Odhlasit se</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        $who_loglog = "";
        if (isset($_SESSION["who"]) AND !empty($_SESSION["who"])) {
            # code...
            $who_loglog = $_SESSION["who"];
        
            switch($page){
                case "home":
                    echo "<h1>Úvodní stránka</h1>";
                    break;

                case "users":
                    if ($who_loglog == "Admin") {
                        # code...
                        echo "<h1>Users</h1>";
                        echo all_users();
                    }
                    break;

                case "menu":
                    echo "<h1>Správa menu</h1>";
                    ?>
                    <form action="../action/ins_menu.php" method="post">
                        <input type="hidden" name="id" value="<?= $_SESSION["data"]["id"] ?? ''?>">
                        <label class="form-label">Nazev</label>
                        <input class="form-control super_input" type="text" name="nazev" value="<?= $_SESSION["data"]["nazev"] ?? ''?>"><br>
                        <label class="form-label" for="popis">Popis</label>
                        <input class="form-control super_input" type="text" name="popis" value="<?= $_SESSION["data"]["popis"] ?? ''?>"><br>
                        <label class="form-label" for="cena">Cena</label>
                        <input class="form-control super_input" type="number" name="cena" value="<?= $_SESSION["data"]["cena"] ?? ''?>">
                        <input class="btn btn-primary super_button" type="submit" value="Odeslat">
                    </form>
                    <?php
                        $sql_data= "SELECT * FROM menu ORDER BY id ASC";
                        $con_data = $db->prepare($sql_data);
                        $con_data->execute();
                        $data_one = $con_data->fetchAll(PDO::FETCH_ASSOC);
                        echo "<table class='table table-success table-striped-columns'>";
                        $id = 1;
                            foreach ($data_one as $rad) {
                                echo "<tr>"; 
                                echo "<td>" . $id ."</td>";
                                echo "<td>" . $rad["nazev"] . "</td>";
                                echo "<td>" . $rad["popis"] . "</td>";
                                echo "<td>" . $rad["cena"] . "</td>";
                                echo "<td><a href=\"main.php?page=menu&id=" . $rad["id"] . "\">Upravit</a></td>";
                                echo "<td><a href=\"main.php?page=menu&del=" . $rad["id"] . "\">Smazat</a></td>";
                                //echo "<a >"
                                echo "</tr>";
                                $id++;
                            }
                        echo "</table>";
                    break;
                    case "myinfo":
                        echo "<h1>Moje udaje</h1>";
                        $sql_my= "SELECT * FROM users WHERE id = :id";
                        $con_my = $db->prepare($sql_my);
                        $con_my->bindValue(":id", $_SESSION["id"], PDO::PARAM_INT);
                        $con_my->execute();
                        $my_one = $con_my->fetchAll(PDO::FETCH_ASSOC);
                        echo "<table class='table table-success table-striped-columns'>";
                        $id = 1;
                            foreach ($my_one as $my_rad) {
                                echo "<tr>";
                                echo "<td>" . $my_rad["surname"] . "</td>";
                                echo "<td>" . $my_rad["name"] . "</td>";
                                echo "<td>" . $my_rad["mail"] . "</td>";
                                echo "<td>" . $my_rad["who"] . "</td>";
                                echo "<td><a href=\"main.php?page=myinfo&man=" . $my_rad["id"] . "\">Upravit</a></td>";
                                //echo "<a >"
                                echo "</tr>";
                                $id++;
                            }
                        echo "</table>";

                        if (isset($_GET["man"])) {
                            # code...
                            ?>
                            <form action="../action/update_my.php" method="post">
                                <input type="hidden" name="id" value="<?= $_SESSION["data"]["id"] ?? ''?>">
                                <label class='form-label' for="surname">Prijmeni</label>
                                <input class="form-control super_input" type="text" name="surname" value="<?= $_SESSION["data"]["surname"] ?? ''?>"><br>
                                <label class="form-label">Jmeno</label>
                                <input class="form-control super_input" type="text" name="name" value="<?= $_SESSION["data"]["name"] ?? ''?>"><br>
                                <label class="form-label" for="cena">Email</label>
                                <input class="form-control super_input" type="email" name="mail" value="<?= $_SESSION["data"]["mail"] ?? ''?>">
                                <input class="btn btn-primary super_button" type="submit" value="Odeslat">
                            </form>
                            <?php
                        }
            }
        }
        ?>
    </div>
</body>
</html>
