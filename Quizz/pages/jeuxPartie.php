<?php
    $jsonRep=[];
    $json=getData('Questions');
    $datasetting=getData('parametre');
    $exist = getData('listeJscore');


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
            $total_page=$datasetting['NbrQuestion'];
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
            while (!empty($json[$i]) || $sorti ==0 ){
                if($_SESSION['in_json'] ==0){
                    $question[$i]= $json[$i];
                }else{
                    if(isset($exist)){
                        if(!in_array($json[$i]['question'],$exist[$i]['question']))
                          $question[$i]= $json[$i];
                      }
                }
                if(count($question)==$total_page) $sorti =1;
                $i++;
            }
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
        foreach($datasetting as $value);
        for ($j=0; $j < $value; $j++){

            $tab0[] = $json[$j];
        }
    
        $nbrdevaleurparpage = 1;
        $totaValeur = count($tab0);
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
                ?><h2 class="Qh2" style="position: absolute;top: 20px;left: 220px;font-style: italic;">QUESTION <?=($i+1)."/".$value.":";?></h2><?php


            echo "<div class='Qh3' style='text-align: center;font-size: xx-large;position: absolute;top: 60px;left: 20px; width:560px; height:100px;'>".$tab0[$i]["question"]."</div>";
            if($tab0[$i]['nbrepoints']==1){
                echo "<div style='position: absolute;top: 160px;left: 530px;font-size: x-large;background-color: rgba(238, 238, 238, 0.979);box-shadow: 0 1px #0348c5;'>".$tab0[$i]['nbrepoints']." pt"."</div>";
            }else{
                echo "<div style='position: absolute;top: 160px;left: 530px;font-size: x-large;background-color: rgba(238, 238, 238, 0.979);box-shadow: 0 1px #0348c5;'>".$tab0[$i]['nbrepoints']."  pts"."</div>";
            }
        
          ?>
          <form action="index.php?lien=jeux&page=score-joueur" method="post">
          <?php
            if ($tab0[$i]["typequestion"] == "text") {
                echo "<tr><td>";?>
                <textarea name="textReponse" value="" style="padding-left: 10px;margin-left: 80px;color: #818181;font-size: large;" cols="40" rows="1"></textarea>
                <?php echo "</td></tr><br>";
            }
            if($tab0[$i]["typequestion"] == "choix_simple"){
                foreach ($tab0[$i]["reponses"] as $value) {
                    echo "<tr><td>";?>
                    <input type="radio" name="radioSelect[]" value="<?php echo $value['valeur'];?>" class="Q1" style="color:#51bfd0;margin-left: 20px;" id="">
                   <?php echo $value['valeur']."</td></tr><br>";
                }
            }
            if($tab0[$i]["typequestion"] == "Choix_multiple"){
                foreach ($tab0[$i]["reponses"] as $value) {
                    echo "<tr><td>";
                   ?><input type="checkbox"  name="checkboxSelect[]" value="<?php echo $value['valeur'];?>" style="color:#51bfd0;margin-left: 20px;" id="">
                   <?php echo $value['valeur']."</td></tr><br>";  
                }
            }
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

