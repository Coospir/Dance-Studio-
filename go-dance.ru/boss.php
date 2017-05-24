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
                <li class="nav-item">
                    <a class="nav-link" href="classes.php">Мастер-классы</a>
                </li>
				<?php
			   if (isset($_SESSION['logged_user'])) {
			   ?>
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добро пожаловать, <?php echo $_SESSION['logged_user'] ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="admin.php">Панель администратора</a>
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
				</ul>
        </div>
    </nav>
     <div class="jumbotron">
        <div class="container">
            <h1>Ваша студия в Ваших руках</h1>
            <p>Управляйте всеми функциями своей танцевальной студии в два клика.</p>
            <button class="btn btn-info" data-toggle="modal" data-target="#about">Узнать подробнее</button>
            <div id="about" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Как работать в личном кабинете?</h4>  
                    </div>
                    <div class="modal-body">
                        Войдя в личный кабинет, у Вас открывается огромный функционал нашего ресуреса. Вы можете управлять преподавателями, группами, клиентами, расписанием, создавать мастер-классы для развития своей студии. С помощью настроек Вы можете изменить название студии, ее адрес, телефон. Идей для работы огромное количество. Попробуйте!
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>    
                    </div>
                </div>
            </div>
            </div>
        </div> 
    </div>
	<div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Мои преподаватели</h2>
                    <p>Преподаватели Вашей танцевальной студии</p>
                    <p><a href="trainers.php" class="btn btn-success">Преподаватели</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Мои группы</h2>
                    <p>Группы Вашей танцевальной студии </p>
                    <p><a href="groups.php" class="btn btn-success">Группы</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Мои клиенты</h2>
                    <p>Клиенты Вашей танцевальной студии</p>
                    <p><a href="clients.php"class="btn btn-success">Клиенты</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Расписание занятий</h2>
                    <p>Управляйте расписанием занятий</p>
                    <p><a href="shedule.php" class="btn btn-success">Расписание</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Мастер-классы</h2>
                    <p>Организуйте мастер-классы для своей студии</p>
                    <p><a href="st-classes.php" class="btn btn-success">Мастер-классы</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Настройки студии</h2>
                    <p>Изменение параметров студии</p>
                    <p><a href="settings.php" class="btn btn-success">Студии</a></p>
                </div>
            </div>
            <hr>
            <footer>
                <p><a href="index.php" class="btn btn-primary btn-md">На главную страницу</a></p>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
        </div>
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
            <p><a href="signup.php" class="btn btn-success">Регистрация нового руководителя</a></p>
			<p>Или войдите в уже существующий.</p>
			<p><a href="signup.php" class="btn btn-success">Вход для руководителя</a></p>
        </div> 
    </div>
			   <?php } ?>
            

</body>

</html>
