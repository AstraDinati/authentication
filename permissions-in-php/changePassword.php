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
        $query = "SELECT login, status_id FROM users2 WHERE id=$id";
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));
    ?>
        login: <a href="profile.php?id=<?= $id ?>"><?php echo $user['login']; ?></a><br>
        status: <?php echo $user['status_id'];
            } ?><br>
    <?php if ($_SESSION['status_id'] == '2') {
    ?>
        <a href="admin.php">админка</a>
    <?php }
    ?>
</head>

<body>
    <form action="" method="POST">
        <p>введите старый пароль: <input type="password" name="old_password"></p>
        <p>введите новый пароль: <input type="password" name="new_password"></p>
        <p>введите новый пароль ещё раз: <input type="password" name="new_password_confirm"></p>
        <input type="submit" name="submit">
    </form>
    <?php
    if (
        !empty($_POST['old_password']) and
        !empty($_POST['new_password']) and
        !empty($_POST['new_password_confirm'])
    ) {
        if ($_POST['new_password'] == $_POST['new_password_confirm']) {
            $id = $_SESSION['id'];
            $query = "SELECT * FROM users2 WHERE id='$id'";

            $result = mysqli_query($link, $query);
            $user = mysqli_fetch_assoc($result);

            $hash = $user['password'];

            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            if (password_verify($oldPassword, $hash)) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE users2 SET password='$newPasswordHash' 
			WHERE id='$id'";
                mysqli_query($link, $query);
                echo 'пароль успешно изменён!';
            } else {
                echo 'старый и новый пароли не совпадают';
            }
        } else {
            echo 'введённые пароли не совпадают';
        }
    }
    ?>
</body>

</html>