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
<ul>
	<?php 
	$query = 'SELECT login, id FROM users2';
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
		foreach($data as $key => $arr){ ?>
		    <li><a href="profile.php/?id=<?= $arr['id']?>"><?= $arr['login'] ?></a></li>
	<?php } ?>
</ul>