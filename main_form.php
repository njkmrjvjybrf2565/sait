<?php
function auth ($uname, $psw ) {
	$error = '';
	if(!$uname) {
		echo "<script>alert(\"Не указан логин!\");</script>";
		exit('<meta http-equiv="refresh" content="0; url=main_form.php" />');
    } 
    elseif(!$psw) {
		echo "<script>alert(\"Не указан пароль!\");</script>";
		exit('<meta http-equiv="refresh" content="0; url=main_form.php" />');
    }
	$BD = mysqli_connect('localhost', 'root', '', 'testtt') OR DIE('Ошибка подключения к базе данных');
	mysqli_query($BD,"SET NAMES utf8");
	$sql = "SELECT `user_id` FROM `signup` WHERE `username`='$uname' AND `password`=SHA('$psw')";
	$query = mysqli_query($BD, $sql) or 
		die("<p>Невозможно выполнить запрос: " . mysqli_error($BD) . ". Ошибка произошла в строке " . __LINE__ . "</p>");



	if(mysqli_num_rows($query) == 0) {
		/*$error = 'Пользователь с указанными данными не зарегистрирован';
		return $error;*/
		echo "<script>alert(\"Пользователь с указанными данными не существует! \");</script>";
		exit('<meta http-equiv="refresh" content="0; url=main_form.php" />');
	}

	return true;
}

if(isset($_POST['reg'])){
	require("registration_form.php");
	exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');
}   


if(isset($_POST['avt'])) {
	$uname = $_POST['username'];
	$psw = $_POST['password'];

	if (empty($uname) or empty($psw)) { 
		echo "<script>alert(\"Введите недостающие данные!\");</script>"; 
	}
	else {
		$auth_result = auth($uname, $psw);
		if ($auth_result === TRUE) {
			exit ('<meta http-equiv="refresh" content="0; url=ball.php" />');
		} else {
			echo $auth_result;
		}
	}		
}




// action = "" это - какой обработчик будет принимать данные с формы. пустые кавычки - оносительный путь
?>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главная страница</title>
	<link rel="stylesheet" href="css/style_main_form.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
</head>
<body >
<div class="container">
	<img src="img/user.jpg">
	<form method = "POST" autocomplete ="off">
		<div class="dws-input">
			<input type="text" name="username" placeholder="Введите логин">
		</div>
		<div class="dws-input">
			<input type="password" name="password" placeholder="Введите пароль"> 
		</div>
		<input  class="dws-submit" type="submit" name="reg" value="Регистрация">
		<input class="dws-submit" type="submit" name="avt" value="Авторизиция">
	</form>
	<div class="dws-social">
		<i class="fa fa-vk" aria-hidden="true"></i>
		<i class="fa fa-facebook" aria-hidden="true"></i>
	</div>
</div>
</body>
</html>