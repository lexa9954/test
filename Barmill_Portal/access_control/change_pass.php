<?php
	session_start();
	$old_pass = filter_var(trim($_POST['old_pass']), FILTER_SANITIZE_STRING);
	$new_pass = filter_var(trim($_POST["new_pass"]), FILTER_SANITIZE_STRING);

$hash_old_pass = md5($old_pass);
$hash_new_pass = md5($new_pass);

require "../sql_connect.php";

$AMEI = $_COOKIE['AMEI'];
	
$sql = "SELECT pass FROM login WHERE AMEI = '$AMEI'";
$stmt = sqlsrv_query( $conn, $sql);

$sqlData = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);	

	if($hash_old_pass == $sqlData['pass']){
		unset($_SESSION['wrongPass']);
		$_SESSION['correctPass'] = "Пароль изменён спешно!";
		$sql = "UPDATE login SET pass = '$hash_new_pass' WHERE AMEI = '$AMEI'";
		$stmt = sqlsrv_query( $conn, $sql);
	}else{
		unset($_SESSION['correctPass']);
		$_SESSION['wrongPass'] = "Пароль не изменён!<br>Так как прежний пароль введён неправильно.";
	}

sqlsrv_free_stmt($stmt);
header('Location:/gamburger/index.php?page=profile');
?>
