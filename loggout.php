<?php
    include 'loginDBconfig.php';
    session_destroy();
    unset($_SESSION['user_session']);
    echo '{"success":true}';  
?>