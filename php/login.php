<?php
	session_start();
	require_once('auth.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Paper Stack</title>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
</head>
<body>
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
                <a class="Join" href="../login.php"><?= $_SESSION['username'];?></a>
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


<div class="container-body">
	<div class="form-style-8">
  	<h2>Авторизация</h2>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
			<input type="text" placeholder="Username" id="username" name="username"/>
			<input type="password" placeholder="Password" id="password" name="password"/>
			<input type="submit" value="Log In" name="reg" id="reg"/>
			<a href="signup.php">Зарегистрироваться </a>
		</form>
	</div>
</div>

</body>
</html>
