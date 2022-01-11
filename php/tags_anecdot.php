<?php
session_start();
if(isset($_POST['Clear'])){
    $id_tag=$_POST['id_tag'];
    $_SESSION['id_tag']=1;
    header('Location: ../index.php');
        
}


if(isset($_POST['button_tag_wrap'])){
        $id_tagnew=$_POST['button_tag_wrap'];
        $_SESSION['id_tag']=$id_tagnew;
        header('Location: ../index.php');
            
    }
?>

