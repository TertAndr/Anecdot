<?php
	session_start();
	require_once('db.php');

	if(isset($_POST['addanecdot'])){
    $anecdot_text=$_POST['anecdot_text'];
    $id_user=$_SESSION['id_user'];
    $today=date("Y-m-d H:i:s");
    $akceptet=0;  
    ///echo($anecdot_text);
    ///echo($id_user);
    ///echo($today);
		///$sql="insert into users(username, password, role_id) values ('$username','$hashed_password',1)";

        $stmt=$pdo->prepare("INSERT INTO anecdots (`anecdot_date`,`anecdot_user`,`anecdot`) VALUES (?,?,?)"); 
        $stmt->execute([$today,$id_user,$anecdot_text]);
        header('Location: ../index.php');
        
    }

    if(isset($_POST['akceptetanecdot'])){
        $anecdot_text=$_POST['anecdot_text'];
        $id_anecdot=$_POST['akceptetanecdot'];
        $akceptet=1; 
        $checkbox = $_POST['tagsar'];
        ///echo($anecdot_text);
        ///echo($id);
        ///echo($akceptet);
    
            $stmt=$pdo->prepare("UPDATE anecdots SET `anecdot`=?, `akceptet`=? WHERE id_anecdot=?"); 
            $stmt->execute([$anecdot_text,$akceptet,$id_anecdot]);

            ///print_r($checkbox);

                $stmt=$pdo->prepare("DELETE FROM anecdots_tags WHERE `id_anecdot`=?"); 
                $stmt->execute([$id_anecdot]);    
            if ($checkbox !=null) {
                foreach ($checkbox as $tags):
                    $stmt=$pdo->prepare("INSERT INTO anecdots_tags (`id_anecdot`,`id_tag`) VALUES (?,?)"); 
                    $stmt->execute([$id_anecdot,$tags]);
                    ///echo($id_anecdot);
                    //echo($tags);
                    endforeach;
            }
           

            header('Location: adminpanel.php');
            
    }



    if(isset($_POST['unakceptetanecdot_index'])){
        $id_anecdot=$_POST['unakceptetanecdot_index'];
        $akceptet=0; 
        ///echo($anecdot_text);
        ///echo($id);
        ///echo($akceptet);
    
            $stmt=$pdo->prepare("UPDATE anecdots SET `akceptet`=? WHERE id_anecdot=?"); 
            $stmt->execute([$akceptet,$id_anecdot]);
            header('Location: ../index.php');
            
    }



    if(isset($_POST['deleteakceptetanecdot'])){
        ///$anecdot_text=$_POST['anecdot_text'];
        $id_anecdot=$_POST['deleteakceptetanecdot'];
        ///echo($anecdot_text);
        ///echo($id);
        ///echo($akceptet); 

            $stmt=$pdo->prepare("DELETE FROM anecdots WHERE id_anecdot=?"); 
            $stmt->execute([$id_anecdot]);
            header('Location: adminpanel.php');
            
    }

    if(isset($_POST['deleteakceptetanecdot_index'])){
        ///$anecdot_text=$_POST['anecdot_text'];
        $id_anecdot=$_POST['deleteakceptetanecdot_index'];
        ///echo($anecdot_text);
        ///echo($id);
        ///echo($akceptet); 

            $stmt=$pdo->prepare("DELETE FROM anecdots WHERE id_anecdot=?"); 
            $stmt->execute([$id_anecdot]);
            header('Location: ../index.php');
            
    }

?>