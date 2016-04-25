<?php
    include 'loginDBconfig.php';

    
    $user_token = $_POST['token'];
    $stmt = $db->prepare("SELECT * FROM users WHERE token='".$user_token."'");
    $stmt->execute(array(":token"=>$user_token));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $type = $userRow['type'];
    $username = $userRow['username'];
    $firstname = $userRow['firstname'];
    $lastname = $userRow['lastname'];
    
    if($type === "student"){
    $query =$db->prepare("SELECT * FROM studentclassrooms WHERE username='".$username."'");
    $query->execute(array(":username"=>$username));
        echo '{"success":true,"codes":[{"code":"0"}';

       while($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
         echo ',{"code":"'.$fetch['classcode'].'"}';
      }
      echo ']}';
    }else if($type === "teacher"){
        $query =$db->prepare("SELECT * FROM classrooms WHERE TeacherFirst='".$firstname."' AND TeacherLast='".$lastname."'");
        $query->execute();
         echo '{"success":true,"codes":[{"code":"0"}';

         while($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
            echo ',{"code":"'.$fetch['classCode'].'"}';
      }
      echo ']}';
    }
    
    
    
?>