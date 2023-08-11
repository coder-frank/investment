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
	public $type;
	public $fname;
	public $lname;
	public $phone;
	public $email;
	public $myCode;
	public $status;
	public $refId;
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

	public function sanitizeString($input)
	{
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

	public function generateUniqueCode()
	{
		$code = $this->generateCode();
        
		while ($this->codeExits($code)) {
		$code = $this->generateCode();
		}
		
		return $code;
	}

	public function emailExits()
	{
		$query = "SELECT email FROM " . $this->table . " WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->email));
		if ($stmt->rowCount() == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function codeExits($code)
	{
		$query = "SELECT refCode FROM " . $this->table . " WHERE refCode = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($code));
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getRefId()
	{
		$query = "SELECT id FROM " . $this->table . " WHERE refCode = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->code));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['id'];
			}
		} else {
			return false;
		}
	}

	public function addRefId($rid)
	{
		$query = "UPDATE users SET refBy = ? WHERE refCode = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($rid, $this->myCode));
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getRefBy()
	{
		$query = "SELECT refBy FROM " . $this->table . " WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['refBy'];
			}
		} else {
			return false;
		}
	}

	public function getrefCode()
	{
		$query = "SELECT refCode FROM " . $this->table . " WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['refCode'];
			}
		} else {
			return false;
		}
	}

	public function register()
	{
		$query = "INSERT INTO " . $this->table . " (type, fname, lname, phone, email, password, refCode, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->type, $this->fname, $this->lname, $this->phone, $this->email, $this->password, $this->myCode, $this->status));
		if ($stmt) {
			return true;
		}
		return false;
	}

	public function login($enteedPassword)
	{
		$query = "SELECT * FROM " . $this->table . " WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->email));
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$hashedPasswordFromDB = $row['password'];

			// Verify the entered password against the hashed password from the database
			if (password_verify($enteedPassword, $hashedPasswordFromDB)) {
				return $row;
			} else {
				return false;
			}
		}
		return false;
	}

	public function addBank()
	{
		$query = "INSERT INTO bank(uid, bankName, accName, accNumber) VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id, $this->bankName, $this->bankAccName, $this->bankAccNum))) {
			return true;
		} else {
			return false;
		}
	}


	public function addWithdraw($amount, $type)
	{
		$query = "INSERT INTO withdrawal(uid, amount, type, status) VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id, $amount, $type, "Pending"))) {
			return true;
		} else {
			return false;
		}
	}


	public function recharge($type, $status, $expire)
	{
		$query = "INSERT INTO package(uid, type, status, date_expire) VALUES(?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id, $type, $status, $expire))) {
			return true;
		} else {
			return false;
		}
	}

	public function deactivateCode($code)
	{
		$query = "UPDATE recharge SET status = ? WHERE code = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array("used", $code))) {
			return true;
		} else {
			return false;
		}
	}

	public function bankExits()
	{
		$query = "SELECT * FROM bank WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getVendors()
	{
		$query = "SELECT * FROM vendors ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getBank()
	{
		$query = "SELECT * FROM bank WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id))) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->bankName = $row['bankName'];
				$this->bankAccName = $row['accName'];
				$this->bankAccNum = $row['accNumber'];
			}
		} else {
			return false;
		}
	}

	public function accType()
	{
		$query = "SELECT type FROM users WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id))) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['type'];
			}
		} else {
			return false;
		}
	}

	public function getRechargeCode($code)
	{
		$query = "SELECT * FROM recharge WHERE code = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($code));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row;
			}
		} else {
			return false;
		}
	}


	public function packageExits()
	{
		$query = "SELECT * FROM package WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function getPackages()
	{
		$query = "SELECT * FROM package WHERE uid = ? ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id))) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function deletePackage($pid)
	{
		$query = "DELETE FROM package WHERE uid = ? AND id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($this->id, $pid))) {
			return true;
		} else {
			return false;
		}
	}


	public function getEarnings($pid)
	{
		$query = "SELECT * FROM earnings WHERE uid = ? AND pid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, $pid));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['balance'];
			}
		} else {
			return 0;
		}
	}

	public function getHistory()
	{
		$query = "SELECT * FROM history WHERE uid = ? ORDER BY id DESC LIMIT 10";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return 0;
		}
	}

	public function getRechargeHistory()
	{
		$query = "SELECT * FROM history WHERE uid = ? AND type = ? ORDER BY id DESC LIMIT 10";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, "Recharge"));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return 0;
		}
	}


	public function addHistory($amount, $type)
	{
		$query = "INSERT INTO history (uid, amount, type) VALUES(?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, $amount, $type));
		if ($stmt->rowCount() == 1) {
			return $stmt;
		} else {
			return 0;
		}
	}

	public function getrefEarning()
	{
		$query = "SELECT * FROM ref_earnings WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['balance'];
			}
		} else {
			return 0;
		}
	}

	public function getWallet()
	{
		$query = "SELECT * FROM wallet WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['balance'];
			}
		} else {
			return 0;
		}
	}


	public function getrefCount()
	{
		$query = "SELECT * FROM users WHERE refBy = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		return $stmt->rowCount();
	}

	public function createWallet()
	{
		$query = "INSERT INTO wallet(uid, balance) VALUES (?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, 0));
		if ($stmt->rowCount() == 1) {
			return true;
		}
		return false;
	}


	public function createEarnings($pid)
	{
		$query = "INSERT INTO earnings(uid, pid, balance, lastClaimed) VALUES (?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, $pid, 0, date("Y-m-d H:i:s")));
		if ($stmt->rowCount() == 1) {
			return true;
		}
		return false;
	}


	public function getWithdrawal()
	{
		$query = "SELECT * FROM history WHERE type = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array("withdraw"));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		}
		return false;
	}

	public function getAccountStatus($uid)
	{
		$query = "SELECT status FROM users WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($uid));
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['status'];
			}
		}
		return false;
	}

	public function getWithdrawalHistory()
	{
		$query = "SELECT * FROM withdrawal WHERE uid = ? ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		}
		return false;
	}

	public function activeWithdrawal()
	{
		$query = "SELECT * FROM withdrawal WHERE uid = ? AND status = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, "Pending"));
		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}

	public function getRecentRecharge()
	{
		$query = "SELECT id FROM package WHERE uid = ? ORDER BY id DESC LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id));
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['id'];
			}
		}
		return false;
	}


	public function createRefEarnings()
	{
		$query = "INSERT INTO ref_earnings(uid, balance) VALUES (?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, 0));
		if ($stmt->rowCount() == 1) {
			return true;
		}
		return false;
	}


	public function topBonus($amount)
	{
		$query = "UPDATE ref_earnings SET balance = ? WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($amount, $this->id))) {
			return true;
		} else {
			return false;
		}
	}

	public function topWallet($amount)
	{
		$query = "UPDATE wallet SET balance = ? WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($amount, $this->id))) {
			return true;
		} else {
			return false;
		}
	}

	public function topEarnings($amount, $pid)
	{
		$query = "UPDATE earnings SET balance = ?, lastClaimed = ? WHERE uid = ? AND pid = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($amount, date("Y-m-d H:i:s"), $this->id, $pid))) {
			return true;
		} else {
			return false;
		}
	}

	public function getLastClaimed($pid)
	{
		$query = "SELECT lastClaimed FROM earnings WHERE uid = ? AND pid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($this->id, $pid));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['lastClaimed'];
			}
		} else {
			return false;
		}
	}
}
