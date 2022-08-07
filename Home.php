
<?php
    require_once("./foo/dbConn.php");
    require_once("./foo/sessionVerify.php");

    $username = $_SESSION["userName"];
    if($username){
        $sql = "select * from article where author = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("username", $username);
        $statement->execute();
        $own_articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <?= "<h1>You're Logged In!!</h1>" ?>
    <?= "<h1>This is the Home Page ! Welcome {$_SESSION["userName"]}</h1>" ?>
    <a style="margin-right: 5px;" href="AddArticle.php">Add New Article</a>
    <hr/>
    <hr/>
    <hr/>
    <div>
        Your Articles :
        <?php
            echo "<ul>";
            foreach ($own_articles as $article){
                echo "<li>" . $article["title"] . "</li>";
            }
            echo "</ul>";
        ?>
    </div>
    <hr/>
    <hr/>
    <hr/>
    <div>
        List Of People Articles :
    </div>
    <hr>
    <hr>
    <hr>
    <a style="margin-right: 5px;" href="LogOut.php">Log Out</a>
</body>
</html>