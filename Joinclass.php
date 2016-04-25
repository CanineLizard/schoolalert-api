<?php
include 'loginDBconfig.php';
    
    $classcode = $_POST['classcode'];

    $user_token = $_POST['token'];
    $stmt = $db->prepare("SELECT * FROM users WHERE token='".$user_token."'");
        $stmt->execute(array(":token"=>$user_token));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                $username = $userRow['username'];

   try{
        $stmt = $db->prepare("SELECT * FROM classrooms WHERE classCode='".$classcode."' LIMIT 1");
        $stmt->execute(array(":classCode"=>$classcode));
         $classRow=$stmt->fetch(PDO::FETCH_ASSOC);
        
       if($stmt->rowCount() > 0){
                $qwe = $db->prepare("INSERT INTO studentclassrooms VALUES('', ?,?);");
                $qwe->execute(array($username, $classcode));
                echo '{"success":true}';
        } else {
            echo '{"success":false,"error":"Username or password was incorrect."}';
       }
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>