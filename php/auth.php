<?php
	session_start();
	require_once('db.php');

	if(isset($_POST['reg'])){
		$username=$_POST['username'];
		$password=$_POST['password'];

		$stmt=$pdo->prepare("SELECT * FROM users WHERE `user`= ?  AND `password`= ? ");
		$stmt->execute([$username,$password]);
		$array = $stmt->fetchAll(PDO::FETCH_BOTH);

		///print_r($array);
		if(count($array)==1){
			$_SESSION['username']=$username;
			$_SESSION['id_user']=$array[0]['id_user'];
			unset($_SESSION['id_role']); 
			$_SESSION['id_role']=$array[0]['id_role'];
			header('Location: ../index.php');
		}
		if(count($array)==0){
			echo("Логин или пароль не верны");
		}

	}
?>