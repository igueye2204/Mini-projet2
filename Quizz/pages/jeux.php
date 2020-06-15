<?php


 ?>
<div class="admin1" style="left: 150px; top: 120px;">
    <div class="headerAdmin">
        <img src="<?= $_SESSION['user']['image']?>" alt="" srcset="" class="avatarAdmin">
        <?php
                    is_connect();

                    echo "<ul>";
                        echo "<ol class='nameAvatar'>";
                        echo "<ol>".ucwords($_SESSION['user']['firstname'])."<br>".ucwords($_SESSION['user']['name'])."</ol>";
                    echo "</ul>";
                ?> 
        <h1 class="msgHeader">#Testez votre niveau de connaissance en culture general</h1>
        <button class="deconnecter"><a href="index.php" style="text-decoration: none;color: white;" class="deconnexion">Deconnexion</a></button>
    </div>
    <link rel="stylesheet" href="Quizz/public/css/quizz.css">
    <div class="form-admin">
    <div class="score">
        <div class="liste-score" style="margin-top: 50px;margin-left: 0px;font-size: 5mm;box-shadow: 0 0 0 1px #03b7ec;text-align: center;color:#818181;width: 100px;position: absolute;width: 265px;height: 91px;left: 20px;top: 0px;background: #FFFCFC;box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.25);border-radius: 10px;" >
            <p style="width: 150px;margin-left: 0px;top: 0px;align-text:center color:#818181; position:absolute;width: 270px;font-family: Noto Sans HK;font-style: normal;font-weight: 900;font-size: 23px;line-height: 33px;color: #515151;">Mon Meilleur scores</p>
                <div>
                    <td>
                        <div style="margin-top: 40px;margin-top: 40px;font-family: Noto Sans SC;font-style: normal;font-weight: 300;font-size: 20px;line-height: 29px;color: #000000;">
                            <?php
                            is_connect();

                            echo $_SESSION['user']['firstname']."&emsp;";
                            echo $_SESSION['user']['name']."&emsp;";
                            echo $_SESSION['user']['score']." pts";
                            ?>
                        </div>
                    </td>
                </div>
        </div>
                <div style="position: absolute;width: 261px;height: 210px;left: 20px;top: 200px;background: #FFFCFC;box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                   <p style="width: 150px;margin-left: 0px;top: 0px;text-align:center; color:#818181;left: 50px; position:absolute;font-family: Noto Sans HK;font-style: normal;font-weight: 900;font-size: 25px;line-height: 36px;text-align: center;color: #515151;">Top scores</p>
                        <div id="top_score" style="margin-top: 50px;margin-left: 0px;font-size: 5mm;text-align: justify;margin-left: 15px;">
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
                            $statement = $connection->query('SELECT `firstname`, `name`, `score` FROM `users` ORDER BY `users`.`score` ASC');
                            while ($scoreJoueur = $statement->fetch()) {
                                $recup[] = $scoreJoueur;
                            }
                               
                            echo"<table>";
                       
                             foreach ($recup as $recuperer){
                            
                                echo "<tr style='height: 30px;'><td>".$recuperer['firstname']."</td><td>"."&emsp;".$recuperer['name']."</td><td style='color: #04B4FF;'>"."&emsp;".$recuperer['score']." pts"."</td></tr>";
                                
                                }
                            echo"</table>";

                            ?>
                        </div>
                </div>
        <div class="head-menu"></div>
        <div>
            <link rel="stylesheet" href="Quizz/public/css/quizz.css">
            <?php

                if (isset($_GET['page'])) 
                {
                    switch($_GET['page']) 
                    {
                        case "jeux-partie":
                            require("Quizz/pages/Jeux/jeuxPartie.php");
                            break;
                        case "score-joueur":
                            require("Quizz/pages/Jeux/scoreJoueur.php");
                            break;
                    }

                }else{
                    require("Quizz/pages/Jeux/jeuxPartie.php");
                }
            ?>
        </div>
       
    </div>
</div>
        
<!-- <script>
  let topscr1=document.getElementById("topscr1");
  let top_score=document.getElementById("top_score");
  let topscr= document.getElementById('topscr2');
  topscr1.addEventListener("click", function(){
    top_score.style.display="block";
    top_score.style.backgroundColor="darkturquoise";
    topscr1.style.backgroundColor="darkturquoise";
    if(meilleure.style.display=="block"){
      meilleure.style.display="none";
      topscr.style.backgroundColor="";
    }
    
  });

  let topscr2=document.getElementById("topscr2");
  let top_scor=document.getElementById("top_score");
  let topsc=document.getElementById('topscr1');
  topscr2.addEventListener("click", function(){
    meilleur.style.display="block";
    meilleur.style.backgroundColor="beige";
    topscr2.style.backgroundColor="beige";
    if(top_scor.style.display=="block"){
      top_scor.style.display="none";
      topsc.style.backgroundColor="";
    }
    
  });
 
  
</script> -->