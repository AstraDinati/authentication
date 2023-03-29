<?php 
session_start();
if (!empty($_SESSION['auth'])) {
		echo 'hi';
}