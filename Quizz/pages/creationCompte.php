<?php
require_once("Quizz/pages/sendForm/sendUser.php");

// $msg=$error1=$error2=$error3=$error4=$error5=$error6="";
// $issucces=false;
// if (isset($_POST['submit'])) 
// {
//         $firstname       = checkInput($_POST['prenom']);
//         $name            = checkInput($_POST['nom']);
//         $login           = checkInput($_POST['login']);
//         $password        = checkInput($_POST['password']);
//         $passwordconfirm = checkInput($_POST['passwordconfirm']);
        
//     //---------------------Upload avatar--------------------//
//     $destination= 'Quizz/public/Images/';
//     $avatarname = $_POST['prenom'].'.jpg';
//     $avatar     = $destination.$avatarname;
//     $extension  = strrchr($_FILES['avatar']['name'], '.');
//     $extensions = array('.png','.jpeg','.jpg');
//     //---------------------Condition--------------------//
//     $issucces=true;
//     if(empty($firstname) || empty($name) || empty($login) || empty($password) || empty($passwordconfirm))
//     {
//         $error1="Tous les champs sont obligatoire!";
//         $issucces=false;
//     }
//     if (is_login($login)) 
//     {
//         $issucces=false;
//         $error2 = "ce login existe déja essai un autre !";
//     }
//     if ($password!=$passwordconfirm) 
//     {
//         $error3 = "les mots de passe saisies sont différents!";
//         $issucces=false;
//     }
//     if (!in_array($extension, $extensions)) 
//     {
//         $error4 = "Vous devez uploader un fichier de type png,jpg  ou jpeg";
//         $issucces=false;
//     }
//     if (!(is_uploaded_file($_FILES['avatar']['tmp_name']))) 
//     {
//         $error5 = "le fichier n'est pas une image !";
//         $issucces=false;
//     }
//     if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $destination.$avatarname)) 
//     {
//         $error6 = "Echec de l'upload !";  
//         $issucces=false;
//     }

// }

?>
     
<div class="menu-inscrire1">
        <form action="" method="post" enctype="multipart/form-data" class="form-inscrire" id="formulaire">
            <div class="input">
                <label for="" class="label" >Prenom</label><br>
                    <input type="text" class="input1" name="prenom" id="prenom">
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"></div>
            </div>
            <div class="input">
                <label for="" class="label">Nom</label><br>
                <input type="text" class="input2" name="nom" id="nom">
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"></div>
            </div>
            <div class="input">
                <label for="" class="label">Login</label><br>
                <input type="text" name="login" class="input3" id="login" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error1?></div>
            </div>
            <div class="input">
                <label for="" class="label" >Mot de passe</label><br>
                <input type="password" name="password" class="input4" id="password" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error3?></div>
            </div>
            <div class="input">
                <label for="" class="label" >Confirmation Mot de passe</label><br>
                <input type="password" name="passwordconfirm" class="input5" id="passwordconfirm" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error3 ?></div><br><div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error2?></div>
            </div><br>
            <div>
                <input type="file" name="avatar" value="" class="upload-inscrire" id="avatar"><br>
                <br><div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error4?><br><?=$error5?><br><?=$error6?></div>
            </div> 
            <div>
                <input type="submit" class="input-submit" name="submit" id="input-submit" value="Crée Compte">
            </div>
            
        </form>
        <div class="afficher"></div>
</div>
            <div>
                <img src="<?=$avatar?>" alt="" sizes="10px" srcset="" class="img-avatar" id="img-avatar"><br>
            </div>
<!-- <p style="display:; color: blue; margin-right 50px;">Votre incription a correctement été enregistrée</p> -->

<script>

$(document).ready(function(){
    $('#formulaire').submit(function(){
        
        var avatar = $('#avatar').val();
        console.log($('form').serialize());
        // alert($('form').serialize() + avatar);
        $.post( "Quizz/sendForm/sendUser.php",{$('form').serialize(),avatar:avatar},function(donnees){
            $('.afficher').html(donnees);
        });
        return false;
    });
});
$('#avatar').on("click",function(){
        setInterval(() => {
            $('#img-avatar').load();
        }, 1000);
            
    })

</script>
