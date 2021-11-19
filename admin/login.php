<?php require_once '../inc/config.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="name" placeholder="name">
    <br>
    <input type="password" name="password" placeholder="password">
    <br>
    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $pass = $_POST['password'];
    $query = mysqli_query($connection, "SELECT * FROM admins WHERE name='$name' AND password ='$pass'");

    if (mysqli_num_rows($query) == 1){
      $_SESSION['admin'] = $name;
      header('Location: http://localhost/ecommerce/admin');

    }else{
        echo 'this not admin';
    }
}