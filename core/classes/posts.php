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

	public function get_last_post() {
		$query = "SELECT MAX(id) from posts";
		$max = $this->db->query($query);
		$max = $max->fetch();
		$query1 = $this->db->prepare("SELECT * FROM posts WHERE id = '$max[0]'");

		try {
			$rows = $query1->execute();
		    $rows = $query1->fetch();
			return $rows;
		}
		catch(PDOException $e){
			die($e->getMessage());
	    }
	}

	
}

?>