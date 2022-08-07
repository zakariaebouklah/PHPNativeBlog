<?php
    require_once("./foo/dbConn.php");
    require_once("./foo/sessionVerify.php");

    $id = $_GET["post_id"] ?? null;

    if($id !== null){
        $sql = "delete from article where id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("id", $id);
        $statement->execute();
    }

    header("Location: Home.php");
    exit;