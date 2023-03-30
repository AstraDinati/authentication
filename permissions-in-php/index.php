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
    <p><?php for ($i = 1; $i <= 3; ++$i) { ?>
            <a href="<?= $i ?>.php"><?= $i ?></a>
        <?php } ?>
    </p>
    <?php
    if (!empty($_SESSION['auth'])) { ?>
        <p><a href="users.php">список пользователей</a></p>
        <p><a href="account.php">редактировать профиль</a></p>
        <p><a href="logout.php">выйти из аккаунта</a></p>
    <?php } else { ?>

        <p><?php
            if (!empty($_SESSION['logout'])) {
                echo $_SESSION['logout'];
                unset($_SESSION['logout']);
            } ?></p>

        <p><a href="login.php">авторизоваться</a></p>
        <p><a href="register.php">зарегистрироваться</a></p> <?php } ?>


    <p>это видят даже не авторизованные пользователи</p>
</body>

</html>