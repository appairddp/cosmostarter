<?php

require_once ('connection_to_db.php');

function test($mail,$mdp){
  // password_hash("azerty", PASSWORD_DEFAULT)
  // password_verify($_POST['pass']),$res['pass'])
  try{
    
    $db = $_POST['db'];

    $requete = $db->prepare('select * from Users where Email = :mail ');
    $requete->bindValue(':mail', $mail);
    $requete->execute();
    $res = $requete->fetch(PDO::FETCH_ASSOC);

    if($res==''){
      $res = 'mail non existant';
    }
    else if(isset($res['Mdp']) and password_verify($mdp,$res['Mdp'])){
        $res = $res['Id'];
    }
    else{
      $res = 'mdp incorrect';
    }

    return $res;
  }
  catch (PDOException $e) {
    die ('Echec test, erreur n°'. $e->getCode() .':'. $e->getMessage());
  }

}





$json = file_get_contents('php://input');

$obj = json_decode($json, true);



$res = test($obj['mail'],$obj['mdp']);

echo json_encode($res);



?>
