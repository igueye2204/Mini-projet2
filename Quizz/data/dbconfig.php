<?php
require_once("Quizz/traitement/const.php");
require_once("Quizz/data/databaseQuiz.php");
$con= Database::connect();
// try {
//     $con= new PDO ('mysql: host='.DB_HOST.';dbname ='.DB_NAME, DB_USER, DB_PASSWORD);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
//     return $con;
// } catch (PDOException $e) {
//     return false;
// }		

function getPrepIns($table){
    $prep['users']="INSERT INTO `users` (`firstname`,`name`,`login`,`password`,`image`) VALUES ( ?, ?, ?, ?, ?
    );";
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

function select($requete,$con,$cond=[]){	
    $stmt= $con->prepare($requete);
    $stmt->execute($cond); 
    $data=[];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[]=$row;
    }
    return $data;
} 


function getPrepUp($data,$idName="id",$where=null){	
    $prep="UPDATE `".DB_NAME."`.`".$data['table']."` SET `".$data[CHAMP]."`='".$data['val']."' WHERE $idName=?";
    $w="";
    if($where){
        foreach ($where as $name) {
            $w .= " AND $name=?";
        } 
        $prep .= $w;
    }
    return $prep;	
}

?>