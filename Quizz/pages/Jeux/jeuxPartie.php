<?php
  $dbHost = "localhost"; 
  $dbName = "quizdb"; 
  $dbUser = "root"; 
  $dbUserPassword = ""; 
      try 
      {
          $connection = new PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUser,$dbUserPassword);
      } 
      catch (PDOException $e) 
      {
         die($e->getMessage());
      }
  $recup = array();
  $statement = $connection->query('SELECT * FROM tabquestion');
  while ($scoreJoueur = $statement->fetch()) {
      $recup[] = $scoreJoueur;
  }
  $stmt= $connection->prepare("SELECT * FROM `nbrequestion`");
    $stmt->execute();
    $data=[];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $data=$row;
    }
?>
<div class="form-question">
    <div class="question1">
        
        
    </div>
    <div    class="Q1">
            
        <?php
            $j = 0;
            $i = 0;
            $lq = 0;
            $reps= '';
            $question= [];
            $total_page=$data['number'];
            $_SESSION['in_json']=0;
           //tester si le joueur existe dans le fichier des questions dèjà repondues
           if(isset($exist)){
            foreach($exist as $value){ 
                    if($_SESSION['user']['login']==$value['login']){
                        $_SESSION['in_json']=1;
                    }$j++;
                }
            }
            
            //tester si la question existe dans le fichier des questions dèjà repondues
            //sino on l'ajoute
             $sorti =0;
            // while (!empty($recup[$i]) || $sorti ==0 ){
            //     if($_SESSION['in_json'] ==0){
            //         $question[$i]= $recup[$i];
            //     }else{
            //         if(isset($exist)){
            //             if(!in_array($recup[$i]['question'],$exist[$i]['question']))
            //               $question[$i]= $json[$i];
            //           }
            //     }
            //     if(count($question)==$total_page) $sorti =1;
            //     $i++;
            // }
           //var_dump($question);
        ?>
        
        <?php 
        
            if(isset($question) ){
                    if(!isset($_SESSION['str'])){$_SESSION['str']=1;}
                    if($_SESSION['str']==1){shuffle($question); $_SESSION['str']=2;}
                    $_SESSION['c'] =$question;
                   if(isset($_POST['suivant']))
                   { 
                    
                    $_SESSION['q'][] = $_POST;
                       $_SESSION['i'] = $_POST['suivant']+1;
                        $lq = $_SESSION['i'] ;
                      
                   }
                   if(isset($_POST['precedent'])){
                        $_SESSION['i']=$_POST['precedent'];
                        $lq = $_SESSION['i']; 
                        unset($_SESSION['q'][$lq]); 
                   }
                   if(isset($_POST['suivant']) && $_POST['suivant']=="fin"){

                        header('location: index.php?lien=jeux&page=score-joueur');
                   }
        
        $value=$j=0;
        // $out = shuffle_extra($json);
        
        for ($j=0; $j < count($recup); $j++){

            $tab0[] = $recup[$j];
        }
    
        $nbrdevaleurparpage = 1;
        $totaValeur = count($recup);
        $nbredepage = ceil($totaValeur/$nbrdevaleurparpage);
    
            if (isset($_GET['liste'])) 
            {
                $pageActuelle = $_GET['liste'];
                if ($pageActuelle > $nbredepage) 
                {
                    $pageActuelle = $nbredepage;
                }
            }
            else 
            {
                $pageActuelle=1;
            }
            $indiceDepart = ($pageActuelle-1)*$nbrdevaleurparpage;
            $indiceDeFin = $indiceDepart+$nbrdevaleurparpage-1;
            
            
            
            
        echo '<table style="width: 580px; height: 80px;position: absolute;top: 200px; left: 10px; font-size: 7mm;text-align: justify;margin-left: 20px;">';
        for($i=$indiceDepart; $i<= $indiceDeFin; $i++)
        {
                ?>
            <div class="bordQuestion" style="position: absolute;width: 469px;height: 113px;left: 300px;top: 0px;background: rgba(255, 252, 252, 0.93);border: 1px solid #515151;box-sizing: border-box;">
                <h1 style="font-family: Noto Sans HK;font-style: normal;font-weight: bold;font-size: 50px;line-height: 72px;color: #515151;margin-left: 100px;margin-top: 10px;">Question</h1>
                <div class="cerclePoint" style="position: absolute;width: 103px;height: 81px;left: 320px;top: 10px;background: rgba(255, 252, 252, 0.93);border: 9px solid #555454;border-radius: 50%;font-size: xxx-large;text-align: center;"><?=($i+1)."/".count($recup);?></div>
            </div>
            <?php


            echo "<div class='Qh3' style='text-align: center;font-size: xx-large;position: absolute;top: 160px;left: 250px;width:560px;height:100px;'>".$recup[$i]["question"]."</div>";
            if($recup[$i]['point']==1){
                echo "<div class='Points' style='position: absolute;width: 104px;height: 33px;left: 665px;top: 112px;background: rgba(255, 252, 252, 0.9);border: 1px solid #515151;box-sizing: border-box;font-size: x-large;text-align: center;'>".$recup[$i]['point']." pt"."</div>";
            }else{
                echo "<div class='Points' style='position: absolute;width: 104px;height: 33px;left: 665px;top: 112px;background: rgba(255, 252, 252, 0.9);border: 1px solid #515151;box-sizing: border-box;font-size: x-large;text-align: center;'>".$recup[$i]['point']." pts"."</div>";
            }
        
          ?>
          
          <form action="index.php?lien=jeux&page=score-joueur" method="post">
          <div id="afficheQuestion"style="position: absolute;width: 469px;height: 235px;left: 300px;top: 290px;background: #FFFCFC;border: 1px solid #555454;box-sizing: border-box;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
          <?php
            if ($recup[$i]["typequestion"] == "text") {
                echo "<tr><td>";?>
                <textarea name="textReponse" value="" style="padding-left: 10px;margin-left: 80px;color: #818181;font-size: large;" cols="40" rows="1"></textarea>
                <?php echo "</td></tr><br>";
            }
            if($recup[$i]["typequestion"] == "choix_simple"){
                foreach ($recup[$i]["reponse"] as $value) {
                    echo "<tr><td>";?>
                    <input type="radio" name="radioSelect[]" value="<?php echo $value['valeur'];?>" class="Q1" style="color:#51bfd0;margin-left: 20px;" id="">
                   <?php echo $value['valeur']."</td></tr><br>";
                }
            }
            if($recup[$i]["typequestion"] == "Choix_multiple"){
                foreach ($recup[$i]["reponse"] as $value) {
                    echo "<tr><td>";
                   ?><input type="checkbox"  name="checkboxSelect[]" value="<?php echo $value['valeur'];?>" style="color:#51bfd0;margin-left: 20px;" id="">
                   <?php echo $value['valeur']."</td></tr><br>";  
                }
            }
            ?></div><?php
            if ($pageActuelle>1 || $pageActuelle==$nbredepage ) 
            {
                $precedent = $pageActuelle-1;
                echo '<button class="precedent" type=submit name=precedent value=Précedent><a style="color:white; text-decoration: none;" href="index.php?lien=jeux&page=jeux-partie&liste='.$precedent.'">Précedent</a></button>';   
            }
            if ($pageActuelle<$nbredepage) 
            {
                $suivant = $pageActuelle+1;
               echo '<button class="suivant" type=submit name=suivant value="Suivant"><a style="color:white; text-decoration: none;" href="index.php?lien=jeux&page=jeux-partie&liste='.$suivant.'">Suivant</a></button>';
            } 
            if($pageActuelle==$nbredepage) 
            {   
                echo '<button class="suivant" type=submit name=submit value=fin><a style="color:white; text-decoration: none;" href="index.php?lien=jeux&page=score-joueur">Terminer</a></button>';
            } 
            ?>
            <input type="hidden" name="nbrchamp" id="nbrchamp">
            </form>
            
            <?php
        }

        echo "</table>";
    }?>
    </div> 
</div>

