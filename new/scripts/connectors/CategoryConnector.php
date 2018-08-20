<?php
	class CategoryConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "categories";
		public static $COLUMN_ID = "id";
		public static $COLUMN_COVER = "cover";
		public static $COLUMN_CATEGORY = "category";
		public static $COLUMN_DESCRIPTION = "description";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectAllStatement = NULL;
		private $updateStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . CategoryConnector::$TABLE_NAME . "(`" . CategoryConnector::$COLUMN_COVER . "`, `" . CategoryConnector::$COLUMN_CATEGORY . "`, `" . CategoryConnector::$COLUMN_DESCRIPTION . "`) VALUES(?, ?, ?)");
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . CategoryConnector::$TABLE_NAME . "` WHERE `" . CategoryConnector::$COLUMN_ID . "` = ?");
			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . CategoryConnector::$TABLE_NAME . "`");
			$this->updateStatement = $mysqli->prepare("UPDATE `" . CategoryConnector::$TABLE_NAME . "` SET `" . CategoryConnector::$COLUMN_CATEGORY . "` = ?, `" . CategoryConnector::$COLUMN_DESCRIPTION . "` = ? WHERE `" . CategoryConnector::$COLUMN_ID . "` = ?");
			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . CategoryConnector::$TABLE_NAME . " WHERE `" . CategoryConnector::$COLUMN_ID . "` = ?");
		}
		
		public function create($cover, $category, $description) {
			$this->createStatement->bind_param("sss", $cover, $category, $description);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
			if(!$this->selectStatement->execute()) return false;

			$result = $this->selectStatement->get_result();
			if(!$result) return false;
			$description = $result->fetch_assoc();
			
			$this->selectStatement->free_result();
			
			return $description;
		}
		
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false;
			$result = $this->selectAllStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function update($id, $category, $description) {
			$this->updateStatement->bind_param("ssi", $category, $description, $id);
			return $this->updateStatement->execute();
		}
		
		public function delete($id) {
			if($id == NULL) return false;
			
			$this->deleteStatement->bind_param("i", $id);
			if(!$this->deleteStatement->execute()) return false;
			
			return true;
		}
	}
?>
