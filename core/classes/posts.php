<?php

class Posts{
	private $db;

	public function __construct($database) {
		$this->db = $database;
	}

	//Updates "saves" table, row 1, with current content of title and textarea fields.
	public function save_post($title, $text) {
		$query = $this->db->prepare("UPDATE posts SET title=?, content=? WHERE id='1'");
		$query->bindValue(1, $title);
		$query->bindValue(2, $text);
		try {
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function get_saved_post() {
		$query = $this->db->prepare("SELECT * FROM posts WHERE id = '1'");

		try {
			$rows = $query->execute();
		    $rows = $query->fetch();
			return $rows;
		}
		catch(PDOException $e){
			die($e->getMessage());
	    }
	}

	public function add_post($title, $text) {
		$query = $this->db->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
		$query->bindValue(1, $title);
		$query->bindValue(2, $text);
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