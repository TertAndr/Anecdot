<?php
	session_start();
    unset($_SESSION['username']); 
    unset($_SESSION['id_user']); 
    unset($_SESSION['id_role']); 

    $_SESSION['id_tag'] = 1;
    $_SESSION['id_role'] = 0 ; 
    header('Location: ../index.php');
?>