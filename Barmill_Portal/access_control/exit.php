<?php
	setcookie('name', $user['name'], time() - 3600, "/");
	header('Location:../index.php');
?>