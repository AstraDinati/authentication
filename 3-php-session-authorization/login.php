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
<form action="" method="POST">
	<input name="login">
	<input name="password" type="password">
	<input type="submit">
</form>

<?php
	if (!empty($_POST['password']) and !empty($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$query = "SELECT * 
			FROM users WHERE login='$login' 
			AND password='$password'"; 
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		
		if (!empty($user)) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $_POST['login'];
            header('Location: index.php');
		} else {
			echo 'неверно ввел логин или пароль';
		}
	}
for($i=1;$i<=3;++$i){ ?>
<a href="<?= $i?>.php"><?= $i ?></a>
<?php } ?>