<?php
session_start();
require_once('php/db.php');
if ($_SESSION['id_role']!= '3') {
    if ($_SESSION['id_role']!= '2') {
        if($_SESSION['id_role']!='1'){
            $_SESSION['id_role'] = '0' ;
        }       
    }
}

if(!isset($_SESSION['id_tag'])){
    $_SESSION['id_tag'] = 1 ;       
}

$id_tg=$_SESSION['id_tag'];

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;


if ($id_tg == 1) {
    $stmt=$pdo->prepare("SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user WHERE akceptet=1 ");
    $stmt->execute();
    $anecdotarray = $stmt->fetchAll(); 

    $stmt=$pdo->prepare("SELECT COUNT(*) FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user WHERE akceptet=1 ");
    $stmt->execute();
    $resultarray = $stmt->fetchAll(); 
    $total_pages = ceil($resultarray[0][0] / $no_of_records_per_page);

    $stmt=$pdo->prepare("SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user WHERE akceptet=1  LIMIT $offset, $no_of_records_per_page");
    $stmt->execute();
    $anecdotarray = $stmt->fetchAll(); 

}
else{
    $stmt=$pdo->prepare("SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user INNER JOIN anecdots_tags ON anecdots_tags.id_anecdot = anecdots.id_anecdot WHERE akceptet=1 AND id_tag = $id_tg ");
    $stmt->execute();
    $anecdotarray = $stmt->fetchAll(); 

    $stmt=$pdo->prepare("SELECT COUNT(*) FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user INNER JOIN anecdots_tags ON anecdots_tags.id_anecdot = anecdots.id_anecdot WHERE akceptet=1 AND id_tag = $id_tg");
    $stmt->execute();
    $resultarray = $stmt->fetchAll(); 
    $total_pages = ceil($resultarray[0][0] / $no_of_records_per_page);

    $stmt=$pdo->prepare("SELECT * FROM users INNER JOIN anecdots ON users.id_user = anecdots.anecdot_user INNER JOIN anecdots_tags ON anecdots_tags.id_anecdot = anecdots.id_anecdot WHERE akceptet=1 AND id_tag = $id_tg LIMIT $offset, $no_of_records_per_page");
    $stmt->execute();
    $anecdotarray = $stmt->fetchAll(); 
}


$stmt=$pdo->prepare("SELECT * FROM tags");
$stmt->execute();
$tagsarray = $stmt->fetchAll(); 





//$stmt=$pdo->prepare("SELECT COUNT(*) FROM anecdots");
//$stmt->execute();
//$resultarray = $stmt->fetchAll(); 
//$total_pages = ceil($resultarray[0][0] / $no_of_records_per_page);

