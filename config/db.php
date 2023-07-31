<?php

class Database {
	public $db;
	private $host = "localhost";
	private $user = "root";
	private $database = "unknown";
	private $password = "";

	public function connect()
	{
		try {
			$db = new PDO("mysql:host=".$this->host.";dbname=".$this->database.";", $this->user, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (PDOException $e) {
			echo "Erro connecting to database: ".$e->getMessage();
		}

	}

}
?>