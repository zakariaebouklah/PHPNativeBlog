
<?php

    require_once("./foo/dbConn.php");
    session_start();

    $mail = $_POST['mail'] ?? "";
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    if($mail && $username && $password){
        $sql = "insert into user (email, username, password) values (:mail, :username, :password)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("mail",$mail);
        $statement->bindParam("username",$username);
        $statement->bindParam("password",$password);

        if ($statement->execute()){
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["userName"] = $username;
            header("Location: Home.php");
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
</head>
<body>
    <form method="post">
        <label for="email">Email: </label>
        <input type="email" name="mail" value="<?php echo $mail ?>"/>
        <hr>
        <label for="username">Username: </label>
        <input type="text" name="username" value="<?php echo $username ?>"/>
        <hr>
        <label for="password">Password: </label>
        <input type="password" name="password" value="<?php echo $password ?>"/>
        <hr>
        <input type="submit" value="Submit" />
    </form>
</body>
</html>