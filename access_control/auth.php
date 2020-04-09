<?php
	session_start();
	$AMEI = filter_var(trim($_POST['AMEI']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

$hash_pass = $pass;

require "../sql_connect.php";

$sql = "SELECT * FROM login WHERE AMEI = '$AMEI' AND pass = '$pass'";
$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

$user = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	if(empty($user['AMEI'])){
	//unset($_SESSION['wrongPass']);
	//$_SESSION['correctPass'] = "Пароль изменён спешно!";
	$_SESSION['loginError'] = "Не верный пароль<br>или имя пользователя.";
	//echo "Такой пользователь не найден";
	}else{
	unset($_SESSION['loginError']);
	//$_SESSION['loginError'] = "Не верный пароль<br>или имя пользователя.";
	//echo "Success";
	}

//exit();

setcookie('name', $user['name'], time() + 36000, "/");
setcookie('AMEI', $user['AMEI'], time() + 36000, "/");

sqlsrv_free_stmt( $stmt);
header('Location:../index.php');
?>