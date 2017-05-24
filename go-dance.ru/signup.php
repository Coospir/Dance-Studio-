<?php 
	session_start(); 
	require 'db.php';
	if(isset($_POST['register']))
	{

		$login = !empty($_POST['login']) ? trim($_POST['login']) : null;
		$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
		$usertype = !empty($_POST['iamboss']);
		$password = !empty($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_DEFAULT) : null;
		$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

		$user_exist = "SELECT * FROM users WHERE login = :login";
		$stmt = $pdo->prepare($user_exist);
		$stmt -> bindValue(':login', $login);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row)
		{
			$error = '<div class = "alert alert-danger">Ошибка: пользователь с таким логином уже существует!</div>';
		}


		$email_exist = "SELECT * FROM users WHERE email = :email";
		$stmt = $pdo->prepare($email_exist);
		$stmt -> bindValue(':email', $email);
		$stmt -> execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row)
		{
			$error = '<div class = "alert alert-danger">E-Mail уже занят!</div>';
		} 
		
		if(isset($_POST['iamboss']))
		{
			$usertype = 1;
		} else
			
			{
				$usertype = 0;
			}

		if (!$error) 
		{
			$sql = "call UserRegister(:usertype, :login, :password, :email, :phone)";
			$stmt = $pdo->prepare($sql);
			$stmt -> bindValue(':usertype', $usertype);
			$stmt -> bindValue(':login', $login);
			$stmt -> bindValue(':password', $password);
			$stmt -> bindValue(':email', $email);
			$stmt -> bindValue(':phone', $phone);

			$result = $stmt->execute();


			if(($result) && (!$row))
			{
				$success = '<div class = "alert alert-success">Регистрация прошла успешно! Авторизируйтесь.</div>';
			}
		}			
	}
?>
<?php
	require 'db.php';
	if(isset($_POST['loginBtn']))
	{
		$username = !empty($_POST['login']) ? trim($_POST['login']) : null;
		$password = !empty($_POST['password']) ? trim($_POST['password']) : null;
		$sql = "SELECT user_id, user_type, login, pass FROM users WHERE login = :login";
		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':login', $username);
		
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		if($user === false)
		{
			print "<script language='Javascript' type='text/javascript'>
            alert ('Неверный логин или пароль!');
            </script>";
		} 
		
		if($user['user_type'] == 2)
		{
			$validPassword = password_verify($password, $user['pass']);
			if($validPassword)
			{
				$_SESSION['logged_user'] = $user['login'];
				$_SESSION['logged_admin'] = $user['login'];
				header('Location: /admin.php');
				exit;	
			}
		} else
			if($user['user_type'] == 1)
			{
				$validPassword = password_verify($password, $user['pass']);
				if($validPassword)
				{
					$_SESSION['logged_user'] = $user['login'];
					$_SESSION['logged_boss'] = $user['login'];
					header('Location: /boss.php');
					exit;
				}
			}
			
		{
			$validPassword = password_verify($password, $user['pass']);
			if($validPassword) 
			{
					$_SESSION['logged_user'] = $user['login'];
					exit;
				} else
				{
					print "<script language='Javascript' type='text/javascript'>
					alert ('Ошибка!');
					</script>";	
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!--External Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- External Scripts -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <!-- Internal Scripts -->
	<script type="text/javascript" src="">
	</script>
    <title>Проект "Танцевальная студия"</title>
	
</head>

<body>
   
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">Танцевальная студия</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studios.php">Студии</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="classes.php">Мастер-классы</a>
                </li>
            </ul>
        </div>
    
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Вход в систему</h1>
            <p>Войдите в систему, чтобы попробовать все функции ресурса. Зарегистрируйтесь, если у Вас нет аккаунта. </p>
            <p><a href="index.php" class="btn btn-primary btn-md">На главную страницу</a></p>
        </div> 
    </div>
    
	<div class="container-fluid">
        <div class="container">
        	<?php echo $error; 
        		  echo $success; ?>	
            <p>Регистрация нового пользователя</p>		
        	<button class="btn btn-success" data-toggle="modal" data-target="#Registration">Регистрация</button>
            <div id="Registration" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">    
                        <!-- Сама форма -->
                        <form role="form" class="form-horizontal" method="post">
                            <h1>Регистрация пользователя</h1>
                            <strong>Логин:</strong>
                            <input type="text" class="form-control" name="login" id="login" required value="<?php echo @$data['login']; ?>">
                            <strong>E-Mail адрес:</strong>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo @$data['email']; ?>">
                            <strong>Пароль:</strong>
                            <input type="password" class="form-control" name="password" id="pass" required value="<?php echo @$data['password']; ?>">
                            <strong>Контактный телефон:</strong>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                                <script src="js/maskedinput.js"></script>
                                <script type="text/javascript">
                                    jQuery(function($){
                                        $("#phone").mask("9(999)999-99-99");
                                    });
                                </script>
                            <input type="text" id="phone" class="form-control" name="phone" value="<?php echo @$data['phone'];?>">
							<input type="checkbox"  name="iamboss">Я руководитель студии
							<br>
							<br>
                            <input type="submit" class="btn btn-success" id="regBtn" name="register" value="Зарегистрироваться">
                        </form>   
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <p>Для зарегистрировавшихся пользователей</p>
            <button class="btn btn-success" data-toggle="modal" data-target="#Login">Авторизация</button>
            <div id="Login" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form role="form" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <h1>Авторизация пользователя</h1>
                                    <strong>Логин:</strong>
                                    <input type="text" class="form-control" name="login" id="login" required value="<?php echo @$data['login']; ?>">
                                    <strong>Пароль:</strong>
                                    <input type="password" class="form-control" name="password" id="pass" required value="<?php echo @$data['password']; ?>"><br>
                                    <input type="submit" class="btn btn-success" id="loginBtn" name="loginBtn" value="Авторизоваться">
                                </div>
                            </form>   
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
            </div>
        </div>
</body>

</html>
