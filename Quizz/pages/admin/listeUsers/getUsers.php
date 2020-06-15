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

    define('DB_HOST',$_SERVER['HTTP_HOST']);
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_NAME','quizdb');
 
    define('ID','id');
    define('PAGE','page');
    define('NB_ELT','nb_elt');
    define('PAS','pas');   
    define('CHAMP','champ'); 
    
    $connection = Database::connect(); 
    $tabId=$tab=[];
  
//   function getPrepSel($table,$donnees=[],$id=0){
//       $reqUsr= "SELECT * FROM `".DB_NAME."`.`".$table."`";         
//       $w=" WHERE ";                
//       if(isset($donnees[CHAMP])){
//           $reqUsr.= " WHERE `".$donnees[CHAMP]."`=?";
//           $w=" AND ";
//       }
//       // Limitation pour la table USER
//       if(($table=="users")&&($id==0)){            
//           $debut=($donnees["page"]-1)*$donnees[NB_ELT];
//           $reqUsr.= $w." `status`=1 LIMIT ".$debut.",".$donnees[PAS];
//       }
//       return $reqUsr;	
//   }
  
  function select($requete,$connection,$cond=[]){	
      $stmt= $connection->prepare($requete);
      $stmt->execute($cond); 
      $data=[];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $data[]=$row;
      }
      return $data;
  } 
  

    
 
    if($_GET[ID]>0){
      $tabId=array($_GET[ID]);
      $tab=array(CHAMP=>ID);
    }
    if(!isset($_SESSION[PAS])){
      $_SESSION[PAS]=$_GET[NB_ELT]; 
    }

    if($_GET[PAGE] == 1){
        $_SESSION[PAGE]=0;
    }

    $_SESSION[PAGE]++;
    $tab[PAS]=$_SESSION[PAS];
    $tab[NB_ELT]=$_GET[NB_ELT];
    $tab[PAGE]=$_SESSION[PAGE];

    $req = "SELECT * FROM `users` WHERE `profil`='admin'";
   // $tab["req"]=$req;
  
    if($_SESSION[PAS] != $_GET[NB_ELT]){
        $_SESSION[PAS]=$_GET[NB_ELT];
    }   
    $res = select($req,$connection);

    $tab["value"]=$res;
    $tab["NB_ELT"]=count($res);
    $tab["type"]=$_GET[ID];
  
    echo json_encode($tab);

 ?>