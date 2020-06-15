<?php
require_once('Quizz/pages/admin/adminForm/sendAdmin.php');

// $msg=$error1=$error2=$error3=$error4=$error5=$error6="";
// $issucces=false;
// if (isset($_POST['submit'])) 
// {
//         $firstname       = checkInput($_POST['prenom']);
//         $name            = checkInput($_POST['nom']);
//         $login           = checkInput($_POST['login']);
//         $password        = checkInput($_POST['password']);
//         $passwordconfirm = checkInput($_POST['passwordconfirm']);
//         $profil          = 'admin';
        
//     //--------------------------Upload avatar-----------------------------//
        
//         $destination    = 'Quizz/public/Images/';
//         $avatarname     = $_POST['prenom'].'.jpg';
//         $avatar         = $destination.$avatarname;
//         $extension      = strrchr($_FILES['avatar']['name'], '.');
//         $extensions     = array('.png','.jpeg','.jpg');
        
//     //----------------------------Condition--------------------------//
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
//     if($issucces)
//     {
//         //---------------------Récuperation sur la Base de donnée--------------------//
//         $db = Database::connect();
//         $statement = $db->prepare("INSERT INTO users (firstname,name,login,password,image,profil) VALUES (?,?,?,?,?,?)");
//         $statement->execute(array($firstname,$name,$login,$password,$avatar,$profil));
//         Database::disconnect();
//         $results = inscription($login);
//         if ($results)
//         {
//             header("location:index.php?lien=".$results);
//         }
//         else
//         {
//             $result0= "il y a une erreur dans les données saisies ! ";
//         }
//     }
// }


?>
            <div class="imgAvatarAdmin">
                <img src="<?=$avatar?>" alt="" sizes="10px" srcset="" class="AvatarAdmin" >
            </div>         
    <div class="menu-inscrireAdmin">
        <form action="" method="post" enctype="multipart/form-data" class="form-inscrire" id="form-inscrire">
            <div class="input">
                <label for="" class="label" >Prenom</label><br>
                    <input type="text" class="input1" name="prenom" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"></div>
            </div>
            <div class="input">
                <label for="" class="label">Nom</label><br>
                <input type="text" class="input2" name="nom">
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"></div>
            </div>
            <div class="input">
                <label for="" class="label">Login</label><br>
                <input type="text" name="login" class="input3" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error1?></div>
            </div>
            <div class="input">
                <label for="" class="label" >Mot de passe</label><br>
                <input type="password" name="password" class="input4" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error3?></div>
            </div>
            <div class="input">
                <label for="" class="label" >Confirmation Mot de passe</label><br>
                <input type="password" name="passwordconfirm" class="input5" >
                <div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error3 ?></div><br><div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error2?></div>
            </div><br>
            <div>
                <input type="file" name="avatar" value="" placeholde="Upload" class="upload-inscrire" id="upload-inscrire"><br>
                <br><div style="color: red;text-shadow: 0 0 3px #c7c7c7;"><?=$error4?><br><?=$error5?><br><?=$error6?></div>
            </div> 
            <div>
                <input type="submit" class="input-submitAdmin" name="submit" value="Enregistrer" id="input-submitAdmin" >
            </div>
        </form>
</div>
<p style="display:<?php if($issucces){echo 'block';}else{echo 'none';}?>; color: blue; margin-right 50px;">Votre incription a correctement été enregistrée</p>

<script>
    $(document).ready(function(){
    $('#form-inscrire').submit(function(){
        
        var avatar = $('#upload-inscrire').val();
        console.log($('form').serialize());
        // alert($('form').serialize() + avatar);
        $.post( "Quizz/pages/admin/adminForm/sendAdmin.php",{$('form').serialize(),avatar:avatar},function(donnees){
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