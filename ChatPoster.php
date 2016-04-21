<?php
    $db = new PDO('mysql:host=127.0.0.1;dbname=schoolchat','root','');

    if(isset($_POST['text']) && isset($_POST['name'])){
        $text = strip_tags(stripslashes($_POST['text']));
        $name = strip_tags(stripslashes($_POST['name']));
        $code = intval($_POST['code']);
            if(!empty($text) && !empty($name)){
              
                $stmt = $db->prepare("INSERT INTO messages VALUES('', ?, ?, ?);");
                $stmt->execute(array($name, $text, $code));
                
                echo "<li class='cm'><b>".ucwords($name)."</b> - ".$text."</li>";
            }
    }
?>