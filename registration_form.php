<?php
//error_reporting(0);
$BD = mysqli_connect('localhost', 'root', '', 'testtt') OR DIE('Ошибка подключения к базе данных');
if(isset($_POST['Reg'])){
	$UserName = mysqli_real_escape_string($BD, trim($_POST['UserName']));
	$Password1 = mysqli_real_escape_string($BD, trim($_POST['Password1']));
	$Password2 = mysqli_real_escape_string($BD, trim($_POST['Password2']));
	if(!empty($UserName) && !empty($Password1) && !empty($Password2) && ($Password1 == $Password2)) {
		$query = "SELECT * FROM `signup` WHERE username = '$UserName'";
		$data = mysqli_query($BD, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `signup` (username, password) VALUES ('$UserName', SHA('$Password2'))";
			mysqli_query($BD,$query);
			echo 'Всё готово, можете авторизоваться';
			mysqli_close($BD);
			exit();
		}
		else {
			echo 'Логин уже существует';
		}
	}
}

if(isset($_POST['Reg'])){
if (empty($UserName) or empty($Password1) or empty($Password2))
    { 
        echo "<script>alert(\"Введите данные!\");</script>"; 
    }
}
    

if(isset($_POST['nazad'])){
	//require("main_form.php");
    exit('<meta http-equiv="refresh" content="0; url=main_form.php" />');
}

?>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Регистриция</title>
	<link rel="stylesheet" href="css/style_registration_form.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
</head>
<body>
<div class="container">
	<form method = "POST">
		<div class="dws-input" action = "main_form.php">
			<input type="text" name="UserName" placeholder="Введите логин">
		</div>
		<div class="dws-input">
			<input type="password" name="Password1" placeholder="Введите пароль">
        </div>
        <div class="dws-input">
			<input type="password" name="Password2" placeholder="Подтвердите пароль">
		</div>
		<input class="dws-submit" type="submit" name="Reg" value="Зарегестрироваться">
        <input class="dws-submit" type="submit" name="nazad" value="Назад">
	</form>
</div>
</body>
</html>