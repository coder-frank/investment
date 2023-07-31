<?php

class User
{
	private $table = "users";
	private $conn;
	public $id;
	public $name;
	public $phone;
	public $email;
	public $password;

	public function __construct($db)
	{
		$conn = $db;
	}

	public function register()
	{
		$query = "INSERT INTO ".$this->table."() VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->name, $this->phone, $this->email, $this->password));
		if ($stmt)
		{
			return true;
		}
		return false;
	}

	public function login()
	{
		
	}
	
}