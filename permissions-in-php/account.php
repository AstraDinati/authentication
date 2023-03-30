<?php
session_start(); ?>
<meta charset="utf-8">
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$name = 'usersDB';

$link = mysqli_connect($host, $user, $pass, $name);
mysqli_query($link, "SET NAMES 'utf-8'"); ?>
<!DOCTYPE html>
<html>

<head>
    <?php
    if (!empty($_SESSION['auth'])) {
        $id = $_SESSION['id'];
        $status = $_SESSION['status'];
        $query = "SELECT login, status_id FROM users2 WHERE id=$id";
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));
    ?>
        login: <a href="profile.php?id=<?= $id ?>"><?php echo $user['login']; ?></a><br>
        status: <?php echo $status;
            } ?><br>
    <?php if ($_SESSION['status_id'] == '2') {
    ?>
        <a href="admin.php">админка</a>
    <?php }
    ?>
</head>
<?php
$id = $_SESSION['id'];
$query = "SELECT * FROM users2 
		WHERE id='$id'";

$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);
?>

<form action="" method="POST">
	<p>Введите новую фамилию: <input name="surname" value="<?php
															if (isset($_POST['surname'])) {
																echo $_POST['surname'];
															} else {
																echo $user['surname'];
															} ?>"></p>

	<p>Введите новое имя: <input name="name" value="<?php
													if (isset($_POST['name'])) {
														echo $_POST['name'];
													} else {
														echo $user['name'];
													} ?>"></p>

	<p>Введите новое отчество: <input name="patronymic" value="<?php
																if (isset($_POST['patronymic'])) {
																	echo $_POST['patronymic'];
																} else {
																	echo $user['patronymic'];
																} ?>"></p>

	<input type="submit" name="submit">
</form>

<?php
if (!empty($_POST['submit'])) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];

	$query = "UPDATE users2 
			SET name='$name', surname='$surname',
            patronymic='$patronymic' 
			WHERE id=$id";
	mysqli_query($link, $query);
	echo 'данные успешно изменнены';
}
?>

<p><a href="changePassword.php">сменить пароль</a></p>

<p><a href="deleteAccount.php">удалить аккаунт</a></p>

</body>

</html>