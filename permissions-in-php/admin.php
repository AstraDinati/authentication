<?php
session_start();
?>
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
        $query = "SELECT login, status_id FROM users2 WHERE id=$id";
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));
    ?>
        login: <a href="profile.php?id=<?= $id ?>"><?php echo $user['login']; ?></a><br>
        status: <?php echo $user['status_id'];
            } ?>
</head>

<body>
    <table>
        <tr>
            <th>логин</th>
            <th>статус</th>
            <th>изменить права</th>
            <th>удалить</th>
        </tr>
        <?php
        $query = 'SELECT login, id, status_id FROM users2';
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        foreach ($data as $key => $arr) {
            $id = $arr['id'];
            $login = $arr['login'];
            $status = $arr['status_id']; ?>
            <tr>
                <td><a href="profile.php/?id=<?= $id ?>"><?= $login ?></a></td>
                <td><?= $status ?></td>
                <td><a href="?edit=<?= $id ?>"><?php if ($status == 2) {
                                                    echo 'сделать юзером';
                                                } else {
                                                    echo 'сделать админом';
                                                } ?>
                    </a></td>
                <td><a href="?delete=<?= $id ?>">удалить</a></td>
            </tr>
        <?php } ?>
    </table>

    <?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM users2 WHERE id=$id";
        mysqli_query($link, $query) or die(mysqli_error($link));
        header('Location: admin.php');
    }
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $query = "SELECT status_id FROM users2 WHERE id=$id";
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));
        if ($user['status_id'] == 2) {
            $query = "UPDATE users2 SET status_id='1' WHERE id=$id";
            mysqli_query($link, $query) or die(mysqli_error($link));
            header('Location: admin.php');
        } else {
            $query = "UPDATE users2 SET status_id='2' WHERE id=$id";
            mysqli_query($link, $query) or die(mysqli_error($link));
            header('Location: admin.php');
        }
    } ?>
</body>

</html>