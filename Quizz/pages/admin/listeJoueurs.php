<div class="listej3">
            <div><h3 class="entete">LISTE DES JOUEURS PAR SCORE</h3></div>
                 <p style="color: #818181; margin-left: 70px;padding-top: 10px;">
                 <?php 
        
                    $data = getData();
                    $column = array_column($data, 'score');
                    array_multisort($column, SORT_DESC, $data);
                    $nbrdevaleurparpage = 15;
                    $totaValeur = count($data);
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
                    foreach($data as $user)
                    {

                            $tab[]= array(
                              "prenom"=> $user["prenom"],
                              "nom"=> $user["nom"],
                              "score"=> $user["score"]
                              );
                    }
                    
                echo '<table style="width: 400px; height: 40;position: absolute;top: 60px; font-size: 5mm;box-shadow: 0 0 0 1px #03b7ec;border-radius: 5px;text-align: justify;margin-left: 50px; border: 1px black; font-size: ;color:#818181;">';
                echo "<tr> <th>Nom</th> <th>Prenom</th> <th>Score</th> </tr>";  
                for($i=$indiceDepart; $i<= $indiceDeFin; $i++)
                {
                    echo "<tr><td>".$tab[$i]['prenom']."</td><td>".$tab[$i]['nom']."</td><td>".$tab[$i]['score']." pts"."</td></tr>";
                }
                echo "</table>";

                if ($pageActuelle>1) 
                {
                    $precedent = $pageActuelle-1;
                    echo  '<a class="precedent" href="index.php?lien=accueil&page=liste-joueurs&liste='.$precedent.'" style="top: 490px;left: 50px;">Precedent</a>';
                }
                if ($pageActuelle<$nbredepage) 
                {
                    $Suivant = $pageActuelle+1;
                    echo  '<a class="suivant" href="index.php?lien=accueil&page=liste-joueurs&liste='.$Suivant.'" style="top: 490px;left: 330px;">Suivant</a>';
                }
                if($pageActuelle==$nbredepage) 
                {
                    $precedent = $pageActuelle-1;
                    echo  '<a class="precedent" href="index.php?lien=accueil&page=liste-joueurs&liste='.$precedent.'" style="top: 490px;left: 50px;">Precedent</a>';
                }
               
                 ?>
        </div>
</div>
