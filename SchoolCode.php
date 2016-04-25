<?php
include 'loginDBconfig.php';
    $schoolcode = $_POST['schoolcode'];
   try{
        $user_token = $_POST['token'];
        $stmt = $db->prepare("UPDATE users SET schoolcode='".$schoolcode."' WHERE token='".$user_token."'");
        $stmt->execute(array(":code"=>$schoolcode));
            echo '{"success":true}';   
        
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>