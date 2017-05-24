<?php
    session_start();
    require 'db.php';
    if(isset($_POST['addDay']))
    {

        $group = !empty($_POST['selectGroup']) ? trim($_POST['selectGroup']) : null;
        $trainer = !empty($_POST['selectTrainer']) ? trim($_POST['selectTrainer']) : null;
        $time_start = !empty($_POST['selectTStart']) ? trim($_POST['selectTStart']) : null;
        $time_end = !empty($_POST['selectTEnd']) ? trim($_POST['selectTEnd']) : null;
        $week_day = !empty($_POST['selectDay']) ? trim($_POST['selectDay']) : null;
        $date = !empty($_POST['selectDate']) ? trim($_POST['selectDate']) : null;

        $addDay = "call AddShedule(:group_id, :trainer_id, :training_day, :training_start, :training_end, :training_date)";
        $stmt = $pdo->prepare($addDay);
        $stmt -> bindValue(':group_id', $group);
        $stmt -> bindValue(':trainer_id', $trainer);
        $stmt -> bindValue(':training_start', $time_start);
        $stmt -> bindValue(':training_end', $time_end);
        $stmt -> bindValue(':training_day', $week_day);
        $stmt -> bindValue(':training_date', $date);



        $result = $stmt->execute();

            if($result)
            {
                header('Location: /shedule.php');
                print "<script language='Javascript' type='text/javascript'>
                    alert ('Добавлено!');
                    </script>";
            } else 
                print "<script language='Javascript' type='text/javascript'>
                    alert ('Невозможно добавить дупликат расписания!');
                    </script>";    
    }
?><?php
    if(isset($_POST['delDay']))
    {
        $selectItem = !empty($_POST['deleteDay']) ? trim($_POST['deleteDay']) : null;
        if($selectItem == null)
        {
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Нечего удалять!');
                    </script>";
        } else {

        $delDay = "DELETE FROM TrainingShedule WHERE TrainingShedule.element_id = :delItem";
        $stmt = $pdo->prepare($delDay);
        $stmt -> bindValue(":delItem", $selectItem);
        $result = $stmt->execute();
        if($result)
        {
            header('Location: /shedule.php');   
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Удалено!');
                    </script>"; 
        } 
    }
    }
