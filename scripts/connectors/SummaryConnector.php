<?php
	class SummaryConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "summaries";
		public static $COLUMN_ID = "id";
		public static $COLUMN_IMAGE = "image";
		public static $COLUMN_SUMMARY = "summary";
		
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
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . SummaryConnector::$TABLE_NAME . "(`" . SummaryConnector::$COLUMN_IMAGE . "`, `" . SummaryConnector::$COLUMN_SUMMARY . "`) VALUES(?, ?)");
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . SummaryConnector::$TABLE_NAME . "` WHERE `" . SummaryConnector::$COLUMN_ID . "` = ?");
			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . SummaryConnector::$TABLE_NAME . "`");
			$this->updateStatement = $mysqli->prepare("UPDATE `" . SummaryConnector::$TABLE_NAME . "` SET `" . SummaryConnector::$COLUMN_SUMMARY . "` = ? WHERE `" . SummaryConnector::$COLUMN_ID . "` = ?");
			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . SummaryConnector::$TABLE_NAME . " WHERE `" . SummaryConnector::$COLUMN_ID . "` = ?");
		}
		
		public function create($image, $summary) {
			$this->createStatement->bind_param("ss", $image, $summary);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
			if(!$this->selectStatement->execute()) return false;

			$result = $this->selectStatement->get_result();
			if(!$result) return false;
			$summary = $result->fetch_assoc();
			
			$this->selectStatement->free_result();
			
			return $summary;
		}
		
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false;
			$result = $this->selectAllStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function update($id, $summary) {
			$this->updateStatement->bind_param("si", $summary, $id);
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
