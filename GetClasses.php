<?php
    
    $first = 'Wendy';
    $last = 'nice';

    $db = new PDO('mysql:host=127.0.0.1;dbname=schoolchat','root','');


    $query =$db->prepare("SELECT * FROM classrooms WHERE TeacherFirst='".$first."' AND TeacherLast='".$last."' ");
    $query->execute();

    while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
      $name = $fetch['id'];
      $message = $fetch['classCode'];
        
        echo "<h6 class='cm'><b>".$name."</b> - ".$message."</h6>";
    }
?>