<?php
    include_once "Quizz/data/dbconfig.php";
    include_once "Quizz/data/databaseQuiz.php";
    include_once "Quizz/traitement/utiles.php";
    
    global $connection;
    $connection = Database::connect();

    $status = 1;
    $data=[];
    $fichier = $message ="";
   
    if(isset($_FILES['file'])){ 
        $info = getimagesize($_FILES['file']['tmp_name']);        
        if(($info['mime'] =='image/jpeg') || ($info['mime'] =='image/png') ||($info['mime'] =='image/jpg') ){
            
            $img_name= array("thumbnail"=>48,"medium"=>72,"large"=>128);
            
            $file = $_FILES['file'];  
            if($file['error']===0){
                $new="Quizz/public/Images/".$_POST['id']."/";       
                $path = getPath($new);
                if(!is_dir($path)){
                    mkdir($path,0700);
                }

                $rep =$_POST['id']."/";
                $status = uploadFile($file,$rep,$img_name);
                
                if($status != 0){
                    $r=[];
                    foreach ($img_name as $nom => $taille) {
                        $data['val'] =$new.$nom.".".$type[1];
                        if($nom == "thumbnail"){
                            $fichier=$data['val'];
                        }
                        $prepUser=getPrepUp($data,"user",array("type"));
                        $r['id'] =$_POST['id'];
                        $id_user=setReq($connection,$prepUser,$r);
                    }  
                }
            }        
        }else{
            $status = 0;
            $message = "Erreur de fichier";
        }   
    }else{
        $prepUser=getPrepUp($_POST);
        $d['id']=$_POST['id'];
        $id_user=setReq($connection,$prepUser,$d);
    }
   
    $tab['status']= $status;
    $tab['message']= $message;
    $tab['image']= $fichier;
    echo json_encode($tab);
   
 ?>