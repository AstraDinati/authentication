<?php 
session_start();
if (!empty($_SESSION['auth']) and $_SESSION['status_id'] === '2') {
		echo 'hello';
}