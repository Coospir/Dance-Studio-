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
?><?php
    if(isset($_POST['delTr']))
    {
        $selectItem = !empty($_POST['deleteTrainer']) ? trim($_POST['deleteTrainer']) : null;
        if($selectItem == null)
        {
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Нечего удалять!');
                    </script>";
        } else {

        $delDay = "DELETE FROM Trainers WHERE Trainers.trainer_id = :delItem";
        $stmt = $pdo->prepare($delDay);
        $stmt -> bindValue(":delItem", $selectItem);
        $result = $stmt->execute();
        if($result)
        {
            header('Location: /trainers.php');   
            print "<script language='Javascript' type='text/javascript'>
                    alert ('Удалено!');
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
	<div class="table-responsive" style="max-width: 100%; overflow: auto;">
        <div class="container">
        <h2>Список преподавателей</h2>
        <form role="form" class="form-horizontal" method="post" action="/editing_trainer.php">
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>Ф.И.О</th>
                <th>Дата рождения</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>Стиль</th>
                <th>Серия</th>
                <th>Номер</th>
                <th></th>
            </tr>
            </thead>
            <?php
            $DB = new PDO("mysql:dbname=DanceStudio;host=127.0.0.1", "root", "");
            $DB->exec("SET NAMES utf8");
            /*$trainers = $DB->query("SELECT Trainers.surname, Trainers.name, Trainers.patronymic, Trainers.birth, Trainers.email, 
            Trainers.phone, Trainers.style, Trainers.serie, Trainers.number, Studio.studio_id FROM trainers INNER JOIN Studio on 
            Studio.trainer_id = Trainers.trainer_id")->fetchAll(PDO::FETCH_ASSOC); */
            $trainers = $DB->query("SELECT * FROM trainers")->fetchAll(PDO::FETCH_ASSOC);
            // $delete = $DB->query("");
            // Для удаления: array_keys, array_filters, substr, strlen;
            // ищу ключи по условию, найденный ключ из него достаю число и передаю в запрос для удаления
            for ($i = 0; $i < count($trainers); $i++) {
                echo "
                    <tbody>
                    <tr>
                        <td>".$trainers[$i]['surname']." ".$trainers[$i]['name']." ".$trainers[$i]['patronymic']."</td>
                        <td>".date_format(new DateTime($trainers[$i]['birth']),"d.m.Y")."</td>
                        <td>".$trainers[$i]['email']."</td>
                        <td>".$trainers[$i]['phone']."</td>
                        <td>".$trainers[$i]['style']."</td>
                        <td>".$trainers[$i]['serie']."</td>
                        <td>".$trainers[$i]['number']."</td>
                        <td><button type='submit' class='btn btn-info' id='updBtn' name='updBtn' value='".$trainers[$i]['trainer_id']."'>Изменить</button>
                    </tr>";
            }
            ?>
            </table>
        </form>
            <hr>
        <h2>Действия</h2>
        <br>
        <p>Добавить преподавателя</p>
            <button class="btn btn-info" data-toggle="modal" data-target="#AddTrainer">Добавить преподавателя</button>
            <div id="AddTrainer" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">    
                        <!-- Сама форма -->
                        <form role="form" class="form-horizontal" method="post">
                            <h1>Новый преподаватель</h1>
                            <b><i>Фамилия</i></b>
                            <input type="text" class="form-control" name="sName" id="sName" required value="<?php echo @$data['sName']; ?>">
                            <b><i>Имя</i></b>
                            <input type="text" class="form-control" name="fName" id="fName" value="<?php echo @$data['fName']; ?>">
                            <b><i>Отчество</i></b>
                            <input type="text" class="form-control" name="pName" id="pName" required value="<?php echo @$data['pName']; ?>">
                            <b><i>Дата рождения</i></b>
                            <input type="date" class="form-control" name="bDate" id="bDate" required value="<?php echo @$data['bDate']; ?>">
                            <b><i>Контактный телефон:</i></b>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                                <script src="js/maskedinput.js"></script>
                                <script type="text/javascript">
                                    jQuery(function($){
                                        $("#phone").mask("9(999)999-99-99");
                                    });
                                </script>
                            <input type="text" id="phone" class="form-control" name="phone" value="<?php echo @$data['phone'];?>">
                            <b><i>E-Mail</i></b>
                            <input type="email" class="form-control" name="email" id="email" required value="<?php echo @$data['email']; ?>">
                            <b><i>Паспорт (серия):</i></b>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                                <script src="js/maskedinput.js"></script>
                                <script type="text/javascript">
                                    jQuery(function($){
                                        $("#serie").mask("99-99");
                                    });
                                </script>
                            <input type="text" id="serie" class="form-control" name="serie" value="<?php echo @$data['serie'];?>">
                            <b><i>Паспорт (номер):</i></b>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                                <script src="js/maskedinput.js"></script>
                                <script type="text/javascript">
                                    jQuery(function($){
                                        $("#number").mask("999-999");
                                    });
                                </script>
                            <input type="text" id="number" class="form-control" name="number" value="<?php echo @$data['number'];?>">
                            <b><i>Стиль танца</i></b>
                            <input type="text" class="form-control" name="style" id="style" required value="<?php echo @$data['style']; ?>">
                            <br>
                            <input type="submit" class="btn btn-info" id="addBtn" name="addBtn" value="Добавить">
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
        <p>Удалить данные преподавателя</p>
        <form role="form" class="form-horizontal" method="post">
            <select class="form-control" id="deleteTrainer" name="deleteTrainer">
                            <?php 
                                $DB = new PDO('mysql:host=localhost;dbname=DanceStudio','root', '' );
                                $DB->exec("SET NAMES utf8");
                              
                                $res = $DB->query("SELECT trainer_id, surname, name, patronymic, birth, email, phone, style, serie, number FROM Trainers");
                                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                                for
                                ($i=0; $i < count($data); $i++)
                                {
                                    echo "<option value=".$data[$i]['trainer_id'].">Ф.И.О: ".$data[$i]['surname']." ".$data[$i]['name']." ".$data[$i]['patronymic']."; Стиль танца: ".$data[$i]['style']."</option>";
                                }
                            ?>
            </select>
            <br>
            <input type="submit" class="btn btn-info" id="delTr" name="delTr" value="Удалить">
            </form>
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
