<?php
class Database3
{
    private static $dbHost = "localhost"; 
    private static $dbName = "quizdb"; 
    private static $dbUser = "root"; 
    private static $dbUserPassword = ""; 
 
    private static $connection = null;
 
    public static function connect()
    {
         try 
         {
             self::$connection = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName,self::$dbUser,self::$dbUserPassword);
         } 
         catch (PDOException $e) 
         {
            die($e->getMessage());
         }
         return self::$connection;
    }
 
    public static function disconnect()
    {
     self::$connection = null;
    }


    
}

if (isset($_GET['mode'])){
    switch($_GET['mode']){
        case "Create":
            require("Quizz/pages/admin/CreationQuestion/create.php");
            break;
        case "Edit":
            require("Quizz/pages/admin/listeQuestion/edit.php?id=<?= $dataTab->id ?>");
            break;
        case "Delete";
            require("Quizz/pages/admin/listeQuestion/delete.php?id=<?= $dataTab->id ?>");
            break;   
    }
}

$connection = Database3::connect();
$sql = 'SELECT * FROM tabquestion';
$statement = $connection->prepare($sql);
$statement->execute();
$allQuestion = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="margin-left:20px;">Lister, Ajouter et  Question</h2>
    </div>
    <div class="card-body" style="max-height: 75vh;overflow: scroll;width: 900px;height: 400px;position: absolute;left: 50px;top: 150px;">
      <table class="table table-inverse table-responsive">
        <tr>
          <th>ID</th>
          <th>Question</th>
          <th>point</th>
          <th>typeReponse</th>
          <th>Reponse</th>
          <th colspan="2" class="text-center">Action</th>
        </tr>
        <?php foreach($allQuestion as $dataTab): ?>
          <tr>
            <td><?= $dataTab->id; ?></td>
            <td><?= $dataTab->question; ?></td>
            <td><?= $dataTab->point; ?></td>
            <td><?= $dataTab->typequestion; ?></td>
            <td><?= $dataTab->reponse; ?></td>
            <td>
              <a href="index.php?lien=accueil&page=creer-question&mode=Create" class="btn btn-info">Create</a>
              <a href="index.php?lien=accueil&page=liste-question&mode=Edit&id=<?= $dataTab->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="index.php?lien=accueil&page=liste-question&mode=delete&id=<?= $dataTab->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>