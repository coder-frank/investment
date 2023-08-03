<?php

class Admin
{
	// CONNECTION
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}


	public function passHash($epass)
	{
		return password_hash($epass, PASSWORD_BCRYPT);
	}

	public function generateCode()
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = '';
		$length = 10;

		for ($i = 0; $i < $length; $i++) {
			$randomIndex = rand(0, strlen($characters) - 1);
			$code .= $characters[$randomIndex];
		}

		return $code;
	}

	public function codeExits($code)
	{
		$query = "SELECT code FROM recharge WHERE type = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($code));
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function addCode($code, $type)
	{
		$query = "INSERT INTO recharge(code, type, status) VALUES(?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($code, $type, "active"))) {
			return true;
		} else {
			return false;
		}
	}

	public function login($email, $password)
	{
		$query = "SELECT * FROM admin WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($email));
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$hashedPasswordFromDB = $row['password'];

			// Verify the entered password against the hashed password from the database
			if (password_verify($password, $hashedPasswordFromDB)) {
				return $row;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	public function getUsers()
	{
		$query = "SELECT * FROM users ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getPackages()
	{
		$query = "SELECT * FROM package ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getBank($uid)
	{
		$query = "SELECT * FROM bank WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($uid));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getWithdrawal()
	{
		$query = "SELECT * FROM withdrawal ORDER BY id DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getEarning($uid)
	{
		$query = "SELECT * FROM earnings WHERE uid = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($uid));
		if ($stmt->rowCount() > 0) {
			return $stmt;
		} else {
			return false;
		}
	}

	public function getBonus($uid)
	{
		$query = "SELECT * FROM ref_earnings WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($uid));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['balance'];
			}
		} else {
			return 0;
		}
	}

	public function getWallet($uid)
	{
		$query = "SELECT * FROM wallet WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(array($uid));
		if ($stmt->rowCount() == 1) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['balance'];
			}
		} else {
			return 0;
		}
	}

	public function delete($uid)
	{
		$query = "DELETE FROM users WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($uid))) {
			return true;
		} else {
			return false;
		}
	}

	public function suspend($uid)
	{
		$query = "UPDATE users SET status = ? WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array("suspended", $uid))) {
			return true;
		} else {
			return false;
		}
	}

	public function activate($uid)
	{
		$query = "UPDATE users SET status = ? WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array("active", $uid))) {
			return true;
		} else {
			return false;
		}
	}

	public function deductBonus($uid, $amount)
	{
		$query = "UPDATE ref_earnings SET balance = ? WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($amount, $uid))) {
			return true;
		} else {
			return false;
		}
	}

	public function deductWallet($uid, $amount)
	{
		$query = "UPDATE wallet SET balance = ? WHERE uid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($amount, $uid))) {
			return true;
		} else {
			return false;
		}
	}

	public function approve($wid)
	{
		$query = "UPDATE withdrawal SET status = ? WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array("Approved", $wid))) {
			return true;
		} else {
			return false;
		}
	}


	public function decline($wid)
	{
		$query = "UPDATE withdrawal SET status = ? WHERE id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array("Declined", $wid))) {
			return true;
		} else {
			return false;
		}
	}

	public function addHistory($uid, $amount, $type)
	{
		$query = "INSERT INTO history (uid, amount, type) VALUES(?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute(array($uid, $amount, $type))) {
			return true;
		} else {
			return 0;
		}
	}
}
