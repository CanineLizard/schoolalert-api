<?php
include 'loginDBconfig.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

   try{
        $stmt = $db->prepare("SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1");
        $stmt->execute(array(':username'=>$username, ':password'=>$password));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        
       if($stmt->rowCount() > 0){
           $_SESSION['user_session'] = $userRow['id'];
            echo '{"success":true,"type":"'.$userRow['type'].'"}';   
        } else {
            echo '{"success":false,"error":"Username or password was incorrect."}';
       }
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>