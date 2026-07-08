<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <style>
        .text{
            justify-content: center;
            display: flex;
            font-family: "DM Sans", sans-serif;
            font-style: normal;
            font-weight: 600;
            font-display: auto;
            color: #b8afa6;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .text-spec{
            justify-content: center;
            display: flex;
            font-family: "DM Sans", sans-serif;
            font-style: normal;
            font-weight: 300;
            font-display: auto;
            color: #e6cfa7;
            margin-top: 0;
            margin-bottom: 5px;
        }

        body{
            background-color: rgba(38, 34, 35, 1);
        }

        .box{
            margin-bottom: 35px;
        }

        .menu{
            font-size: 100px;
            color: #b8afa6;
            display: flex;
            justify-content: center;
            margin: 10px;
        }

        .page{
            display: inline-block;
            border-radius: 4px;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 18px;
            padding-right: 18px;
        }

        a:link {
            text-decoration: none;
            color: #ffffff;
            background-color: #443b3c;
            border: 1.5px solid rgba(255, 255, 255, 1);

        }

        a:visited {
            text-decoration: none;
            color: #ffffff;
            background-color: #443b3c;
            border: 1.5px solid rgba(255, 255, 255, 1);
        }

        a:hover{
            color: #5c5052;
            background-color: #ffffff;
            border-color: #ffffff;
        }

        .page_box {
            display: flex;
            justify-content: center;
            gap: 10px;             
            margin-top: 40px;      
            margin-bottom: 40px;   
            width: 100%;
        }
    </style>
</head>
<body>
<h1 class="menu">MENU</h1>
<?php
    $sql_data= "SELECT * FROM menu ORDER BY id ASC";
    $con_data = $db->prepare($sql_data);
    $con_data->execute();
    $data_one = $con_data->fetchAll(PDO::FETCH_ASSOC);
    $id = 1;
        foreach ($data_one as $rad) {
            echo "<div class='box'>";
            echo "<p class='text'>" . $id . ". " . $rad["nazev"] . "</p>";
            echo "<p class='text-spec'>" . $rad["popis"] . "</p>";
            echo "<p class='text'>" . $rad["cena"] . " Kč" . "</p>";
            echo "</div>";
            $id++;
        }

    $data = $db->query("SELECT COUNT(*) FROM menu")->fetchAll(PDO::FETCH_ASSOC);
    $pg = ceil($data[0]["COUNT(*)"] / 5);
echo "<div class='page_box'>";
    for ($i = 1; $i < $pg + 1; $i++) { 
        echo "<a class='page' href=\"userind.php?site=$i\"> $i </a>";
    }
echo "</div>";
    if (isset($_GET["site"]) AND is_numeric($_GET["site"])) {
        $p = $_GET["site"];
    } else {
        $p = 1;
    }
    $e = ($p - 1) * 5;
?>
</body>
</html>