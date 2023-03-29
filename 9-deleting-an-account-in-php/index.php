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
    <p><a href="deleteAccount.php">удалить аккаунт</a></p>
	</head>
	<body>
		<p><?php for($i=1;$i<=3;++$i){ ?>
<a href="<?= $i?>.php"><?= $i ?></a>
<?php } ?></p>
		<?php
			if (!empty($_SESSION['auth'])) { ?>
			<p><a href="users.php">список пользователей</a></p>
			<p>вы авторизованы, ваш логин: <?= $_SESSION['login'] ?></p>
            <p><a href="account.php">редактировать профиль</a></p>
            <p><a href="logout.php">выйти из аккаунта</a></p>
			<?php } else { ?>

            <p><?php 
            if(!empty($_SESSION['logout'])){
                echo $_SESSION['logout'];
                unset($_SESSION['logout']);
            } ?></p>

            <p><a href="login.php">авторизоваться</a></p>
			<p><a href="register.php">зарегистрироваться</a></p> <?php } ?>
			
            
		<p>это видят даже не авторизованные пользователи</p>
	</body>
</html>