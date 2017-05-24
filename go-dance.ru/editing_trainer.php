<?php 
	session_start();
    $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
    $DB->exec("SET NAMES utf8");
	$stmt = $DB->prepare("SELECT surname, name, patronymic, birth, phone, email, serie, number, style FROM trainers WHERE Trainers.trainer_id = :tr_id");
	$stmt -> bindValue(":tr_id", $_POST['updBtn']);
	$stmt -> execute();
	$trainers = $stmt -> fetch(PDO::FETCH_ASSOC);
?><?php
	require 'db.php';
	if(isset($_POST['updBtn']))
    {
	    $sName = !empty($_POST['surName']) ? trim($_POST['surName']) : null;
	    $fName = !empty($_POST['firstName']) ? trim($_POST['firstName']) : null;
	    $pName = !empty($_POST['patroName']) ? trim($_POST['patroName']) : null;
	    $bDate = !empty($_POST['birthD']) ? trim($_POST['birthD']) : null;
	    $phone = !empty($_POST['telephone']) ? trim($_POST['telephone']) : null;
	    $email = !empty($_POST['mail']) ? trim($_POST['mail']) : null;
	    $serie = !empty($_POST['ser']) ? trim($_POST['ser']) : null;
	    $number = !empty($_POST['num']) ? trim($_POST['num']) : null;
	    $style = !empty($_POST['dstyle']) ? trim($_POST['dstyle']) : null;

	    $BossChangeTrainer = "UPDATE Trainers SET Trainers.surname = :surname, Trainers.name = :name, Trainers.patronymic = :patronymic, Trainers.birth = :birth, Trainers.phone = :phone, Trainers.email = :email, Trainers.serie = :serie, Trainers.number = :number, Trainers.style = :style WHERE Trainers.surname = $_POST['surName'], Trainers.name = $_POST['firstName'], Trainers.patronymic = $_POST['patroName'], Trainers.birth = $_POST['birthD'], Trainers.phone = $_POST['telephone'], Trainers.email = $_POST['mail'], Trainers.serie = :$_POST['ser'], Trainers.number = $_POST['num'], Trainers.style = $_POST['dstyle']";
	    $stmt = $pdo->prepare($BossChangeTrainer);
	    $stmt -> bindValue(':surname', $sName);
	    $stmt -> bindValue(':name', $fName);
	    $stmt -> bindValue(':patronymic', $pName);
	    $stmt -> bindValue(':birth', $bDate);
	    $stmt -> bindValue(':email', $phone);
	    $stmt -> bindValue(':phone', $email);
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
            <h1>Мои преподаватели</h1>
            <p>Полная информация о преподавателях Вашей студии.</p>
            <p><a href="boss.php" class="btn btn-primary btn-md">На главную страницу руководителя</a></p>
        </div> 
    </div>
    <div class="container">
    <form role="form" class="form-horizontal" method="post">
        <h1>Изменение данных преподавателя</h1>
        <b><i>Фамилия:</i></b>
        <input type="text" class="form-control" name="surName" id="surName" required value="<?php echo $trainers['surname']; ?>">
        <b><i>Имя:</i></b>
        <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $trainers['name']; ?>">
        <b><i>Отчество:</i></b>
        <input type="text" class="form-control" name="patroName" id="patroName" required value="<?php echo $trainers['patronymic']; ?>">
        <b><i>Дата рождения:</i></b>
        <input type="date" class="form-control" name="birthD" id="birthD" required value="<?php echo $trainers['birth']; ?>">
        <b><i>Контактный телефон:</i></b>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="js/maskedinput.js"></script>
            <script type="text/javascript">
                jQuery(function($){
                    $("#telephone").mask("9(999)999-99-99");
                });
            </script>
        <input type="text" id="telephone" class="form-control" name="telephone" value="<?php echo $trainers['phone']; ?>">
        <b><i>E-Mail:</i></b>
        <input type="email" class="form-control" name="mail" id="mail" required value="<?php echo $trainers['email'];?>">
        <b><i>Паспорт (серия):</i></b>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="js/maskedinput.js"></script>
            <script type="text/javascript">
                jQuery(function($){
                    $("#ser").mask("99-99");
                });
            </script>
        <input type="text" id="ser" class="form-control" name="ser" value="<?php echo $trainers['serie']; ?>">
        <b><i>Паспорт (номер):</i></b>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="js/maskedinput.js"></script>
            <script type="text/javascript">
                jQuery(function($){
                    $("#num").mask("999-999");
                });
            </script>
        <input type="text" id="num" class="form-control" name="num" value="<?php echo $trainers['number']; ?>">
        <b><i>Стиль танца:</i></b>
        <input type="text" class="form-control" name="dstyle" id="dstyle" required value="<?php echo $trainers['style']; ?>">
        <br>
        <input type="submit" class="btn btn-info" id="updBtn" name="updBtn" value="Изменить">
    </form>   
    </div>
</div>
<br>
<br>
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