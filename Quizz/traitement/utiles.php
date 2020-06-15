<?php
/* -------------------------------------------------------
-------------- récupérer le chemin des image -----------
-------------------------------------------------------*/
function getPath($new){
	$rep = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME']);
	$old = "Quizz/pages/admin/listeUsers";	
  $p= str_replace( $old, $new, $rep);
  return $p;
}

function getUrl(){
  $url = "http://".$_SERVER['HTTP_HOST'];
  $url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	return $url;
}

/* -------------------------------------------------------
-------------- Sauvegarder une image-----------
-------------------------------------------------------*/

//   function uploadFile($file,$rep, $img_name){
//     $new="Quizz/public/Images/";       
//     $path = getPath($new);
//     $path .=$rep;
//     $status = 1;
//     $type=explode("/", $file['type']);        
//     $image = $path.$file['name'];
//     if(move_uploaded_file($file['tmp_name'], $image)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
//     $info = getimagesize($image);
//     $mime = $info['mime'];
//       foreach ($img_name as $nom => $taille){
//         $new_image = $path.$nom.".".$type[1];
//         rasizeImg($new_image,$image,$mime,$taille);
//       }  
//     }
//     else{ //Sinon (la fonction renvoie FALSE).
//       $status = 0;
//     }
//    return $status;    
//   }
// /* -------------------------------------------------------
// -------------- Redimensionner une image-----------
// -------------------------------------------------------*/
// function rasizeImg($new_image,$imagepath,$mime,$taille){   
//     switch ($mime) {
//         case 'image/jpeg':
//             $image_create_func = 'imagecreatefromjpeg';
//             $image_save_func = 'imagejpeg';
//             break;
//         case 'image/png':
//             $image_create_func = 'imagecreatefrompng';
//             $image_save_func = 'imagepng';
//             break;
//         case 'image/gif':
//             $image_create_func = 'imagecreatefromgif';
//             $image_save_func = 'imagegif';
//             break;
//         default: 
//             throw new Exception('Type de fichier inconnu !!!.');
//     }
        
//     list($width, $height) = getimagesize($imagepath);
//     $modwidth = $modheight = $taille;
    
//     $tn = imagecreatetruecolor($modwidth, $modheight) ;
//     $image = $image_create_func($imagepath) ;
//     imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
//     $image_save_func($tn, $new_image) ;
// }
        

/* -------------------------------------------------------
-------------- Affichage d'un tableau formaté -----------
-------------------------------------------------------*/
function affiche_tab($tab){
	echo "<pre>";
	print_r($tab);
	echo "</pre>";
}	

?>