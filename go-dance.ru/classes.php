<?php

	session_start();

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
                <li class="nav-item active">
                    <a class="nav-link" href="classes.php">Мастер-классы</a>
                </li>
				<?php
			   if (isset($_SESSION['logged_user'])) {
			   ?>
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добро пожаловать, <?php echo $_SESSION['logged_user'] ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="boss.php">Для руководителей студий</a>
                        <a class="dropdown-item" href="#">О нас</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
				<?php } else { ?>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Вход в систему</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="signup.php">Войти в систему</a>
                        <a class="dropdown-item" href="boss.php">Для руководителей студий</a>
                        <a class="dropdown-item" href="#">О нас</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
			   <?php } ?>
            </ul>
        </div>
    
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Мастер-классы от лучших преподавателей</h1>
            <p>Чтобы повысить свой уровень в танцах, необходимо посещать мастер-классы от различных преподавателей. Запишитесь на мастер-класс прямо сейчас. </p>
            <p><a href="index.php" class="btn btn-primary btn-md">На главную страницу</a></p>
        </div> 
        </div>
	<div class="container-fluid">
        <div class="container">
		<h2>Ближайший мастер-класс</h2>
        <?php
          $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
          $DB->exec("SET NAMES utf8");
          
		  $res = $DB->query("SELECT Trainers.surname, Trainers.name, Classes.class_date, Classes.cost, Classes.name_class, Classes.duration, Classes.class_id FROM trainers INNER JOIN Classes on Classes.trainer_id = Trainers.trainer_id ORDER BY Classes.class_date DESC LIMIT 1 ");
		  $data = $res->fetchAll(PDO::FETCH_ASSOC);
          
		  
		  
		  for ($i = 0; $i < count($data); $i++)
          {
            echo "
            Название: ".$data[$i]['name_class']."<br>
            Дата проведения: ".date_format(new DateTime($data[$i]['class_date']),"d.m.Y")."<br>
            Преподаватель: ".$data[$i]['surname']." ".$data[$i]['name']."<br>
            Продолжительность класса: ".$data[$i]['duration']."<br>
            Стоимость: ".$data[$i]['cost']." руб. <br>";
          }
        ?>	
		
		<?php 
			require 'db.php';
			if(isset($_POST['goClass']))
			{
				$id = !empty($_POST['selectClass']) ? trim($_POST['selectClass']) : null;
				$fname = !empty($_POST['fname']) ? trim($_POST['fname']) : null;
				$lname = !empty($_POST['lname']) ? trim($_POST['lname']) : null;
				$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
				$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
				
				$goClass = "call UserRegistrationToClass(:selectClass, :fname, :lname, :email, :phone)";
				$stmt = $pdo->prepare($goClass);
				$stmt -> bindValue(':selectClass', $id);
				$stmt -> bindValue(':fname', $fname);
				$stmt -> bindValue(':lname', $lname);
				$stmt -> bindValue(':email', $email);
				$stmt -> bindValue(':phone', $phone);
				$result = $stmt->execute();
				if($result) 
				{
					print "<script language='Javascript' type='text/javascript'>
					alert ('Вы успешно зарегистрировались на класс!');
					</script>";
				} 
			}
		
		
		?>
		
			<hr>
			<h3>Регистрация</h3>
            <form method="post">
                <label for="fname">Ваше имя</label>
                <input type="text" class="form-control"  id="fname" name="fname" required>
                <label for="lname">Ваша фамилия</label>
                <input type="text" class="form-control"  id="lname" name="lname"  required>
                <label for="email">Ваш электронный адрес</label>
                <input type="email" class="form-control"  id="email" name="email"  required>
                <label for="telephone">Ваш контактный телефон</label>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                <script src="js/maskedinput.js"></script>
                <script type="text/javascript">
                    jQuery(function($){
                        $("#phone").mask("9(999) 999-99-99");
                    });
                </script>
                <input type="text" class="form-control"  id="phone" name="phone" required>
				<label for="selectClass">Выберите мастер-класс</label>
				<select class="form-control" id="selectClass" name="selectClass">
				<?php 
					$DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
				    $DB->exec("SET NAMES utf8");
				  
					$res = $DB->query("SELECT Trainers.surname, Trainers.name, Classes.class_date, Classes.cost, Classes.name_class, Classes.duration, Classes.class_id FROM trainers INNER JOIN Classes on Classes.trainer_id = Trainers.trainer_id ORDER BY Classes.class_date");
					$data = $res->fetchAll(PDO::FETCH_ASSOC);
					for
					($i=0; $i < count($data); $i++)
					{
						echo "<option value=".$data[$i]['class_id'].">".$data[$i]['name_class']."</option>";
					}
				
				?>
				</select>
                <br>
				<input type="submit"  class="btn btn-success" id="goClass" name="goClass" value="Зарегистрироваться">
            </form>
            <hr>
            <footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
        </div>
	</div>

</body>

</html>
