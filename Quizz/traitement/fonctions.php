<?php
       
       require_once("Quizz/data/databaseQuiz.php");

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function connexion($login, $pwd)
    {
        $db = Database::connect();
        $statement = $db->query("SELECT * FROM users");
        while($user= $statement->fetch())
        {
            if ($user["login"]===$login && $user["password"]===$pwd) 
            {   
                $_SESSION['user']=$user;
                $_SESSION['statut']="login";
                if($user["profil"] === "admin")
                {
                    return "accueil";
                }
                else
                {
                    return "jeux";
                }
            }
        }
        return "error";
    }

    
    function is_login($log)
    {
        $db = Database::connect();
        $statement = $db->query("SELECT login FROM users");
        while($user= $statement->fetch())
        {
            if ($user["login"] === $log)
            {
                return true;
                
            }  
        }
        return false;  
    }

    function is_connect()
    {
        if (!isset($_SESSION['statut'])) 
        {
            header("location:index.php");
        }
    }

    function deconnexion()
    {
        unset($_SESSION['user']);
        unset($_SESSION['statut']);
        session_destroy();
    }
    
    function inscription($login)
    {
        $db = Database::connect();
        $statement = $db->query("SELECT profil FROM users");
        while($user= $statement->fetch())
        {  
            if($user['profil'] === "admin")
            {
                return "accueil";
            }
            else
            {
                return "connexion";
            }

        }
    }

    




?>