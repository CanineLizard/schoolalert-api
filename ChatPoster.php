<?php
    include 'loginDBconfig.php';

    $user_token = $_POST['token'];
    $stmt = $db->prepare("SELECT * FROM users WHERE token='".$user_token."'");        
    $stmt->execute(array(":token" =>$user_token));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $user = ucwords($userRow['firstname']) . " " . ucwords($userRow['lastname']); 


    if(isset($_POST['text'])){
        $text = strip_tags(stripslashes($_POST['text']));
        $name = $user;
        $code = $_POST['code'];
            if(!empty($text) && !empty($name)){
              
                $stmt = $db->prepare("INSERT INTO messages VALUES('', ?, ?, ?);");
                $stmt->execute(array($name, $text, $code));
                
                  echo '{"success":true}';  
            }else{
                echo '{"success": false}';
            }
            
    }
?>