<?php
    
    

    $db = new PDO('mysql:host=127.0.0.1;dbname=schoolchat','root','');
    $user_token = $_POST['token'];
    $stmt = $db->prepare("SELECT * FROM users WHERE token='".$user_token."'");        
    $stmt->execute(array(":token" =>$user_token));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $first = $userRow['firstname']; 
    $last = $userRow['lastname'];


    $query =$db->prepare("SELECT * FROM classrooms WHERE TeacherFirst='".$first."' AND TeacherLast='".$last."' ");
    $query->execute();

    echo '{"success":true,"codes":[{"code":"0"}';

       while($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
         echo ',{"code":"'.$fetch['classCode'].'"}';
      }
      echo ']}';
?>