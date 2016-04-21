<?php

class USER{
    
    private $DB;
    
     function __construct($db)
    {
      $this->DB = $db;
    }
    
    public function hasUsername($username){
         $stmt = $this->DB->prepare("SELECT * FROM users WHERE username='".$username."'");
        $stmt->execute(array(':username'=>$username));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            return true;
        }
    }
    
    public function register($username, $password, $firstname, $lastname, $type){
        try{
            $stmt = $this->DB->prepare("INSERT INTO users (username, password, firstname, lastname, type) VALUES('".$username."','".$password."','".$firstname."','".$lastname."', '".$type."');");
            $stmt->execute(array($username,$password,$firstname,$lastname, $type));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    
    public function login($username, $password){
        try{
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1");
        $stmt->execute(array(':username'=>$username, ':password'=>$password));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
            $_SESSION['user_session'] = $userRow['id'];
               return true;
        }
       }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    public function isLogged(){
        if(isset($_SESSION['user_session'])){
            return true;
        }
    }
    
    public function toPage($page){
       header("Location: $page");
    }
    public function logout(){
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
    
    public function type(){
    $user_id = $_SESSION['user_session'];
    $stmt = $this->DB->prepare("SELECT * FROM users WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $type = $userRow['type'];
        
        return $type;
        
    }
    
    public function setTeacherCode($code){
        $user_id = $_SESSION['user_session'];
        $stmt = $this->DB->prepare("UPDATE users SET code='".$code."' WHERE id='".$user_id."'");
        $stmt->execute(array(":code"=>$code));
        
    }
    
    public function checkTeacherCode($code){
        $user_id = $_SESSION['user_session'];
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE code='".$code."' LIMIT 1");
        $stmt->execute(array(":code" =>$code));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
               return true;
        }
    }
    
    public function insertTeacherCode($code){
        $user_id = $_SESSION['user_session'];
        $stmt = $this->DB->prepare("UPDATE users SET teachercode='".$code."' WHERE id='".$user_id."'");
        $stmt->execute(array(":teachercode"=>$code));
    }
    
    public function hasTeacherCode(){
        $user_id = $_SESSION['user_session'];
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE id='".$user_id."'" );
        $stmt->execute(array(":id"=>$user_id));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($userRow['teachercode'] != ""){
            return true;
        }
    }
    
    public function createClass($firstname, $lastname, $classcode){
         $stmt = $this->DB->prepare("INSERT INTO classrooms (TeacherFirst, TeacherLast, classCode) VALUES('".$firstname."','".$lastname."', '".$classcode."');");
         $stmt->execute(array($firstname,$lastname,$classcode));
    }
}

?>