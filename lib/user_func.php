<?php
function all_users(){
    global $db;
    $sql_data= "SELECT * FROM users";
    $con_data = $db->prepare($sql_data);
    $con_data->execute();
    $data = $con_data->fetchAll(PDO::FETCH_ASSOC);
            echo "<table class='table table-striped-columns'>";
            foreach ($data as $rad) {
                echo "<tr>"; 
                    echo "<td>" . $rad["id"] . "</td>";
                    echo "<td>" . $rad["surname"] . "</td>";
                    echo "<td>" . $rad["name"] . "</td>";
                    echo "<td>" . $rad["mail"] . "</td>";
                    echo "<td>" . $rad["who"] . "</td>";
                    if (isset($rad["who"]) AND !empty($rad["who"])) {
                        $who = $rad["who"];
                    }
                    echo "<td>". "<form method='post' action='../action/update_user.php'>
                            <input type='hidden' name='id' value='" . $rad["id"] . "'>
                            <select name='new_role'>
                                <option value='Admin'>Admin</option>
                                <option value='Editor'>Editor</option>
                                <option value='User'>User</option>
                            </select>
                            <input class='btn btn-success' style='margin-left: 10px;' type='submit'>
                        </form>";
                    echo  "</td>";
                    echo "<td>". "<a class='btn btn-danger' href=\"main.php?page=users&del=" . $rad["id"] . "\">Smazat</a>" . "</td>";
                echo "</tr>";
                }
            echo "</table>";
            }

function do_del($delet, $table_del) {
    global $db;
    $sql = "DELETE FROM $table_del WHERE id = :id";
    $con = $db->prepare($sql);
    $con->bindValue(":id", $delet, PDO::PARAM_INT);
    $con->execute();
    }  


function tabulka($id_z_tabulky, $tab){
    global $db;
        $sql = "SELECT * FROM $tab WHERE id = :id";
        $con = $db->prepare($sql);
        $con->bindValue(":id", $id_z_tabulky, PDO::PARAM_INT);
        $con->execute();
        $jidlo = $con->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["data"] = $jidlo[0];
        return $_SESSION["data"];
        //var_dump($_SESSION["data"]);
}

function call_all($page){
    if (isset($_GET["id"]) AND $page == "menu") {
        # code...
        tabulka($_GET["id"], "menu");
        //unset($_GET["id"]);
    }

    if (isset($_GET["man"]) AND $page == "myinfo") {
        tabulka($_GET["man"], "users");
    }

    if (isset($_GET["del"]) AND $page="menu") {
        # code...
        do_del($_GET["del"], "menu");
    }

    if (isset($_GET["del"]) AND $page="users") {
        # code...
        do_del($_GET["del"], "users");
    }
}
?>