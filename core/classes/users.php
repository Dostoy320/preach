<?php

class Users{
	private $db;

	public function __construct($database) {
		$this->db = $database;
	}


	public function user_exists($username) {
		$query = $this->db->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
		$query->bindValue(1, $username);

		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}
			else{
				return false;
			}
		}
		catch (PDOException $e){
			die($e->getMessage());
		}
	}

	public function register($username, $password){
		$time 		= time();
		$ip 		= $_SERVER['REMOTE_ADDR'];
		$password 	= sha1($password);

		$query = $this->db->prepare("INSERT INTO users (username, password, ip, time) VALUES (?, ?, ?, ?)");

		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->bindValue(3, $ip);
		$query->bindValue(4, $time);

		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	
	public function login($username, $password) {

		$query = $this->db->prepare("SELECT password, id FROM users WHERE username = ?");
		$query->bindValue(1, $username);

		try{

			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password'];
			$id				    = $data['id'];

			#hashing the supplied password and comparing it with the stored hashed password.
			if($stored_password === sha1($password)){
				return $id;
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
		$query->bindValue(1, $id);

		try {

			$query->execute();

			return $query->fetch();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function get_users() {

		#preparing a statement that will select all the registered users. Most recent first...
		$query = $this->db->prepare("SELECT * FROM users ORDER BY time DESC");

		try{
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}

		#fetchAll gets an array of all selected records.
		return $query->fetchAll();
	}

}

?>