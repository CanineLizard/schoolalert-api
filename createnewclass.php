<?php
include 'loginDBconfig.php';
    
    $classcode = $_POST['classcode'];

        $user_token = $_POST['token'];
        $stmt = $db->prepare("SELECT * FROM users WHERE token='".$user_token."'" );
        $stmt->execute(array(":token"=>$user_token));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        
        $firstname = $userRow['firstname'];
        $lastname = $userRow['lastname'];
       
   try{
         $stmt = $db->prepare("INSERT INTO classrooms (TeacherFirst, TeacherLast, classCode) VALUES('".$firstname."','".$lastname."', '".$classcode."');");
         $stmt->execute(array($firstname,$lastname,$classcode));

            echo '{"success":true}';   
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>