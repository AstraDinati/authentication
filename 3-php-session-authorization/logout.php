<?php
	session_start();
	$_SESSION['auth'] = null;
    $_SESSION['logout'] = 'вы разлогинились';
    header('Location: index.php');
?>