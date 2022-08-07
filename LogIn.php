
<?php
    require_once("./foo/dbConn.php");
    session_start();

    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    $errorInLogIn = "";

    if($username && $password){
        $sql = "select * from user where username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("username", $username);
        $statement->execute();
        $users = $statement->fetch(PDO::FETCH_ASSOC);

        if(count($users) > 0 && password_verify($password, $users["password"])){
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["userName"] = $username;
            $_SESSION["id_user"] = $users["id"];
            header("Location: Home.php");
            exit;
        }else{
            $errorInLogIn = "**Username or Password Incorrect!!!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login In Page</title>
</head>
<body>
<form method="post">
    <label for="username">Username: </label>
    <input type="text" name="username" value="<?php echo $username ?>"/>
    <hr>
    <label for="password">Password: </label>
    <input type="password" name="password" value="<?php echo $password ?>"/>
    <hr>
    <input type="submit" value="Submit"/>
    <div>
        <?= $errorInLogIn ?>
    </div>
</form>
</body>
</html>
