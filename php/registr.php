<?php
	require_once('db.php');
	
	if(isset($_POST['reg'])){
		$username=$_POST['username'];
        $password=$_POST['password'];
        
        $stmt=$pdo->prepare("SELECT * FROM users WHERE user= $username");  
        $stmt->execute([$username]);
        $array = $stmt->fetchAll(PDO::FETCH_BOTH);
        ///print_r($array);
       ///echo($array[0]['user']);
		if(empty($array)){

		///$sql="insert into users(username, password, role_id) values ('$username','$hashed_password',1)";
        $stmt=$pdo->prepare("INSERT INTO users (`user`,`password`,`id_role`) VALUES (?,?,?)"); 
        $stmt->execute([$username,$password,3]);
        header('Location: ../index.php');
        }
        else{
            echo "Такой уже есть";
            header('Location: ../index.php');
        }
	}
	
	
	
?>