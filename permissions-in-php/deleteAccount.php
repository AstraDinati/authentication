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
    <form method="POST">
        <p>Введите пароль: <input type="password" name="password"></p>
        <input type="submit">
    </form>

    <?php
    if (isset($_POST['password'])) {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM users2 WHERE id='$id'";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($result);

        $hash = $user['password'];

        if (password_verify($_POST['password'], $hash)) {
            $query = "DELETE FROM users2 WHERE id='$id'";
            mysqli_query($link, $query);

            $_SESSION['auth'] = false;
            header('Location: index.php');
        } else {
            echo 'неверный пароль';
        }
    }
    ?>
</body>

</html>