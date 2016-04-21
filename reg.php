<?php
include 'loginDBconfig.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    
   try{
       
      // $stmt = $db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
      // $stmt->execute(array($username));
      // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
       //if($stmt->rowCount() > 0){
         //  echo '{"success":false}';
      // }else{
            $stmt = $db->prepare("INSERT INTO users (username, password, firstname, lastname, type) VALUES('".$username."','".$password."','".$firstname."','".$lastname."', '".$type."');");
            $stmt->execute(array($username,$password,$firstname,$lastname, $type));
            echo '{"success":true}'; 
      // }
       }catch(PDOException $e){
            echo $e->getMessage();
        }
?>