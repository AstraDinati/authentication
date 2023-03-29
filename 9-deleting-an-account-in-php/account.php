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
    
    $id = $_SESSION['id'];
	$query = "SELECT * FROM users2 
		WHERE id='$id'"; 
	
	$result = mysqli_query($link, $query);
	$user = mysqli_fetch_assoc($result);
?>

<form action="" method="POST">
    <p>Введите новую фамилию: <input name="surname" 
		value="<?= $user['surname'] ?>"></p>

	<p>Введите новое имя: <input name="name" 
		value="<?= $user['name'] ?>"></p>

    <p>Введите новое отчество: <input name="patronymic" 
		value="<?= $user['patronymic'] ?>"></p>
        
	<input type="submit" name="submit">
</form>

<p><a href="changePassword.php">сменить пароль</a></p>

<p><a href="deleteAccount.php">удалить аккаунт</a></p>

<?php
	if (!empty($_POST['submit'])) {
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		
		$query = "UPDATE users 
			SET name='$name', surname='$surname',
            patronymic='$patronymic' 
			WHERE id=$id"; 
		mysqli_query($link, $query);
	}
?>