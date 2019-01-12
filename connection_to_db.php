
<?php

try {
  $dsn = "mysql:host=localhost:3306;dbname=dermodev";
  $login = "root";
  $password = "root";
  $db = new PDO($dsn,$login,$password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->query("SET nameS 'utf8'");
  $_POST['db'] = $db;
}
catch (PDOException $e) {
  die ('Echec0 connexion, erreur n°'. $e->getCode() . ':' . $e->getMessage());
}



?>
