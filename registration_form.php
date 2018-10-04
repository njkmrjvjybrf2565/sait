<?php
require_once('phpmailer/PHPMailerAutoload.php');
$BD = mysqli_connect('localhost', 'root', '', 'testtt') OR DIE('Ошибка подключения к базе данных');
mysqli_query($BD,"SET NAMES utf8");

if(isset($_POST['Reg'])){
	$UserName = mysqli_real_escape_string($BD, $_POST['UserName']);
	$Email = mysqli_real_escape_string($BD, $_POST['email']);
	$Password1 = mysqli_real_escape_string($BD, $_POST['Password1']);
	$Password2 = mysqli_real_escape_string($BD, $_POST['Password2']);
	if(!empty($UserName) && !empty($Email) && !empty($Password1) && !empty($Password2) && ($Password1 == $Password2)) {
		$query = "SELECT * FROM `signup` WHERE username = '$UserName'";
		$qquery = "SELECT * FROM `signup` WHERE email = '$Email'";
		$data = mysqli_query($BD, $query);
		$data2 = mysqli_query($BD,$qquery);
		if((mysqli_num_rows($data) == 0) && (mysqli_num_rows($data2)==0)) {
			if(strlen($Password1)>=3 && strlen($Password2)>=3){
		
			}
			else
			{
				echo "<script>alert(\"Короткий пароль!\");</script>";
				exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');
			}
		if(preg_match('|[0-9]+|isUS', $Password1) && preg_match('|[A-Za-z]+|isUS', $Password1) &&
		   preg_match('|[0-9]+|isUS', $Password2) && preg_match('|[A-Za-z]+|isUS', $Password2)){ 
				//preg_match — Выполняет проверку на соответствие регулярному выражению
			}
			else {
				echo "<script>alert(\"Пароль должен содержать латинские буквы и цифры!\");</script>";
				exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');
			}
			$query ="INSERT INTO `signup` (username,email,password) VALUES ('$UserName','$Email' , SHA('$Password2'))";
			mysqli_query($BD,$query);

			$mail = new PHPMailer;
			$mail->CharSet = 'utf-8';
			$mail->isSMTP();
			$mail->Host = 'smtp.mail.ru';  																							
			$mail->SMTPAuth = true;                               
			$mail->Username = 'tokimekichika2565@mail.ru'; 
			$mail->Password = 's2679908lavi25';
			$mail->SMTPSecure = 'ssl';                           
			$mail->Port = 465; 
			$mail->setFrom('tokimekichika2565@mail.ru'); 
			$mail->addAddress($Email);
			$mail->isHTML(true);

			$mail->Subject = 'Потверждение!';
			$mail->Body    = '' .$UserName . ' , Ваша почта ' .$Email. '</br> Для завершения регистрации перейдите по' .
			 ' <a href ="http://localhost/app/main_form.php">этой ссылке</a>';
			$mail->AltBody = '';

			if(!$mail->send()) {
				echo "<script>alert(\"Письмо не отправилось!\");</script>";
			} else {
				header('location: verification.html');
			}
			mysqli_close($BD);
		}
		else if((mysqli_num_rows($data2) >= 1)&&(mysqli_num_rows($data) >= 1)){
			echo "<script>alert(\"Такой пользователь уже зарегистрирован!\");</script>";
		}
		else if (mysqli_num_rows($data2) >= 1){
			echo "<script>alert(\"Такая почта уже существует!\");</script>";
		}
		else if (mysqli_num_rows($data) >= 1) {
			echo "<script>alert(\"Такой логин уже зарегистрирован!\");</script>";
		}
	}
	else if (empty($UserName) || empty($Email) || empty($Password1) || empty($Password2))
	{
		echo "<script>alert(\"Заполните все пустые поля!\");</script>";
		exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');	
	}
	else if (($Password1) <> ($Password2))
	{
		echo "<script>alert(\"Пароли не совпадают!\");</script>";
		exit('<meta http-equiv="refresh" content="0; url=registration_form.php" />');
	}
} 

if(isset($_POST['Reg'])) {
	if (empty($UserName) or empty($Password1) or empty($Password2) or empty($Email))
		{ 
			echo "<script>alert(\"Введите данные!\");</script>"; 
		}
}
    

if(isset($_POST['nazad'])) {
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
	<form method = "POST" autocomplete ="off"> 
<div class = "oglav">
	Регистрация 
</div>
		<div class="dws-input" >
			<input type="text" name="UserName" placeholder="Введите логин">
		</div>
		<div class="dws-input">
			<input type="email" name="email" placeholder="Введите почту">
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