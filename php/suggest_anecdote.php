<?php
session_start();
require_once('db.php');
$stmt=$pdo->prepare("SELECT * FROM anecdots");
$stmt->execute();
$anecdotarray = $stmt->fetchAll(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
    <!--Шапочяка--> 
    <header class="menu">
        <div class="container">
        <div class="menu-wrap"> 
        <a href="../index.php"><img src="../img/logo.png" class="logo-img" alt="Logo"></a>
            <input type="checkbox" id="checkbox_menu">
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <?php if($_SESSION['id_role']== 1 ||$_SESSION['id_role']== 2 ||$_SESSION['id_role']== 3 ):?>
                    <li><a href="suggest_anecdote.php">Предложить анекдот</a></li>
                    <?php else: ?>
                    <li><a href="login.php">Предложить анекдот</a></li>
                    <?php endif ?> 
                    <?php if($_SESSION['id_role']== 1 ||$_SESSION['id_role']== 2 ):?>
                    <li><a href="adminpanel.php">Админ.Панель</a></li>
                    <?php endif ?>  
                </ul> 
            </nav>
            <?php if(isset($_SESSION['username'])):?>
                <a class="Join" href="../index.php"><?= $_SESSION['username'];?></a>
                <a class="Join" href="session_destroy.php">Выход</a>
            <?php else: ?>
                <a class="Join" href="login.php">Войти</a> 
            <?php endif ?>  


            <label for="checkbox_menu">
                <i class="fa fa-bars menu-icon"></i>
            </label>
        </div>
    </div>
    </header>
    <!--Шапочяка заканчивается-->

    <div class="container-body">
        <div class="container-textarea_anecdot">
                <form action="insert_suggest_anecdote.php" method="POST">
                <h1 class="anec_add_h1">Предложить анекдот</h1>
			    <div>
                    <textarea class="textarea_anecdot" placeholder="Место для анекдота" name="anecdot_text" id="anecdot_text" cols="180" rows="20"></textarea>
			    </div>
			    <div class="conteiner_button_anecdot">
				    <button class="button_anecdot" type="submit"  value="Внимание! Анекдот" name="addanecdot" id="addanecdot">Внимание! Анекдот</button>
			    </div>
                </form>

        </div>
    </div>
    </body>
</html>