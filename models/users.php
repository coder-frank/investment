<?php

class User
{
	//Error message
	public $error;

	// Table
	private $table = "users";

	// Conncection
	private $conn;

	// User Data
	public $id;
	public $fname;
	public $lname;
	public $phone;
	public $email;
	public $password;

	// Bank Data
	public $bankId;
	public $bUserId;
	public $bankName;
	public $bankAccNum;
	public $bankAccName;

	public function __construct($db)
	{
		$conn = $db;
	}

	public function sanitizeString($input) {
		// Remove HTML tags and entities
		$cleanedString = strip_tags($input);
	    
		// Remove potentially harmful characters using regular expression
		// Keep only alphanumeric characters, spaces, and some basic punctuation
		$cleanedString = preg_replace('/[^A-Za-z0-9\s\.\,\-\!\?]/', '', $cleanedString);
	    
		// Trim leading and trailing whitespaces
		$cleanedString = trim($cleanedString);
	    
		return $cleanedString;
	}
	    

	public function passHash()
	{
		return md5(md5(md5(md5($this->password))));
	}

	public function register()
	{
		$query = "INSERT INTO ".$this->table." (fname, lname, phone, email, password) VALUES(?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->fname, $this->lname, $this->phone, $this->email, $this->password));
		if ($stmt)
		{
			return true;
		}
		return false;
	}

	public function login()
	{
		$query = "SELECT * FROM ". $this->table ." WHERE email = ? AND password = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute($this->email, $this->password))
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function addBank()
	{
		$query = "INSERT INTO bank(userid, bankName, bankAccNum, bankAccName) VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute($this->bUserId, $this->bankName, $this->bankAccNum, $this->bankAccName))
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function getBank()
	{
		$query = "SELECT * FROM bank WHERE userid = ? LINIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute($this->bUserId))
		{
			while ($row = $stmt->PDO::FETCH_ASSOC)
			{
				$this->bankName = $row['bankName'];
				$this->bankAccName = $row['bankAccName'];
				$this->bankAccNum = $row['bankAccNum'];
			}
		} else
		{
			return false;
		}
	}
	
}