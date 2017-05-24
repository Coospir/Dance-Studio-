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
                <li class="nav-item active">
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
                    </div>
                </li>
			   <?php } ?>
            </ul>
        </div>
    
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Проект "Танцевальная студия"</h1>
            <p>Первый в России бесплатный ресурс в танцевальной индустрии с огромным функционалом. </p>
            <p><a href="signup.php" class="btn btn-primary btn-lg">Регистрация нового пользователя</a></p>
        </div> 
    </div>
	<div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Список студий</h2>
                    <p>На нашем сайте вы можете узнать о существующих танцевальных студиях Москвы и связаться с ними.</p>
                    <p><a href="studios.php" class="btn btn-primary btn-lg">Подробнее</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Мастер-классы</h2>
                    <p>Чтобы повысить свой уровень в танцах, необходимо посещать мастер-классы от различных преподавателей. </p>
                    <p><a href="classes.php" class="btn btn-primary btn-lg">Подробнее</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Руководителям студий</h2>
                    <p>Если Вы являетесь руководителем школы танцев, то Вы можете опробовать наш личный кабинет для руководителя.</p>
                    <p><a href="boss.php" class="btn btn-primary btn-lg">Подробнее</a></p>
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
