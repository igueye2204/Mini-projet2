<?php
require_once "Quizz/data/databaseQuiz.php";
    // =======================================================================//
    // ====================== Enregistrement dans ============================//
    //                    Fichier Json  parametre.json

    if(isset($_POST['ok'])){
        if($_POST['nbreQpage']<5){

            $erreur = "Erreur:  Veuillez saisir une valeur supérieur où égal à 5 !";

        }else{

            $nbrQpage = $_POST['nbreQpage'];
            $datasetting['NbrQuestion'] = $nbrQpage;
           //---------------------Récuperation sur la Base de donnée--------------------//
            $db = Database::connect();
            $statement = $db->prepare("UPDATE nbrequestion SET number=(?)");
            $statement->execute(array($nbrQpage));
            Database::disconnect();
        }     
    }
  // ======================== FIN ===========================================//
  $db = Database::connect();
  $stmt= $db->prepare("SELECT * FROM `nbrequestion`");
  $stmt->execute();
  $data=[];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $data=$row;
  }

?>



<div><h3 class="enteteLQuestion">Nbre de Question/Jeu </h3></div>
            <form action="" method="post" id="nbrePage">  
                <input type="text" name="nbreQpage" error="error-3" value="<?php echo $data['number'];?>" class="nbrepage">
                <span class="error-form" id="error-3"></span>
                <button type="submit" name="ok" value="ok" class="okQuestion">OK</button>
            </form>

<div class="listeQuestion">
<?php 
    
    $stmt= $db->prepare("SELECT * FROM `nbrequestion`");
    $stmt->execute();
    $data=[];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $data=$row;
    }
    //         $nbrdevaleurparpage = $datasetting['NbrQuestion'];
    //         $totaValeur = count($json);
    //         $nbredepage = ceil($totaValeur/$nbrdevaleurparpage);

    //     if (isset($_GET['liste'])){
    //         $pageActuelle = $_GET['liste'];
    //         if ($pageActuelle > $nbredepage){
            
    //             $pageActuelle = $nbredepage;
    //         }
    //     }else{
    //         $pageActuelle=1;
    //     }
    //     $indiceDepart = ($pageActuelle-1)*$nbrdevaleurparpage;
    //     $indiceDeFin = $indiceDepart+$nbrdevaleurparpage-1;

    //     foreach($json as $key => $utilisateur){

    //             $tab0[] = $utilisateur;
    //     }

    //     echo '<table style="width: 580px; height: 40;position: absolute;top: 60px; font-size: 5mm;box-shadow: 0 0 0 1px #03b7ec;border-radius: 5px;text-align: justify;margin-left: 20px; border: 1px black; font-size: ;color:#818181;">';
    //     for($i=$indiceDepart; $i<= $indiceDeFin; $i++)
    //     {
            
    //         echo "<tr style='font-size:5mm;'><td>".($i+1).". ".$tab0[$i]["question"]."</td></tr><br>";
    //         if ($tab0[$i]["typequestion"] == "text") {
    //                 echo "<tr><td>";
    // <input type="text" name="textReponse" value="<?=$tab0[$i]["reponses"]" style="padding-left: 10px;margin-left: 20px;color: #818181;font-size: medium;" readonly="readonly">
    //                 <?php
    //                 echo "</td></tr><br>";
    //         }
            
    //         if($tab0[$i]["typequestion"] == "choix_simple"){
    //             foreach ($tab0[$i]["reponses"] as $value) {
    //                 echo "<tr><td>";
    //                 if ($value['statut'] == true) {
    //                         <input type="radio" name="radioSelect"  style="color:#51bfd0;margin-left: 20px;" checked="checked" id="">
    //                 <?php
                        
    //                 }else{
    //                     <input type="radio" name="radioSelect"  style="color:#51bfd0;margin-left: 20px;" id="">
    //                 <?php
    //                 }
    //                 echo $value['valeur']."</td></tr><br>";
    //             }
    //         }
    //         if($tab0[$i]["typequestion"] == "Choix_multiple"){
    //             foreach ($tab0[$i]["reponses"] as $value) {
    //                 echo "<tr><td>";
    //                 if ($value['statut'] == true) {
    //                     <input type="checkbox"  name="checkboxSelect" style="color:#51bfd0;margin-left: 20px;" checked="checked" id="">
    //                 <?php
    //                 }else{
    //                     <input type="checkbox"  name="checkboxSelect" style="color:#51bfd0;margin-left: 20px;" id="">
    //                 <?php
    //                 }
    //                 echo $value['valeur']."</td></tr><br>";   
    //             }
    //         }
    //     }
    //     echo "</table>";
    //     <div id="error-3" style="position:absolute;color:red;top:510px;left:20px;font-size:larger;"><?=$erreur?></div> <?php
        
    //     if ($pageActuelle>1) 
    //     {
    //         $precedent = $pageActuelle-1;
    //         echo  '<a class="precedent" href="index.php?lien=accueil&page=liste-question&liste='.$precedent.'" style="top: 490px;left: 40px;">Precedent</a>';
    //     }
    //     if ($pageActuelle<$nbredepage) 
    //     {
    //         $Suivant = $pageActuelle+1;
    //         echo  '<a class="suivant" href="index.php?lien=accueil&page=liste-question&liste='.$Suivant.'" style="top: 490px;left: 480px;">Suivant</a>';
    //     }
    //     if($pageActuelle==$nbredepage) 
    //     {
    //         $precedent = $pageActuelle-1;
    //         echo  '<button typ=submit class="precedent"><a href="index.php?lien=accueil&page=liste-question&liste='.$precedent.'" style="top: 490px;left: 40px;">Precedent</a></button>';
    //     }
            ?>
    </div>
</div>
<script>

document.getElementById("nbrePage").addEventListener("submit",function(e){
    const nombrePage = document.getElementsByTagName("nbreQpage");
    var error=false;
    for(nbreQpage of nombrePage)
    {
        if(nbreQpage.hasAttribute("error"))
        {
            var idDivError = nbreQpage.getAttribute("error");
                if(nbreQpage.value<5)
                {
                    document.getElementById(idDivError).innerText="Erreur: Veuillez saisir une valeur supérieur où égal à 5 !"
                    error=true
                }
                 
        }
        else
        {
            document.getElementById(idDivError).innerText=""
        }
    }
    if(error)
    {
        e.preventDefault();
        return false;
    }
})

</script>