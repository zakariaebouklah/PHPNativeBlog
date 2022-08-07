
<?php
    require_once("./foo/dbConn.php");

    $articles = [];

    $sql = "select * from article order by created_at desc limit 10";
    $statement = $pdo->query($sql);
    $statement->execute();
    $articles = $statement->fetchAll();
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
    <h1>Welcome To Our Mini Blog</h1>
    <a href="SignIn.php">Sign In</a>
    <br/>
    <a href="LogIn.php">Log In</a>
    <div>
        <?php
            if(count($articles) > 0){
                echo "Latest Articles : <br>";
                foreach ($articles as $article){
                    printf('<hr/><hr/><div>
                               <div class="title"><a href="showArticle.php?post_id=%d">%s</a></div>
                               <div class="content">%s</div>
                    </div>', $article['id'], $article['title'], $article['content']);
                }
            }else{
                echo "No Articles";
            }
        ?>
    </div>
</body>
</html>
