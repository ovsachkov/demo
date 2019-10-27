<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	
	<div class="col-md-12">
	<?php 
		if(isset($data['admin'])){
			echo "Здравствуйте, " .  $data['admin'] ;
	?>
		<form method="post" action="">
			<input type="hidden" name="is_exit" value="1" />
			<input type="submit" class="btn btn-primary " value="Выйти" />
		</form>
	<?php
		}else{
	?>
	<form method="post" action="">
	
		Логин: <input class="input-group" type="text" name="login"
		value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null; // Заполняем поле по умолчанию ?>" />
		
		Пароль: <input class="input-group" type="password" name="password" value="" /><br/>
		<input type="submit" class="btn btn-primary " value="Войти" />
		
	</form>
	<?php 
	};
	?>
	<?php include 'application/views/'.$content_view;?>
	</div>
	
</body>
</html>
