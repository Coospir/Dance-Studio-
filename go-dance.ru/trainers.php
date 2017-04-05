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
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Вход в систему</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="signup.php">Войти в систему</a>
                        <a class="dropdown-item" href="signup.php">Для руководителей студий</a>
                        <a class="dropdown-item" href="#">О нас</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Выход</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
     <div class="jumbotron">
        <div class="container">
            <h1>Мои преподаватели</h1>
            <p>Полная информация о преподавателях Вашей студии.</p>
        </div> 
    </div>
	<div class="table-responsive" style="max-width: 100%; overflow: auto;">
        <div class="container">
		<table class="table">
			<thead>
			<tr>
				<th>Фамилия</th>
				<th>Имя</th>
				<th>Отчества</th>
				<th>Дата рождения</th>
				<th>E-mail</th>
				<th>Телефон</th>
				<th>Стиль</th>
				<th>Серия</th>
				<th>Номер</th>
				<th>Действия</th>
			</tr>
			</thead>
            <?php
			$DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
			$DB->exec("SET NAMES utf8");
			/*$trainers = $DB->query("SELECT Trainers.surname, Trainers.name, Trainers.patronymic, Trainers.birth, Trainers.email, 
			Trainers.phone, Trainers.style, Trainers.serie, Trainers.number, Studio.studio_id FROM trainers INNER JOIN Studio on 
			Studio.trainer_id = Trainers.trainer_id")->fetchAll(PDO::FETCH_ASSOC); */
			$trainers = $DB->query("SELECT * FROM trainers")->fetchAll(PDO::FETCH_ASSOC);
		//	$delete = $DB->query("");
			for ($i = 0; $i < count($trainers); $i++) {
				echo "
					<tbody>
					<tr>
						<td>".$trainers[$i]['surname']."</td>
						<td>".$trainers[$i]['name']."</td>
						<td>".$trainers[$i]['patronymic']."</td>
						<td>".date_format(new DateTime($trainers[$i]['birth']),"d.m.Y")."</td>
						<td>".$trainers[$i]['email']."</td>
						<td>".$trainers[$i]['phone']."</td>
						<td>".$trainers[$i]['style']."</td>
						<td>".$trainers[$i]['serie']."</td>
						<td>".$trainers[$i]['number']."</td>
						<td>
						<input type='submit' class='btn btn-success' id='updBtn' name='updTeacher".$trainers[$i]['trainer_id']."' value='Изменить'>
						<br>
						<br>
						<input type='submit' class='btn btn-success' id='delBtn' name='delTeacher".$trainers[$i]['trainer_id']."' value='Удалить'>
						</td>
					</tr>";
			}
			?>
			</table>
        </div>
	</div>
	<div class="container">
	<hr>
	<footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
	</div>

</body>

</html>
