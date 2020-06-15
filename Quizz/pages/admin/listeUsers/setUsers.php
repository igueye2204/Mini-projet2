<?php
    class Database
    {
        private static $dbHost = "localhost"; 
        private static $dbName = "quizdb"; 
        private static $dbUser = "root"; 
        private static $dbUserPassword = ""; 
     
        private static $connection = null;
     
        public static function connect()
        {
             try 
             {
                 self::$connection = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName,self::$dbUser,self::$dbUserPassword);
             } 
             catch (PDOException $e) 
             {
                die($e->getMessage());
             }
             return self::$connection;
        }
     
        public static function disconnect()
        {
         self::$connection = null;
        }
    
    
        
    }
    $connection = Database::connect();
    function getPrepIns($table){
        $prep['users']="INSERT INTO `users` (`firstname`,`name`,`login`,`password`,`image`) VALUES ( ?, ?, ?, ?, ?);";
        return $prep[$table];	
    }
    
    function setReq($con,$prepa,$data){
        try {
            $stmt = $con->prepare($prepa); 
            try {
                $a=array_values($data);
                $stmt->execute($a);
                return $con->lastInsertId();			
            } catch(PDOException $e) {
                print "Error!: " . $e->getMessage() . "</br>";
                return 0;
            }
        } catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "</br>";
            return 0;
        }	
    } 
    
    function getPrepSel($table,$donnees=[],$id=0){
        $reqUsr= "SELECT * FROM `".DB_NAME."`.`".$table."`";         
        $w=" WHERE ";                
        if(isset($donnees[CHAMP])){
            $reqUsr.= " WHERE `".$donnees[CHAMP]."`=?";
            $w=" AND ";
        }
        // Limitation pour la table USER
        if(($table=="users")&&($id==0)){            
            $debut=($donnees["page"]-1)*$donnees[NB_ELT];
            $reqUsr.= $w." `status`=1 LIMIT ".$debut.",".$donnees[PAS];
        }
        return $reqUsr;	
    }
    
    $tab_img=$data=[];
    $prepUser = getPrepIns('users'); 
    foreach ($_POST as $usr) {
        $imgs = array_pop($usr);
        $id_user=setReq($connection,$prepUser,$usr);
        $data[]=$id_user;
    } 
    
    echo json_encode($data);
?>