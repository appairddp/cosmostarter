<?php

class Model {


	/**
	 * Attribut contenant l'instance PDO
	 */
	private $bd;


	/**
	 * Attribut statique qui contiendra l'unique instance de Model
	 */
	private static $instance = null;


	/**
	 * Constructeur : effectue la connexion à la base de données.
	 */
	private function __construct() {

		try {
			$dsn = "mysql:host=mysql6001.site4now.net;dbname=db_a43d05_dermo";
			$login = "a43d05_dermo";
			$password = "dermodev123";
			$this->bd = new PDO($dsn,$login,$password);
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->bd->query("SET nameS 'utf8'");
		}
		catch (PDOException $e) {
			die ('Echec0 connexion, erreur n°'. $e->getCode() . ':' . $e->getMessage());
		}
	}


	/**
	 * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
	 */
	public static function get_model() {

        if (is_null(self::$instance))
            self::$instance = new Model();
        return self::$instance;
    }


	public function test(){

		try{

			$requete = $this->bd->prepare('select * from project');
			$requete->execute();
			return $requete->fetchall();
		}
		catch (PDOException $e) {
			die ('Echec test, erreur n°'. $e->getCode() .':'. $e->getMessage());
		}

	}



}
echo json_encode('1');
