<?php
   $success = false;
   $code = $_POST["code"];
   if (strpos($code,"'") === false) {
      $dbh = new mysqli('localhost', 'root', NULL, 'schoolchat');
      $sql = "SELECT name,text FROM messages WHERE code='$code'";
      $result = $dbh->query($sql);
      echo '{"success":true,"messages":[{"name":"Welcome","text":"School Alert"}';

       while($row = $result->fetch_assoc()) {
         echo ',{"name":"'.$row['name'].'","text":"'.str_replace('"', '\"', str_replace('\\','\\\\', $row['text'])).'"}';
      }
      echo ']}';
   } else {
      echo '{"success":false,"messages":[]}';
   }
?>