?><?php
    if(isset($_POST['updateDay']))
    {
        $group = !empty($_POST['selectGroup']) ? trim($_POST['selectGroup']) : null;
        $trainer = !empty($_POST['selectTrainer']) ? trim($_POST['selectTrainer']) : null;
        $time_start = !empty($_POST['selectTStart']) ? trim($_POST['selectTStart']) : null;
        $time_end = !empty($_POST['selectTEnd']) ? trim($_POST['selectTEnd']) : null;
        $week_day = !empty($_POST['selectDay']) ? trim($_POST['selectDay']) : null;
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
            <h1>Расписание студии</h1>
            <p>Полная информация о расписании Вашей танцевальной студии.</p>
            <p><a href="boss.php" class="btn btn-primary btn-md">На главную страницу руководителя</a></p>
        </div> 
    </div>
	<div class="container-fluid">
        <div class="container">
            <h1>Расписание занятий</h1>
        <table class="table" cellpadding="0" cellspacing="0">
            <thead>
                <tr style="background-color: #f8f8f8">
                    <td />
                    <td class='d0'>
                        <div>
                          Понедельник</div>
                    </td>
                    <td class='d1'>
                        <div>
                            Вторник</div>
                    </td>
                    <td class='d2'>
                        <div>
                            Среда</div>
                    </td>
                    <td class='d3'>
                        <div>
                            Четверг</div>
                    </td>
                    <td class='d4'>
                        <div>
                            Пятница</div>
                    </td>
                    <td class='d5'>
                        <div>
                            Суббота</div>
                    </td>
                </tr>
            </thead>
            <tbody>    
                  <tr class='h16'>
                    <td>
                        <div>
                            16:00
                        </div>
                    </td>
                    <td class='d0'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Понедельник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d1'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Вторник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d2'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Среда'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d3'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Четверг'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d4'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Пятница'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>

                    </td>
                    <td class='d5'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '16:00' AND TrainingShedule.training_end = '17:00' AND TrainingShedule.training_day = 'Суббота'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    ".strftime("%d/%b/%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                </tr>
                
                
                  <tr class='h16'>
                    <td>
                        <div>
                            17:00
                        </div>
                    </td>
                    <td class='d0'>
                       <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Понедельник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d1'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Вторник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d2'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Среда'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d3'>
                       <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Четверг'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d4'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Пятница'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>

                    </td>
                    <td class='d5'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '17:00' AND TrainingShedule.training_end = '18:00' AND TrainingShedule.training_day = 'Суббота'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>

                </tr>
                
                
                  <tr class='h17'>
                    <td>
                        <div>
                            18:00
                        </div>
                    </td>
                    <td class='d0'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Понедельник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d1'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Вторник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d2'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Среда'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d3'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Четверг'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d4'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Пятница'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>

                    </td>
                    <td class='d5'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '18:00' AND TrainingShedule.training_end = '19:00' AND TrainingShedule.training_day = 'Суббота'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                </tr>
                  <tr class='h19'>
                    <td>
                        <div>
                            19:00
                        </div>
                    </td>
                    <td class='d0'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Понедельник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d1'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Вторник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d2'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Среда'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d3'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Четверг'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d4'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Пятница'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>

                    </td>
                    <td class='d5'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '19:00' AND TrainingShedule.training_end = '20:00' AND TrainingShedule.training_day = 'Суббота'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>

                </tr>
                
                  <tr class='р20'>
                    <td>
                        <div>
                            20:00
                        </div>
                    </td>
                    <td class='d0'>
                    <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Понедельник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d1'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Вторник'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d2'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Среда'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d3'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Четверг'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d4'>
                    <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Пятница'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>
                    <td class='d5'>
                        <div>
                            <?php
                            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
                            $DB->exec("SET NAMES utf8");
                            $trainingAtThree = "SELECT Groups.grp_name, Trainers.name, Trainers.surname, TrainingShedule.training_start, 
                                TrainingShedule.training_end, UNIX_TIMESTAMP(TrainingShedule.training_date) AS training_date FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id AND 
                                TrainingShedule.training_start = '20:00' AND TrainingShedule.training_end = '21:00' AND TrainingShedule.training_day = 'Суббота'";
                            $stmt = $pdo->prepare($trainingAtThree);
                            $result = $stmt->execute();
                            $trainingAtThree = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($trainingAtThree); $i++)
                                {
                                    echo
                                    "<div>
                                    <b>".$trainingAtThree[$i]['surname']."<br>
                                    ".$trainingAtThree[$i]['name']."</b><br>
                                    ".$trainingAtThree[$i]['grp_name']."<br>
                                    <b>Дата:</b> ".strftime("%d.%m.%Y", (int)($trainingAtThree[$i]['training_date']))."<br>
                                    </div>";

                                }
                            ?>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
            <h1>Действия</h1>
            <p>Добавить день в расписание</p>
            <button class="btn btn-info" data-toggle="modal" data-target="#addDay">Добавить</button>
            <div id="addDay" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">    
                        <!-- Сама форма -->
                        <form role="form" class="form-horizontal" method="post">
                            <h1>Создание расписания</h1>
                            <strong>Выберите группу:</strong>
                            <select class="form-control" id="selectGroup" name="selectGroup">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT * FROM Groups");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['group_id'].">".$data[$i]['grp_name']."</option>";
                                }
                            ?>
                            </select>
                            <strong>Выберите преподавателя:</strong>
                            <select class="form-control" id="selectTrainer" name="selectTrainer">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT * FROM Trainers");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['trainer_id'].">".$data[$i]['surname']." ".$data[$i]['name']."</option>";
                                }
                            ?>
                            </select>
                            <strong>Выберите время начала:</strong>
                            <select class="form-control" id="selectTStart" name="selectTStart">
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                            <strong>Выберите время конца:</strong>
                            <select class="form-control" id="selectTEnd" name="selectTEnd">
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                            <strong>Выберите день недели:</strong>
                            <select class="form-control" id="selectDay" name="selectDay">
                                <option>Понедельник</option>
                                <option>Вторник</option>
                                <option>Среда</option>
                                <option>Четверг</option>
                                <option>Пятница</option>
                                <option>Суббота</option>
                                <option>Воскресенье</option>
                            </select>
                            <strong>Выберите дату</strong>
                            <input type="date" class="form-control" id="selectDate" name="selectDate" required>
                            <br>
                            <input type="submit" class="btn btn-success" id="addDay" name="addDay" value="Добавить">
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
            <p>Изменить расписание</p>
            <button class="btn btn-info" data-toggle="modal" data-target="#updateDay">Выбрать день</button>
            <div id="updateDay" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">    
                        <!-- Сама форма -->
                        <form role="form" class="form-horizontal" method="post">
                            <h1>Изменение расписания</h1>
                            <strong>Выберите группу:</strong>
                            <select class="form-control" id="selectGroup" name="selectGroup">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT * FROM Groups");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['group_id'].">".$data[$i]['grp_name']."</option>";
                                }
                            ?>
                            </select>
                            <strong>Выберите преподавателя:</strong>
                            <select class="form-control" id="selectTrainer" name="selectTrainer">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT * FROM Trainers");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['trainer_id'].">".$data[$i]['surname']." ".$data[$i]['name']."</option>";
                                }
                            ?>
                            </select>
                            <strong>Выберите время начала:</strong>
                            <select class="form-control" id="selectTStart" name="selectTStart">
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                            <strong>Выберите время конца:</strong>
                            <select class="form-control" id="selectTEnd" name="selectTEnd">
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                            <strong>Выберите день недели:</strong>
                            <select class="form-control" id="selectDay" name="selectDay">
                                <option>Понедельник</option>
                                <option>Вторник</option>
                                <option>Среда</option>
                                <option>Четверг</option>
                                <option>Пятница</option>
                                <option>Суббота</option>
                                <option>Воскресенье</option>
                            </select>
                            <br>
                            <input type="submit" class="btn btn-success" id="updateDay" name="updateDay" value="Изменить">
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
            <p>Удаление дня из расписания</p>
            <form role="form" class="form-horizontal" method="post">
            <select class="form-control" id="deleteDay" name="deleteDay">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT Groups.grp_name, Trainers.surname, Trainers.name, TrainingShedule.training_start, TrainingShedule.training_day,  
                                TrainingShedule.training_end, TrainingShedule.element_id FROM Groups, Trainers, TrainingShedule
                                WHERE Groups.trainer_id = Trainers.trainer_id AND TrainingShedule.group_id = Groups.group_id 
                                AND TrainingShedule.trainer_id = Trainers.trainer_id");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['element_id'].">Группа: ".$data[$i]['grp_name']."; Преподаватель: ".$data[$i]['surname']." ".$data[$i]['name']."; День недели: ".$data[$i]['training_day']."; Время: ".$data[$i]['training_start']." - ".$data[$i]['training_end']."</option>";
                                }
                            ?>
            </select>
            <br>
            <input type="submit" class="btn btn-info" id="delDay" name="delDay" value="Удалить">
            </form>
            <br>
            
            <hr>
            <footer>
                <p>&copy; Все права защищены, 2017</p>
            </footer>
        </div>
	</div>

</body>

</html>
