<?php

if(isset($_POST['reg'])){
	//require("registration_form.php");
    exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');
}

if(isset($_POST['avt'])){
	if (empty($_SESSION['username']) or empty($_SESSION['password'])) 
		{ 
			echo "<script>alert(\"Введите данные!\");</script>"; 
		}
	}

?>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главная страница</title>
	<link rel="stylesheet" href="css/style_main_form.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
</head>
<body>
<div class="container">
	<img src="img/user.jpg">
	<form method = "POST">
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