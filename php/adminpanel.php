<?php
session_start();
require_once('db.php');
////SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user INNER JOIN anecdots_tags ON anecdots.id_tag = anecdots_tags.id_anecdot INNER JOIN tags ON anecdots_tags.id_tag = tags.id_tag 
$stmt=$pdo->prepare("SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user WHERE akceptet=0 ");
$stmt->execute();
$anecdotarray = $stmt->fetchAll(); 

$stmt=$pdo->prepare("SELECT * FROM tags");
$stmt->execute();
$tagsarray = $stmt->fetchAll();




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
                    <li><a href="suggest_anecdote.php">Предложить анекдот</a></li>
                  <?php if($_SESSION['id_role']=='1'||$_SESSION['id_role']=='2'):?>
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
        <div><?php foreach ($anecdotarray as $anec):?>
        <div class="container-textarea_anecdot">
                <form action="insert_suggest_anecdote.php" method="POST">
                <h1 class="anec_add_h1">Подтвердить анекдот</h1>
			    <div>
                    <textarea class="textarea_anecdot" placeholder="Место для анекдота" name="anecdot_text" id="anecdot_text" cols="160" rows="20"><?= $anec['anecdot'] ?></textarea>
                </div>
                <div class="anec_info">
                <p class="anecdot_user">Предложил: <?= $anec['user'] ?></p><p class="anecdot_date"><?= $anec['anecdot_date'] ?></p>     
                </div>
                 <?php
                $kill= $anec['id_anecdot'];
                $stmt=$pdo->prepare("SELECT * FROM anecdots INNER JOIN anecdots_tags ON anecdots.id_anecdot = anecdots_tags.id_anecdot INNER JOIN tags ON anecdots_tags.id_tag = tags.id_tag WHERE anecdots.id_anecdot = $kill");
                $stmt->execute();
                $tagsallarray = $stmt->fetchAll();
                $ids = array();
                foreach ($tagsallarray as $value) {
                    array_push($ids, $value['id_tag']);
                }
                ?>
                <div class="tags_checkbox_div">
                <?php foreach ($tagsallarray as $alltags):?>
                <a class="tags_checkbox"><input type="checkbox" name="tagsar[]" value="<?= $alltags['id_tag'] ?>" checked/><?= $alltags['tag'] ?></a>
                <?php endforeach;?>
               
                <?php foreach ($tagsarray as $tags):?>
                <?php if (in_array($tags['id_tag'], $ids)) {

                 } 
                 else{ ?>                   
                    <a class="tags_checkbox"><input type="checkbox" name="tagsar[]" value="<?= $tags['id_tag'] ?>" /><?= $tags['tag'] ?></a>
                <?php
                 }
                 ?>
                <?php endforeach;?>
                </div>

			    <div class="conteiner_akceptet_button_anecdot">
                    <button class="button_delete_anecdot" type="submit" value="<?= $anec['id_anecdot'] ?>" name="deleteakceptetanecdot" id="deleteakceptetanecdot">Удалить Анекдот</button>
                    <button class="button_anecdot" type="submit" value="<?= $anec['id_anecdot'] ?>"  name="akceptetanecdot" id="akceptetanecdot">Добавить Анекдот</button>
			    </div>
                </form>
                </div>
             <?php endforeach;?></div>
             
        
    </div>
    



    </body>
</html>