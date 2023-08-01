<?php

class User
{
	//Error message
	public $error;

	// Table
	private $table = "users";

	// Conncection
	private $conn;

	//REF
	public $code;

	// User Data
	public $id;
	public $fname;
	public $lname;
	public $phone;
	public $email;
	public $myCode;
	public $status;
	public $password;

	// Bank Data
	public $bankId;
	public $bUserId;
	public $bankName;
	public $bankAccNum;
	public $bankAccName;


	// Earning Data
	public $earning;
	public $refEarning;
	public $wallet;
	public $refCount;

	public function __construct($db)
	{
		$this->conn = $db;
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
	    

	public function passHash($epass)
	{
		return password_hash($epass, PASSWORD_BCRYPT);
	}

	public function generateCode()
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$code = '';
		$length = 8;

		for ($i = 0; $i < $length; $i++) {
			$randomIndex = rand(0, strlen($characters) - 1);
			$code .= $characters[$randomIndex];
		}

    		return $code;
	}

	public function emailExits()
	{
		$query = "SELECT email FROM ". $this->table ." WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->email));
		if ($stmt->rowCount() == 0)
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function codeExits()
	{
		$query = "SELECT refCode FROM ". $this->table ." WHERE refCode = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->code));
		if ($stmt->rowCount() == 0)
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function register()
	{
		$query = "INSERT INTO ".$this->table." (fname, lname, phone, email, password, refCode, status) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->fname, $this->lname, $this->phone, $this->email, $this->password, $this->myCode, $this->status));
		if ($stmt)
		{
			return true;
		}
		return false;
	}

	public function login($enteedPassword)
	{
		$query = "SELECT * FROM ". $this->table ." WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->email));
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$hashedPasswordFromDB = $row['password'];
		
			// Verify the entered password against the hashed password from the database
			if (password_verify($enteedPassword, $hashedPasswordFromDB)) {
			    return $row;
			} else{
				return false;
			}
		}
		return false;
	}

	public function addBank()
	{
		$query = "INSERT INTO bank(userid, bankName, bankAccNum, bankAccName) VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->bUserId, $this->bankName, $this->bankAccNum, $this->bankAccName)))
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
		if ($stmt->execute(array($this->bUserId)))
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
	

	public function getEarnings()
	{
		$query = "SELECT * FROM earnings WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1)
		{
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				return number_format($row['balance']);
			}
		} else
		{
			return 0;
		}
	}

	public function getrefEarning()
	{
		$query = "SELECT * FROM ref_earnings WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1)
		{
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				return number_format($row['balance']);
			}
		} else
		{
			return 0;
		}
	}

	public function getWallet()
	{
		$query = "SELECT * FROM wallet WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1)
		{
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				return number_format($row['balance']);
			}
		} else
		{
			return 0;
		}
	}


	public function getrefCount()
	{
		$query = "SELECT * FROM referral WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		return $stmt->rowCount();
	}
}