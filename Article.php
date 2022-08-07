
<?php
require_once("./foo/dbConn.php");
require_once("./foo/sessionVerify.php");

$title = $_POST["title"] ?? "";
$content = $_POST["content"] ?? "";
$id = $_GET["post_id"] ?? null ;

if ($title && $content){
    if($id === null){
        $id_author = $_SESSION["id_user"];

        $created_at = new DateTime();
        $dateTime = $created_at->format("Y-m-d H:i:s");

        $sql = "insert into article (title, content, created_at, id_author) value (:title, :content, :created_at, :id_author)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("title", $title);
        $statement->bindParam("content", $content);
        $statement->bindParam("created_at", $dateTime);
        $statement->bindParam("id_author", $id_author);
    }else{
        $sql = "update article set title = :title, content = :content where id = :id ";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("title", $title);
        $statement->bindParam("content", $content);
        $statement->bindParam("id", $id);
    }
    if($statement->execute()){
        header("Location: Home.php");
        exit;
    }
}else if($id !== null){
    $sql2 = "select * from article where id = :id";
    $statement2 = $pdo->prepare($sql2);
    $statement2->bindParam("id", $id);
    $statement2->execute();
    $article = $statement2->fetch();
    if($article === false){
        header("Location: Home.php");
        exit;
    }

    $title = $article["title"];
    $content = $article["content"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Article</title>
</head>
<body>
<form method="post">
    <label>Title: </label>
    <input type="text" name="title" value="<?= $title ?>"/>
    <hr>
    <label>Content: </label>
    <textarea name="content" cols="100" rows="10"><?= $content ?></textarea>
    <hr>
    <input type="submit" value="Add" />
</form>
</body>
</html>
