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
        <h1>Добро пожаловать в панель администратора</h1>
        <p>Управляйте всеми ресурсами веб-сайта с помощью удобного интерфейса</p>
        <p><a href="index.php" class="btn btn-primary btn-md">На главную страницу</a></p>
    </div> 
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Пользователи</h2>
                <p>Информация о пользователях сайта.</p>
                <p><a href="users.php" class="btn btn-primary btn-lg">Подробнее</a></p>
            </div>
        </div>
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
                    <p><a href="index.php" class="btn btn-primary btn-lg">На главную страницу</a></p>
				</div> 
			</div>            
    </div>
</div>

</body>

</html>

			
<?php } ?>