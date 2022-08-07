<?php

require_once("./foo/dbConn.php");

$id = $_GET['post_id'] ?? null;

if($id === null){
    header("Location: Accueil.php");
    exit;
}

$article = [];

$sql = "select * from article where id = :id";
$statement = $pdo->prepare($sql);
$statement->bindParam("id", $id);
$statement->execute();
$article = $statement->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <div>
        <?php
            if(count($article) > 0){
                echo "<h1>{$article["title"]}:</h1><br><hr>";
                echo "<h4>Article N°{$article["id"]}</h4><br><hr>";
                echo "<p>{$article["content"]}</p><br><hr>";
            }
        ?>
    </div>
</body>
</html>


