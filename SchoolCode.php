<?php
include 'loginDBconfig.php';
    $schoolcode = $_POST['schoolcode'];
   try{
        $user_id = $_SESSION['user_session'];
        $stmt = $db->prepare("UPDATE users SET code='".$schoolcode."' WHERE id='".$user_id."'");
        $stmt->execute(array(":code"=>$schoolcode));
            echo '{"success":true}';   
        
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>