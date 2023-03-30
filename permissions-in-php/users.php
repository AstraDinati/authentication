<?php
session_start(); ?>
<meta charset="utf-8">
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$name = 'usersDB';

$link = mysqli_connect($host, $user, $pass, $name);
mysqli_query($link, "SET NAMES 'utf-8'");  ?>
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

<body>
	<h3>Пользователи: </h3>
	<ul>
		<?php
		$query = 'SELECT login, id FROM users2';
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
		foreach ($data as $key => $arr) { ?>
			<li><a href="profile.php/?id=<?= $arr['id'] ?>"><?= $arr['login'] ?></a></li>
		<?php } ?>
	</ul>
</body>

</html>