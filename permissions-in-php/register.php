<?php session_start(); ?>
<meta charset="utf-8">
<?php
    $host = 'localhost'; 
    $user = 'root';      
    $pass = '';          
    $name = 'usersDB';      
    
    $link = mysqli_connect($host, $user, $pass, $name);
    mysqli_query($link, "SET NAMES 'utf-8'");
?>
<h2>Регистрация</h2>

<?php    
    if (!empty($_POST['login']) and !empty($_POST['password']) 
    and !empty($_POST['email']) and !empty($_POST['birthday'])
     and !empty($_POST['confirm']) and !empty($_POST['country'])
     and !empty($_POST['name']) and !empty($_POST['surname'])
     and !empty($_POST['patronymic'])) {
        if($_POST['password'] == $_POST['confirm']){

        //   function generateSalt(){
        //     $salt = '';
        //     $saltLength = 8; 
        //     for($i = 0; $i < $saltLength; $i++) {
        //       $salt .= chr(mt_rand(33, 126)); 
        //     } return $salt; 
        //   }
        // $salt = generateSalt(); 
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $patronymic = $_POST['patronymic'];
	      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  
		    $login = $_POST['login'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $country = $_POST['country'];
        $dr = date('H:i:s d.m.Y');

        if((preg_match('#[\w]{4,10}#', $login)!=0)){
            if((preg_match('#[\w\*\^\?\#\@\!\&\$]{6,12}#', $password)!=0)){
                if((preg_match('#[.+@.+\..+]#', $email)!=0)){
                    if((preg_match('#\d{2}\.\d{2}\.\d{4}#', $birthday)!=0)){

        $query = "SELECT * FROM users2 WHERE login='$login'";
        $user = mysqli_fetch_assoc(mysqli_query($link,$query));

      if(empty($user)){
		    $query = "INSERT INTO 
			users2 SET login='$login', 
			password='$password', email='$email', 
			birthday='$birthday', date_registration='$dr',
      country='$country', name='$name', surname='$surname',
      patronymic='$patronymic', status_id='1'"; 
		  mysqli_query($link, $query);

        $_SESSION['auth'] = true;
        $id = mysqli_insert_id($link);
        $_SESSION['id'] = $id;

		    $_SESSION['reg_log'] = $_POST['login'];
        $_SESSION['reg_pass'] = $_POST['password'];

        header('Location: login.php');

	} else { echo 'к сожалению логин занят, попробуйте другой';}
}else {$error_date = 'введите дату в формате дд.мм.гггг';}
}else { $error_email = 'введите корректный email';}
} else { $error_pass = 'пароль должен содержать буквы, символы или цифры от 6 до 12 знаков';}
}else { $error_log = 'логин должен состоять из латинских букв и цифр длинной от 4 до 10 символов';} 
} else { echo 'введённые пароли не совпадают';}
} ?>

<form action="" method="POST">

	<p>Введите логин: <input name="login" value="<?php if(isset($_POST['login'])){
		echo $_POST['login']; }?>"> <?php if(isset($error_log)){ echo $error_log; unset($error_log);}?></p>
	
    <p>Введите пароль: <input name="password" type="password" value="<?php if(isset($_POST['password'])){
		echo $_POST['password']; }?>"> <?php if(isset($error_pass)){ echo $error_pass; unset($error_pass);}?></p>
    
    <p>Подтвердите пароль: <input type="password" name="confirm" value="<?php if(isset($_POST['confirm'])){
		echo $_POST['confirm']; }?>"></p>

    <p>Введите вашу фамилию: <input name="surname" value="<?php if(isset($_POST['surname'])){
		echo $_POST['surname']; }?>"></p>

    <p>Введите ваше имя: <input name="name" value="<?php if(isset($_POST['name'])){
		echo $_POST['name']; }?>"></p>

    <p>Введите ваше отчество: <input name="patronymic" value="<?php if(isset($_POST['patronymic'])){
		echo $_POST['patronymic']; }?>"></p>
    
    <p>Введите ваш email: <input name="email" value="<?php if(isset($_POST['email'])){
		echo $_POST['email']; }?>"> <?php if(isset($error_email)){ echo $error_email; unset($error_email);}?> </p>
    
    <p>Введите вашу дату рождения в формате дд.мм.гггг: <input name="birthday" value="<?php if(isset($_POST['birthday'])){
		echo $_POST['birthday']; }?>"> <?php if(isset($error_date)){ echo $error_date; unset($error_date);}?> </p>
    
    <p>Выберите вашу страну проживания: <select name="country">
	    <option>Россия</option>
	    <option>Беларусь</option>
	    <option>Украина</option>
	    <option>Грузия</option>
      <option>Южная Корея</option>
      <option>США</option>
      <option>Аргентина</option>
      <option>Швейцария</option>
      <option>Канада</option>
      <option>Армения</option>
      <option>Великобритания</option>
    </select></p>
	
    <p><input type="submit" value="подтвердить регистрацию"></p>
</form>