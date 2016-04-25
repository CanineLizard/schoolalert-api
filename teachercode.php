<?php
    include 'loginDBconfig.php';

    $teachercode = $_POST['teachercode'];

    $user_token = $_POST['token'];
    $stmt = $db->prepare("SELECT * FROM users WHERE schoolcode='".$teachercode."' LIMIT 1");        
    $stmt->execute(array(":schoolcode"=>$teachercode));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
           $stmt = $db->prepare("UPDATE users SET teachercode='".$teachercode."' WHERE token='".$user_token."'");
           $stmt->execute(array(":teachercode"=>$teachercode));
           echo '{"success":true}';   
        }
?>