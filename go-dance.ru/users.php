<?php 
	session_start(); 
	require 'db.php';
	if(isset($_POST['register']))
	{

		$login = !empty($_POST['login']) ? trim($_POST['login']) : null;
		$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
		$usertype = !empty($_POST['selectType']);
		$password = !empty($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_DEFAULT) : null;
		$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

		$user_exist = "SELECT * FROM users WHERE login = :login";
		$stmt = $pdo->prepare($user_exist);
		$stmt -> bindValue(':login', $login);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);


		$email_exist = "SELECT * FROM users WHERE email = :email";
		$stmt = $pdo->prepare($email_exist);
		$stmt -> bindValue(':email', $email);
		$stmt -> execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row)
		{
			print "<script language='Javascript' type='text/javascript'>
					alert ('Пользователь с таким логином/E-Mail уже существует!');
					</script>";
		} 
		
		if(isset($_POST['selectType']))
		{
			if($_POST['selectType'] == 'boss')
		{
			$usertype = 1;
		} else
			if($_POST['selectType'] == 'user')
			{
				$usertype = 0;
			} else
				if($_POST['selectType'] == 'admin')
				{
					$usertype = 2;
				}

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
				print "<script language='Javascript' type='text/javascript'>
					alert ('Регистрация прошла успешно!');
					</script>";
				header('Location: /signup.php');
			}
		}			
	}
?><?php
    if(isset($_POST['delUser']))
    {
        $selectItem = !empty($_POST['dltUsr']) ? trim($_POST['dltUsr']) : null;
        if($selectItem == null)
        {
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Нечего удалять!');
                    </script>";
        } else {

        $delUser = "DELETE FROM Users WHERE Users.user_id = :delItem";
        $stmt = $pdo->prepare($delUser);
        $stmt -> bindValue(":delItem", $selectItem);
        $result = $stmt->execute();
        if($result)
        {
            header('Location: /users.php');   
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Удалено!');
                    </script>"; 
        } 
    }
    }
?><?php
    if(isset($_POST['updateUsr']))
    {
        $user = !empty($_POST['slctUsr']) ? trim($_POST['slctUsr']) : null;  //тут не число, а просто признак
        $user_type = !empty($_POST['selectType']) ? trim($_POST['selectType']) : null; //тут тоже
        if($user == null) 
        {
        	print "<script language='Javascript' type='text/javascript'>
                    alert ('Список пуст!');
                    </script>";
        }
        $update_user = "UPDATE users SET user_type = :userType WHERE user_id = :upUser";
        //var_dump($user,$user_type);

        $stmt = $pdo->prepare($update_user);
       	$stmt -> bindValue(":upUser", $user); //не тип а номер
       	$stmt -> bindValue(":userType", $user_type);
       	$result = $stmt->execute();
       	if($result)
       	{
       		header('Location: /users.php');   
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Изменено!');
                    </script>"; 
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Панель администратора<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">На главную страницу</a>
                </li>
				
               <?php
			   if (isset($_SESSION['logged_admin'])) {
			   ?>
	
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добро пожаловать, <?php echo $_SESSION['logged_admin'] ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
				</nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Пользователи</h1>
            <p>Информация о пользователях веб-сервиса.</p>
            <p><a href="index.php" class="btn btn-primary btn-md">На главную страницу</a></p>
        </div> 
    </div>
	<div class="container-fluid">
        <div class="container">
        <h1>Таблица пользователей</h1>
        <br>
		<table class="table">
		<thead class="thead-inverse">
			<tr>
				<th>Тип пользователя</th>
				<th>Логин</th>
				<th>E-Mail</th>
				<th>Телефон</th>
			</tr>
		</thead>
		<?php 
		$DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
		$DB->exec("SET NAMES utf8");
		$users = $DB->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
		for ($i = 0; $i < count($users); $i++)
		{
			echo "
					<tbody>
					<tr>
						<td>".$users[$i]['user_type']."</td>
						<td>".$users[$i]['login']."</td>
						<td>".$users[$i]['email']."</td>
						<td>".$users[$i]['phone']."</td>
					</tr>";
			}
		?>
		</table>
		<br>
		<form role="form" class="form-horizontal" method="post">
                <h2>Создание нового пользователя</h2>
               
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
				<br>
				<h4>Выберите тип пользователя</h4>
				<input type="radio"  name="selectType" value="boss"> Руководитель студии	
				<br>
				<input type="radio"  name="selectType" value="user"> Пользователь
				<br>
				<input type="radio"  name="selectType" value="admin"> Администратор
				<br>
				<br>
                <input type="submit" class="btn btn-success" id="regBtn" name="register" value="Создать нового пользователя">
            </form> 
            <br>
		<h2>Удаление пользователя</h2>
		<form role="form" class="form-horizontal" method="post">
            <select class="form-control" id="dltUsr" name="dltUsr">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT user_id, login FROM users");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['user_id'].">Пользователь: ".$data[$i]['login']."</option>";
                                }
                            ?>
            </select>
            <br>
            <input type="submit" class="btn btn-danger" id="delUser" name="delUser" value="Удалить">
            </form>
			<br>
			<h2>Изменение пользователя</h2>
			<p>Измените тип пользователя на другой. Есть 3 типа: Администратор, Руководитель студии и Пользователь.</p>
			<button class="btn btn-info" data-toggle="modal" data-target="#updateUser">Выбрать пользователя</button>
			<div id="updateUser" class="modal fade">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <div class="modal-body">    
	                        <!-- Сама форма -->
	                        <form role="form" class="form-horizontal" method="post">
	                            <h1>Изменение пользователя</h1>
	                            <strong>Выберите пользователя:</strong>
	                            <select class="form-control" id="slctUsr" name="slctUsr">
	                            <?php 
	                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
	                                $DB->exec("SET NAMES utf8");
	                              
	                                $res = $DB->query("SELECT user_id, login FROM users");
	                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
	                                for
	                                ($i=0; $i < count($data); $i++)
	                                {
	                                    echo "<option value=".$data[$i]['user_id'].">Пользователь: ".$data[$i]['login']."</option>";
	                                }
	                            ?>
	            				</select>
            					<strong>Выберите новый тип пользователя:</strong>
            					<br>
								<input type="radio"  name="selectType" value="1"> Руководитель студии	
								<br>
								<input type="radio"  name="selectType" value="0"> Пользователь
								<br>
								<input type="radio"  name="selectType" value="2"> Администратор
	                            <br>
	                            <br>
	                            <input type="submit" class="btn btn-success" id="updateUsr" name="updateUsr" value="Изменить">
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

             
            <hr>
            <footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
        </div>
	</div>
			</ul>
        </div>		
			   <?php } else { ?>
			   
				</nav>
				<div class="jumbotron">
					<div class="container">
						<h1>Добро пожаловать в панель администратора</h1>
						<p>Сначала войдите в систему</p>
						<p><a href="signup.php" class="btn btn-primary btn-lg">Войти в систему</a></p>
					</div> 
				</div>            
        </div>
	</div>

</body>

</html>

				
			   <?php } ?>