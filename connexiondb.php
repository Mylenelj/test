<?php

// Déclaration d'une nouvelle classe

class connexiondb {
public $host = 'localhost'; // nom de l'host
public $name = ''; // nom de la base de donnée
public $user = ''; // utilisateur
public $pass = ''; // mot de passe (il faudra peut-être mettre '' sous Windows)
public $connexion;

function __construct($host = null, $name = null, $user = null, $pass = null){
if($host != null){
$this->host = $host;
$this->name = $name;
$this->user = $user;
$this->pass = $pass;
}
try{
$this->connexion = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->name,
$this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8',
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
}catch (PDOException $e){
echo 'Erreur : Impossible de se connecter à la BDD !';
die();
}
}
}

//Le code ci-dessous vous permettra d'utiliser cette classe afin de créer une connexion pour y réaliser des requêtes SQL.
// Faire une connexion à la fonction
$DB = new connexiondb();


//Fonction query
//L'utilité de la fonction query va vous permettre de gagner un gain de vitesse lorsque vous allez écrire une requête SQLafin d'interroger votre serveur.
//La fonction query est à utiliser de préférence avec la requête SELECT.
public function query($sql, $data = array()){
$req = $this->connexion->prepare($sql);
$req->execute($data);

return $req;
}


//Rajouter cette fonction dans la classe connexionDB.
$req = $DB->query("SELECT * FROM nom_table WHERE id = :id",
array('id' => 1));
$req = $req->fetch();


//Fonction Insert
//Je vous propose une fonction que j'ai nommé insert afin d'insérer, de modifier ou de supprimer des données sur votre serveur.
//La fonction insert est à utiliser de préférence avec les requêtes INSERT, UPDATE et DELETE.
public function insert($sql, $data = array()){
$req = $this->connexion->prepare($sql);
$req->execute($data);
}


//Rajouter cette fonction dans la classe connexionDB
//Ci-dessous je vous montre comment utiliser cette fonction de plusieurs façon.



// Première méthode avec INSERT
   $DB->insert("UPDATE nom_talbe SET prenom = ?, nom = ?, age = ? WHERE id = ?",
    array("michel", "durant", 22, 1));
  

//Rendu final
//Voici ce que devra contenir votre fichier connexionDB.php pour poursuivre les différents articles. (Vous pouvez également le faire avec votre propre méthode pour les articles d'après).
// Déclaration d'une nouvelle classe
  class connexiondb {
    private $host    = 'localhost';   // nom de l'host
    private $name    = '';     // nom de la base de donnée
    private $user    = '';        // utilisateur
    private $pass    = '';        // mot de passe
    //private $pass    = '';          // Ne rien mettre si on est sous windows, sinon : 'root'
    private $connexion;

    
                    
    function __construct($host = null, $name = null, $user = null, $pass = null){
      if($host != null){
        $this->host = $host;           
        $this->name = $name;           
        $this->user = $user;          
        $this->pass = $pass;
      }
      try{
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
          $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', 
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      }catch (PDOException $e){
        echo 'Erreur : Impossible de se connecter  à la BDD !';
        die();
      }
    }
    
    public function query($sql, $data = array()){
      $req = $this->connexion->prepare($sql);
      $req->execute($data);
      return $req;
    }
    
    public function insert($sql, $data = array()){
      $req = $this->connexion->prepare($sql);
      $req->execute($data);
    }
  }
  
  // Faire une connexion à la fonction
  $DB = new connexionDB();
?>
