<?php

class Chat_Model {

	private $_oCore;

	function __construct() {
		$this->_oCore = Core::getInstance();
		//$this->_oCore->_oDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function insertMessage($data) {
		try {
			$sql = "INSERT INTO chatlog (name, msg, mdate) 
					VALUES (:name, :msg, NOW())";
			$stmt = $this->_oCore->_oDb->prepare($sql);
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
			$stmt->bindParam(':msg', $data['message'], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return $this->_oCore->_oDb->lastInsertId();;
			} else {
				return '0';
			}
		} catch(PDOException $e) {
        	return $e->getMessage();
    	}
	}
	
	// Get all users
	public function getMessages() {
		$r = array();		

		$sql = "
			SELECT *
			FROM chatlog
		";
		$stmt = $this->_oCore->_oDb->prepare($sql);
		//$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);		   	
		} else {
			$r = 0;
		}		
		return $r;
	}

	// Get user by the Id
	public function getUserById($id) {
		$r = array();		
		
		$sql = "SELECT nombre * evnt_usuario WHERE id=$id";
		$stmt = $this->_oCore->_oDb->prepare($sql);
		//$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);		   	
		} else {
			$r = 0;
		}		
		return $r;
	}

	// Get user by the Login
	public function getUserByLogin($email, $pass) {
		$r = array();		
		
		$sql = "SELECT * FROM user WHERE email=:email AND password=:pass";		
		$stmt = $this->_oCore->_oDb->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);		   	
		} else {
			$r = 0;
		}		
		return $r;
	}

	// Update the data of an user
	public function updateUser($data) {
		
	}

	// Delete user
	public function deleteUser($id) {
		
	}

}