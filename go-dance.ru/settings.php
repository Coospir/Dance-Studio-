<?php
    session_start();
    require 'db.php';
    if(isset($_POST['addBtn']))
    {
        $sName = !empty($_POST['sName']) ? trim($_POST['sName']) : null;
        $fName = !empty($_POST['fName']) ? trim($_POST['fName']) : null;
        $pName = !empty($_POST['pName']) ? trim($_POST['pName']) : null;
        $bDate = !empty($_POST['bDate']) ? trim($_POST['bDate']) : null;
        $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $serie = !empty($_POST['serie']) ? trim($_POST['serie']) : null;
        $number = !empty($_POST['number']) ? trim($_POST['number']) : null;
        $style = !empty($_POST['style']) ? trim($_POST['style']) : null;

        $BossAddNewTrainer = "call BossAddNewTrainer(:surname, :name, :patronymic, :birth, :phone, :email, :serie, :number, :style)";
        $stmt = $pdo->prepare($BossAddNewTrainer);
        $stmt -> bindValue(':surname', $sName);
        $stmt -> bindValue(':name', $fName);
        $stmt -> bindValue(':patronymic', $pName);
        $stmt -> bindValue(':birth', $bDate);
        $stmt -> bindValue(':phone', $phone);
        $stmt -> bindValue(':email', $email);
        $stmt -> bindValue(':serie', $serie);
        $stmt -> bindValue(':number', $number);
        $stmt -> bindValue(':style', $style);
        $result = $stmt->execute();

            if($result)
            {
                header('Location: /trainers.php');
                print "<script language='Javascript' type='text/javascript'>
                    alert ('Добавлено!');
                    </script>";
            } else {
                $erInfo=$stmt->errorInfo();
                $str=$erInfo[2];
                print "<script language='Javascript' type='text/javascript'>

                    alert (\"Внутренняя ошибка ".$str."\");
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
        <a class="navbar-brand" href="go-dance.ru/index.php">Танцевальная студия</a>

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
               <?php
               if (isset($_SESSION['logged_user'])) {
               ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добро пожаловать, <?php echo $_SESSION['logged_user'] ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
     <div class="jumbotron">
        <div class="container">
            <h1>Настройки</h1>
            <p>Журнал логов, общие настройки системы.</p>
        </div> 
    </div>
	<div class="table-responsive" style="max-width: 100%; overflow: auto;">
        <div class="container">
        <br>
        <br>
        <h2>Журнал логов</h2>
		<table class="table">
			<thead class="thead-inverse">
			<tr>
				<th>№</th>
				<th>Имя пользователя</th>
				<th>Действие</th>
				<th>Название таблицы</th>
				<th>Описание</th>
				<th>Дата действия</th>
			</tr>
			</thead>
            <?php
			$DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
			$DB->exec("SET NAMES utf8");
			$actions = $DB->query("SELECT * FROM DatabaseLogs")->fetchAll(PDO::FETCH_ASSOC);
			for ($i = 0; $i < count($actions); $i++) {
				echo "
					<tbody>
					<tr>
                        <td>".$actions[$i]['log_id']."</td>
						<td>".$actions[$i]['user_name']."</td>
						<td>".$actions[$i]['user_action']."</td>
						<td>".$actions[$i]['table_name']."</td>
						<td>".$actions[$i]['description']."</td>
						<td>".$actions[$i]['date_action']."</td>
					</tr>";
			}
			?>
			</table>
	</div>
	<div class="container">
	<hr>
	<footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
	</div>
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
                </ul>
        </div>
    </nav>
     <div class="jumbotron">
        <div class="container">
            <h1>Упс.. Вы не руководитель студии.. А хотите им быть?</h1>
            <p>Зарегистрируйте аккаунт с возможностями руководителя студии.</p>
            <p><a href="signup.php" class="btn btn-primary btn-lg">Регистрация нового руководителя</a></p>
            <p>Или войдите в уже существующий.</p>
            <p><a href="signup.php" class="btn btn-primary btn-lg">Вход для руководителя</a></p>
        </div> 
    </div>
               <?php } ?>
            

</body>

</html>


</body>

</html>
