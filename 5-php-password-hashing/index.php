<?php
session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<p><?php for($i=1;$i<=3;++$i){ ?>
<a href="<?= $i?>.php"><?= $i ?></a>
<?php } ?></p>
		<?php
			if (!empty($_SESSION['auth'])) { ?>
			<p>это видят только крутые, авторизованные пользователи</p>
			<p>вы авторизованы, ваш логин: <?= $_SESSION['login'] ?></p>
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