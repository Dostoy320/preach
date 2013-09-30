<?php

class Posts{
	private $db;

	public function __construct($database) {
		$this->db = $database;
	}

	public function add_post($text) {
		$query = $this->db->prepare("INSERT INTO posts (content) VALUES (?)");
		$query->bindValue(1, $text);

		try {
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	
}

?>