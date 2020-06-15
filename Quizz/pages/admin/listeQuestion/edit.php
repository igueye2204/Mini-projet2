<?php
class Database4
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
$connection = Database4::connect();
$id = $_GET['id'];
$sql = 'SELECT * FROM tabquestion WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['email']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = 'UPDATE people SET name=:name, email=:email WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':id' => $id])) {
    header("Location: /");
  }
}
 ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
        <?php if(!empty($message)): ?>
            <div class="alert alert-success">
              <?= $message; ?>
            </div>
        <?php endif; ?>
      <form method="post">
        <div class="form-group">
            <label for="" class="labelQuestion">Questions</label>
            <input value="<?= $person->name; ?>" type="text" name="typetext" size="30" class="champ">
        </div>
        <div class="form-group">
            <label for="" class="labelQuestion" >Nbre de Points</label>
            <input value="<?= $person->name; ?>" input type="number" name="nbrepoints" id="nbrpoints" min="1">
        </div>
        <div class="form-group">
            <label for="" class="labelQuestion" >reponse</label>
            <input value="<?= $person->name; ?>" input type="number" name="nbrepoints" id="nbrpoints" min="1">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info">Update person</button>
        </div>    
        </form>
    </div>
  </div>
</div>
        
      
