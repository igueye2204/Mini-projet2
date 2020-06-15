<?php      
require_once "Quizz/data/databaseQuiz.php";
global $connection;
$issucces=false;
$msg=$error1=$error2=$error3=$error4=$error5=$error6="";
$issucces=false;
if(isset($_POST['prenom'], $_POST['nom'], $_POST['login'], $_POST['password'], $_FILES['avatar']) && !empty($_POST['prenom']) && !empty($_POST['nom']))
{

        $firstname       = htmlspecialchars(stripslashes(trim($_POST['prenom'])));
        $name            = htmlspecialchars(stripslashes(trim($_POST['nom'])));
        $login           = htmlspecialchars(stripslashes(trim($_POST['login'])));
        $password        = htmlspecialchars(stripslashes(trim($_POST['password'])));
        $passwordconfirm = htmlspecialchars(stripslashes(trim($_POST['passwordconfirm'])));
        $profil          = 'admin';
            //---------------------Upload avatar--------------------//
            $destination= 'Quizz/public/Images/';
            $avatarname = $_POST['prenom'].'.jpg';
            $avatar     = $destination.$avatarname;
            $extension  = strrchr($_FILES['avatar']['name'], '.');
            $extensions = array('.png','.jpeg','.jpg');
            //---------------------Condition--------------------//
            $issucces=true;
            $error1="Tous les champs sont obligatoire!";
            
        if (is_login($login)) 
        {
            $issucces=false;
            $error2 = "ce login existe déja essai un autre !";
        }
        if ($password!=$passwordconfirm) 
        {
            $error3 = "les mots de passe saisies sont différents!";
            $issucces=false;
        }
        if (!in_array($extension, $extensions)) 
        {
            $error4 = "Vous devez uploader un fichier de type png,jpg  ou jpeg";
            $issucces=false;
        }
        if (!(is_uploaded_file($_FILES['avatar']['tmp_name']))) 
        {
            $error5 = "le fichier n'est pas une image !";
            $issucces=false;
        }
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $destination.$avatarname)) 
        {
            $error6 = "Echec de l'upload !";  
            $issucces=false;
        }
    
    if ($issucces){

        $connection = Database::connect();
        $statement = $connection->prepare("INSERT INTO users (firstname,name,login,password,image,profil) VALUES (?,?,?,?,?,?)");
        $statement->execute(array($firstname,$name,$login,$password,$avatar,$profil));
    }
    
}
?>

   
