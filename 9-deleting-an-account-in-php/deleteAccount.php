<?php
session_start(); ?>
<meta charset="utf-8">
<?php
    $host = 'localhost'; 
    $user = 'root';      
    $pass = '';          
    $name = 'usersDB';      
    
    $link = mysqli_connect($host, $user, $pass, $name);
    mysqli_query($link, "SET NAMES 'utf-8'");  
?>

<form method="POST">
    <p>Введите пароль: <input type="password" name="password"></p>
    <input type="submit">
</form>

<?php 
$id = $_SESSION['id'];
$query = "SELECT * FROM users2 WHERE id='$id'"; 
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);
	
$hash = $user['password'];

if (password_verify($_POST['password'], $hash)) {
    $query = "DELETE FROM users2 WHERE id='$id'";
    $_SESSION['auth'] = false;
    header('Location: index.php');
} else {echo 'неверный пароль';} 
?>