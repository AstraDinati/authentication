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
<h2>Авторизация</h2>
<form action="" method="POST">
	<p>Введите логин: <input name="login"  value="<?php if(isset($_SESSION['reg_log'])){
		echo $_SESSION['reg_log']; }?>"></p>
	<p>Введте пароль<input name="password" type="password" value="<?php if(isset($_SESSION['reg_pass'])){
		echo $_SESSION['reg_pass']; }?>"></p>
	<p><input type="submit"></p>
</form>


<?php
	unset($_SESSION['reg_pass']);
	unset($_SESSION['reg_log']);
	if (!empty($_POST['password']) and !empty($_POST['login'])) {
		$login = $_POST['login'];
		
		$query = "SELECT * 
			FROM users2 WHERE login='$login'"; 
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		
		if (!empty($user)) {
			$hash = $user['password'];

			if(password_verify($_POST['password'], $hash)){
				$_SESSION['auth'] = true;
				$_SESSION['login'] = $_POST['login'];
				header('Location: index.php');

			} else { echo 'неверно введён логин или пароль'; }
		} else { echo 'неверно введён логин или пароль'; }
	}