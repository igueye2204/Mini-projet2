<link rel="stylesheet" href="Quizz/public/css/quizz.css">
<?php 
  unset( $_SESSION['page']);
  require_once "Quizz/traitement/utiles.php";
  $_SESSION['url']= getUrl();
  
  $chemin=$_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];
  $_SESSION['chemin']=$chemin; 

  //affiche_tab($_SERVER);
 
?>
<div class="listeJoueur">
            <div><h3 class="enteteJoueur">LISTE DES ADMINS PAR SCORE</h3></div>
            <div class="row" >
      <div class="col-md-6" > 
        <div class="row" id="tableau" style="max-height: 75vh;overflow: scroll;margin-left: 50px;width: 400px;height:400px" > 
          <table class="table  table-inverse table-responsive" id="users">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>profil</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>score>
                <th colspan="2" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="bd_users"> 
            

            </tbody>
          </table>
        </div>

        <div class="row" >
          <div class="col-md-8" style="left: 50px;">
            <div class="form-inline my-4"> 
              <label for="nb_elt" class="mr-2">Afficher par</label>
              <input class="form-control col-sm-6" type="number" name="nb_elt" id="nb_elt" min="1" max="10">
            </div> 
          </div>
          <div class="col-md-4 mt-4" id="suiv" style="margin-top: 15px;"><button>Suivant >></button></div>
      </div>
      </div>
      <div id="info" class="col-md-6"></div>
    </div>
                
        </div>
</div>

