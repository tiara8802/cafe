<?php
include 'koneksi.php';

if(isset($_POST['login'])) {
    $username= $_POST['username'];
    $password= $_POST['password'];
    $login= mysqli_query($koneksi, "select * from user where username= '$username' and password= '$password'");
    if(mysqli_num_rows($login)> 0) {
        header("Location: dashboard.php ");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
       <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" id=""></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <input type="submit" name="login" value="login">
        </tr>
       </table>
    </form>
</body>
</html>