<?php
include 'loginDBconfig.php';
    
    $classcode = $_POST['classcode'];

        $user_id = $_SESSION['user_session'];
        $stmt = $db->prepare("SELECT * FROM users WHERE id='".$user_id."'" );
        $stmt->execute(array(":id"=>$user_id));
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