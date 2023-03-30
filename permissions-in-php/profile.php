<?php session_start(); ?>
<meta charset="utf-8">
<?php
    $host = 'localhost'; 
    $user = 'root';      
    $pass = '';          
    $name = 'usersDB';      
    
    $link = mysqli_connect($host, $user, $pass, $name);
    mysqli_query($link, "SET NAMES 'utf-8'");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT name, birthday, login, surname,
        patronymic, status_id FROM users2 WHERE id='$id'";
        $user = mysqli_fetch_assoc(mysqli_query($link,$query));
        $age = floor((time() - strtotime($user['birthday']))/60/60/24/365);
    }
?>

<ul>
    <li>login: <?php echo $user['login'] ?></li>
    <li>Статус: <?php echo $user['status_id'] ?></li>
    <li>Фамилия: <?php echo $user['surname'] ?></li>
    <li>Имя: <?php echo $user['name'] ?></li>
    <li>Отчество: <?php echo $user['patronymic'] ?></li>
    <li>Дата рождения: <?php echo $user['birthday'] ?></li>
    <li>Возраст: <?php echo $age ?></li>
</ul>