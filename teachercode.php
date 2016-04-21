<?php
    include 'loginDBconfig.php';

    $teachercode = $_POST['teachercode'];

    $user_id = $_SESSION['user_session'];
    $stmt = $db->prepare("SELECT * FROM users WHERE code='".$teachercode."' LIMIT 1");        
    $stmt->execute(array(":code" =>$teachercode));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
           $stmt = $db->prepare("UPDATE users SET teachercode='".$teachercode."' WHERE id='".$user_id."'");
           $stmt->execute(array(":teachercode"=>$teachercode));
           echo '{"success":true}';   
        }
?>