//$stmt=$pdo->prepare("SELECT * FROM anecdots LIMIT $offset, $no_of_records_per_page");
//$stmt->execute();
//$anecdotarray = $stmt->fetchAll(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <!--Шапочяка-->
    <header class="menu">
        <div class="container">
        <div class="menu-wrap"> 
        <a href="index.php"><img src="img/logo.png" class="logo-img" alt="Logo"></a>
            <input type="checkbox" id="checkbox_menu">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if($_SESSION['id_role']== 1 ||$_SESSION['id_role']== 2 ||$_SESSION['id_role']== 3 ):?>
                    <li><a href="php/suggest_anecdote.php">Предложить анекдот</a></li>
                    <?php else: ?>
                    <li><a href="php/login.php">Предложить анекдот</a></li>
                    <?php endif ?> 
                    <?php if($_SESSION['id_role']== 1 ||$_SESSION['id_role']== 2 ):?>
                    <li><a href="php/adminpanel.php">Админ.Панель</a></li>
                    <?php endif ?>  
                </ul> 
            </nav>
            <?php if(isset($_SESSION['username'])):?>
                <a class="Join" href="index.php"><?= $_SESSION['username'];?></a>
                <a class="Join" href="php/session_destroy.php">Выход</a>
            <?php else: ?>
                <a class="Join" href="php/login.php">Войти</a> 
            <?php endif ?>  


            <label for="checkbox_menu">
                <i class="fa fa-bars menu-icon"></i>
            </label>
        </div>
    </div>
    </header>
    <!--Шапочяка заканчивается-->

    <div class="container-body">
        <div class="container-anec">
        
        <?///php print_r($resultarray[0]) ?>
        <?///php echo($resultarray[0][0]) ?>
        <?///php echo($_SESSION['id_tag']) ?>
        <?///php echo($_SESSION['id_role']) ?>
        
        <?php foreach ($anecdotarray as $anec):?>
            <form action="php/insert_suggest_anecdote.php" method="POST">
            <div class="anec_post">    
            <?php
            $anech1=explode('.', $anec['anecdot']);
            $a=$anech1[0] .'.';
            if(strlen($a)<=50){
            echo '<h1 class="anec_post_h1">';
            echo $a;
            echo '</h1>';
                   
            }
            else{
                $a=mb_substr($a,0,50,'UTF-8');
                $a=$a .'...';
                echo '<h1 class="anec_post_h1">';
                echo $a;
                echo '</h1>';
            }
            echo '<p class="anec_post_p">';
            echo nl2br($anec['anecdot']);
            echo '</p>';
            ?>
            <div class="anec_info">
                <p class="anecdot_user">Добавил: <?= $anec['user'] ?></p><p class="anecdot_date"><?= $anec['anecdot_date'] ?></p>  
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
                 <div class="anec_tagi_nfo">
                <?php foreach ($tagsallarray as $alltags):?>
                <p class="tags_index"><?= $alltags['tag'] ?></p>
                <?php endforeach;?>
                </div>



            <div class="conteiner_akceptet_button_anecdot">
            <?php if($_SESSION['id_role']=='1'||$_SESSION['id_role']=='2'):?>
                    <button class="button_delete_anecdot_index" type="submit" value="<?= $anec['id_anecdot'] ?>" name="deleteakceptetanecdot_index" id="deleteakceptetanecdot_index">Удалить Анекдот</button>
                    <button class="button_anecdot_index" type="submit" value="<?= $anec['id_anecdot'] ?>"  name="unakceptetanecdot_index" id="unakceptetanecdot_index">Скрыть Анекдот</button>
            <?php endif ?>  
			</div>

            <hr class="hr-shelf">
            </div>
            <?php endforeach;?>	
        </form>   

        <div class="pagination">
        <a href="?pageno=1">Начальные</a>
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Предыдущая</a>
            
        <a href="?pageno=<?=$pageno?>"><?=$pageno?></a>

        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Следующая</a>
        <a href="?pageno=<?php echo $total_pages; ?>">Последние</a>
        </div> 

    </div>
    

 <!-- Правая панель открывается-->
    <div class="wrapper">
        <div class="menu-text-filtr">
            <a  class="menu-text-a">Cейчас выбран: </a> <br>
            <a  class="menu-text-a"><?= $tagsarray[$_SESSION['id_tag']-1][1] ?></a> 
            <hr class="hr-filter">
            <form action="php/tags_anecdot.php" method="POST" >
                <a class="menu-text-a"><button class="button_tagss" type="submit" value="<?= $tagsa['id_tag'] ?>" name="Clear" id="Clear">Очистить фильтр</button></a> 
            </form>
        </div>
            <form action="php/tags_anecdot.php" method="POST" >
                <?php foreach ($tagsarray as $tagsa):?>
                    <div class="menu-text">
                     <a class="menu-text-a"><button class="button_tagss" type="submit" value="<?= $tagsa['id_tag'] ?>" name="button_tag_wrap" id="button_tag_wrap"><?= $tagsa['tag'] ?></button></a>
                    </div>
                <?php endforeach;?>
            </form>        
        </div>

    
    </div>
<!-- Правая панель закрывается-->


<!--Кнопка открытия начинается -->
<input type="checkbox" id="side-checkbox" />
<div class="side-panel">
    <label class="side-button-2" for="side-checkbox">+</label>    
    <div class="menu-text-filtr">
    <a  class="menu-text-a">Cейчас выбран: </a> <br>
    <a  class="menu-text-a"><?= $tagsarray[$_SESSION['id_tag']-1][1] ?></a>
    <form action="php/tags_anecdot.php" method="POST" >
                <a class="menu-text-a"><button class="button_tagss" type="submit" value="<?= $tagsa['id_tag'] ?>" name="Clear" id="Clear">Очистить фильтр</button></a> 
            </form>
    </div>
    <form action="php/tags_anecdot.php" method="POST" >
    <?php foreach ($tagsarray as $tagsa):?>
            <div class="menu-text">
            <a class="menu-text-a"><button class="button_tagss" type="submit" value="<?= $tagsa['id_tag'] ?>" name="button_tag_wrap" id="button_tag_wrap"><?= $tagsa['tag'] ?></button></a>
            </div>
        <?php endforeach;?>
    </form>  
</div>
<div class="side-button-1-wr">
    <label class="side-button-1" for="side-checkbox">
        <div class="side-b side-open">&#129044;</div>
        <div class="side-b side-close">&#129046;</div>
    </label>
</div>
<!--Кнопка открытия заканчивается -->



</body>
</html>