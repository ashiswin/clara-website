<?php
	class BannerConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "banners";
		public static $COLUMN_ID = "id";
		public static $COLUMN_IMAGE = "image";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . BannerConnector::$TABLE_NAME . "(`" . BannerConnector::$COLUMN_IMAGE . "`) VALUES(?)");
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . BannerConnector::$TABLE_NAME . "` WHERE `" . BannerConnector::$COLUMN_ID . "` = ?");
			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . BannerConnector::$TABLE_NAME . "`");
			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . BannerConnector::$TABLE_NAME . " WHERE `" . BannerConnector::$COLUMN_ID . "` = ?");
		}
		
		public function create($image) {
			$this->createStatement->bind_param("s", $image);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
			if(!$this->selectStatement->execute()) return false;

			$result = $this->selectStatement->get_result();
			if(!$result) return false;
			$image = $result->fetch_assoc();
			
			$this->selectStatement->free_result();
			
			return $image;
		}
		
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false;
			$result = $this->selectAllStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function delete($id) {
			if($id == NULL) return false;
			
			$this->deleteStatement->bind_param("i", $id);
			if(!$this->deleteStatement->execute()) return false;
			
			return true;
		}
	}
?>
