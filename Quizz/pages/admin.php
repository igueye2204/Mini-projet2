
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
        <h1 class="msgHeader">CRÉER ET PARAMÉRTER VOS QUIZZ</h1>
        <button class="deconnecter"><a href="index.php" style="text-decoration: none;color: white;" class="deconnexion">Deconnexion</a></button>
    </div>
    <div class="form-admin">
        <div class="form-menu">
            <nav>
                    <ul role="presentation" ><button id="btn-liste-question" class="liste-question" onclick="doOnClick1()"><a href="index.php?lien=accueil&page=liste-question" style="text-decoration: none;color: white;">Liste Questions</a></button></ul>
                    <ul role="presentation" ><button id="btn-creer-admin" class="creer-admin" onclick="doOnClick2()"><a href="index.php?lien=accueil&page=creer-admin" style="text-decoration: none;color: white;">Créer Admin</a></button></ul>
                    <ul role="presentation" ><button id="btn-liste-joueurs" class="liste-joueurs" onclick="doOnClick3()"><a href="index.php?lien=accueil&page=liste-joueurs"style="text-decoration: none;color: white;">Liste Joueurs</a></button></ul>
                    <ul role="presentation" ><button id="btn-creer-question" class="creer-question"onclick="doOnClick4()"><a href="index.php?lien=accueil&page=creer-question"  style="text-decoration: none;color: white;">Créer Questions</a></button></ul>
            </nav>
        </div>
        <div class="head-menu"></div>
        <div>
            <link rel="stylesheet" href="Quizz/public/css/quizz.css">
            <?php

                if (isset($_GET['page'])){
                    switch($_GET['page']){
                        case "liste-question":
                            require("Quizz/pages/admin/listeQuestion/Questions.php");
                            break;
                        case "creer-admin":
                            require("Quizz/pages/admin/creationAdmin.php");
                            break;
                        case "liste-joueurs";
                            require("Quizz/pages/admin/listeUsers/index.php");
                            break;
                        case "creer-question";
                            require("Quizz/pages/admin/creationQuestion/create.php");
                            break;   
                    }
                }else{
                    
                    require("Quizz/pages/admin/listeQuestion.php");
                }

            ?>
        </div>
    </div>
</div>
<script>

    function doOnClick1() {

        document.getElementById('btn-liste-question').style.backgroundColor='#04B4FF';
        document.getElementById('btn-liste-question').style.backgroundImage='url(Quizz/public/Images/Icônes/ic-liste-active.png)';
        document.getElementById('btn-liste-question').style.backgroundRepeat='no-repeat';
        document.getElementById('btn-liste-question').style.border='1px solid #555454';
        document.getElementById('btn-liste-question').style.borderLeftStyle='solid';

    return false;
    }

    function doOnClick2() {

        document.getElementById('btn-creer-admin').style.backgroundColor='#04B4FF';
        document.getElementById('btn-creer-admin').style.backgroundImage='url(Quizz/public/Images/Icônes/ic-ajout-active.png)';
        document.getElementById('btn-creer-admin').style.backgroundRepeat='no-repeat';
        document.getElementById('btn-creer-admin').style.border='1px solid #555454';
        document.getElementById('btn-creer-admin').style.borderLeftStyle='solid';

    return false;
    }

    function doOnClick3() {

        document.getElementById('btn-liste-joueurs').style.backgroundColor='#04B4FF';
        document.getElementById('btn-liste-joueurs').style.backgroundImage='url(../Images/Icônes/ic-ajout-active.png)';
        document.getElementById('btn-liste-joueurs').style.backgroundRepeat='no-repeat';
        document.getElementById('btn-liste-joueurs').style.border='1px solid #555454';
        document.getElementById('btn-liste-joueurs').style.borderLeftStyle='solid';

    return false;
    }
    
    function doOnClick4() {

        document.getElementById('btn-creer-question').style.backgroundColor='#04B4FF';
        document.getElementById('btn-creer-question').style.backgroundImage='url(../Images/Icônes/ic-ajout-active.png)';
        document.getElementById('btn-creer-question').style.backgroundRepeat='no-repeat';
        document.getElementById('btn-creer-question').style.border='1px solid #555454';
        document.getElementById('btn-creer-question').style.borderLeftStyle='solid';

        return false;
    }
</script>       