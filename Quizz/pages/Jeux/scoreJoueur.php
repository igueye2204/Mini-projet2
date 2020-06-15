<div class="form-question">
<?php  
        
   if(!isset($_SESSION['in_json']) && !isset($q_exect)){
    $data = file_get_contents('Quizz/data/liste_jscore.json');
      if(!$data or empty($data)){ $new_users =[];
      }else $new_users= json_decode($data); 
       array_push($new_users,[
           'prenom'    =>$_SESSION['user']['prenom'],
            'nom'      =>$_SESSION['user']['nom'],
            'score'    => $score,
            'login'    => $_SESSION['user']['login'],
            'question' => $_SESSION['exect'],
       ]);
          $new_users =nl2br( json_encode($new_users));   
          file_put_contents('Quizz/data/liste_jscore.json', $new_users);
   }
    elseif(!isset($_SESSION['exect'])){
      $data = file_get_contents('Quizz/data/liste_jscore.json');
      $newdata= json_decode($data,true);  
         $newdata['score']+= $score;
         foreach($_SESSION['exect'] as $q);
            array_push($newdata[0]['question'],$q);
         // On réencode en JSON
         $newdata = json_encode($newdata); 
         // // On stocke tout le JSON
         file_put_contents('Quizz/data/liste_jscore.json', $newdata);
    }
    echo "<p class >"."Votre score est de ".$score."</p>";

  ?>
    <div class="message">
        <h2 style="Position: absolute;left: 50px;top: 10px;font-size: xx-large;color: mediumblue;font-family: cambria;">Votre score est de : </h2> 
    </div>
</div>
<a class="suivant" style="top:570px;left: 445px;width: 200px;height: 50px;padding-top: 15px;font-size: xx-large"href="index.php?lien=jeux">Rejouer</a>

