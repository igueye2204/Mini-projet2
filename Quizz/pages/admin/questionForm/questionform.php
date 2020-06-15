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

$erreur="";
if (isset($_POST['typetext'], $_POST['nbrepoints'], $_POST['select'], $_POST['nbrchamp']) && !empty($_POST['typetext']) && !empty($_POST['nbrepoints']) && !empty($_POST['select'])){

    // ============== J'initialise mon tableau =================


    $question     = htmlspecialchars(stripslashes(trim($_POST['typetext'])));
    $nbrepoints   = htmlspecialchars(stripslashes(trim($_POST['nbrepoints'])));
    $nbrechamps   = htmlspecialchars(stripslashes(trim($_POST['nbrchamp'])));
    $typequestion = htmlspecialchars(stripslashes(trim($_POST['select'])));

    // ==========================================================

    // ==================== Je verifie le choix =================
    // 1. C'est Soit Choix Multiple 
    //        Pour Choix multiple je recupere les inputs des champs générés et 
    //        Et je verifie les checkbox cochés
    // 2. CHOIX Simple
    //         C'est la meme chose que le choix multiple mais ici on verifie 
    //         Une seule case coché qui est bouton radio
    // 3. Choix Texte
    //        Il suffit seulement de recuperer Le champ input generé
   
        if ($_POST['select'] == "Choix_multiple") {

            for ($i = 0; $i <= (int) $_POST['nbrchamp']; $i++) {
                if (isset($_POST["rep_texte$i"])) {
                    $tabrep[$i]['valeur'] = $_POST["rep_texte$i"];
                    if (in_array($i, $_POST['cocher'])) {
                        $tabrep[$i]['statut'] = true;
                    } else {
                        $tabrep[$i]['statut'] = false;
                    }
                }
            }
        } elseif ($_POST['select'] == "choix_simple") {
            for ($i = 0; $i <= (int) $_POST['nbrchamp']; $i++) {
                if (isset($_POST["rep_texte$i"])) {
                    $tabrep[$i]['valeur'] = $_POST["rep_texte$i"];
                    if ($i == (int) $_POST['radio']) {
                        $tabrep[$i]['statut'] = true;
                    } else {
                        $tabrep[$i]['statut'] = false;
                    }
                }
            }
        } elseif ($_POST['select'] == "text") {
            $tabrep = $_POST["rep_texte"];
        }
        $reponse = $tabrep;

       
    // =======================================================================
    // ====================== Enregistrement =================================
    //---------------------sur la Base de donnée--------------------//
        $connection = Database::connect();
        $statement = $connection->prepare("INSERT INTO tabquestion (question,point,typequestion,nbrchamp,reponse) VALUES (?,?,?,?,?)");
        $statement->execute(array($question,$nbrepoints,$typequestion,$nbrechamps,$reponse));
        Database::disconnect();
        
    
    // ======================== FIN ==========================================
  
}
?>
<div class="enregistrer"></div>