<?php
	class AlbumConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "albums";
		public static $COLUMN_ID = "id";
		public static $COLUMN_NAME = "name";
		public static $COLUMN_DESCRIPTION = "description";
		public static $COLUMN_CATEGORY = "category";
		public static $COLUMN_COVER = "cover";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectByCategoryStatement = NULL;
		private $selectAllStatement = NULL;
		private $updateStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . AlbumConnector::$TABLE_NAME . "(`" . AlbumConnector::$COLUMN_NAME . "`, `" . AlbumConnector::$COLUMN_DESCRIPTION . "`, `" . AlbumConnector::$COLUMN_CATEGORY . "`, `" . AlbumConnector::$COLUMN_COVER . "`) VALUES(?, ?, ?, ?)");
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . AlbumConnector::$TABLE_NAME . "` WHERE `" . AlbumConnector::$COLUMN_ID . "` = ?");
			$this->selectByCategoryStatement = $mysqli->prepare("SELECT * FROM `" . AlbumConnector::$TABLE_NAME . "` WHERE `" . AlbumConnector::$COLUMN_CATEGORY . "` = ? ORDER BY `" . AlbumConnector::$COLUMN_CATEGORY . "`");
			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . AlbumConnector::$TABLE_NAME . "`");
			$this->updateStatement = $mysqli->prepare("UPDATE `" . AlbumConnector::$TABLE_NAME . "` SET `" . AlbumConnector::$COLUMN_NAME . "` = ?, `" . AlbumConnector::$COLUMN_DESCRIPTION . "` = ?, `" . AlbumConnector::$COLUMN_CATEGORY . "` = ? WHERE `" . AlbumConnector::$COLUMN_ID . "` = ?");
			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . AlbumConnector::$TABLE_NAME . " WHERE `" . AlbumConnector::$COLUMN_ID . "` = ?");
		}
		
		public function create($name, $description, $category, $cover) {
			$this->createStatement->bind_param("ssis", $name, $description, $category, $cover);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
			if(!$this->selectStatement->execute()) return false;

			$result = $this->selectStatement->get_result();
			if(!$result) return false;
			$album = $result->fetch_assoc();
			
			$this->selectStatement->free_result();
			
			return $album;
		}
		
		public function selectByCategory($category) {
			$this->selectByCategoryStatement->bind_param("i", $category);
			if(!$this->selectByCategoryStatement->execute()) return false;
			$result = $this->selectByCategoryStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false;
			$result = $this->selectAllStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function update($id, $name, $description, $category) {
			$this->updateStatement->bind_param("ssii", $name, $description, $category, $id);
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
