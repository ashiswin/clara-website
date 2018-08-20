<?php
	class ImageConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "images";
		public static $COLUMN_ID = "id";
		public static $COLUMN_IMAGE = "image";
		public static $COLUMN_ALBUM = "album";
		public static $COLUMN_LANDSCAPE = "landscape";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectByAlbumStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		private $deleteByAlbumStatement = NULL;
		private $setIdStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . ImageConnector::$TABLE_NAME . "(`" . ImageConnector::$COLUMN_IMAGE . "`, `" . ImageConnector::$COLUMN_ALBUM . "`, `" . ImageConnector::$COLUMN_LANDSCAPE . "`) VALUES(?, ?, ?)");
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . ImageConnector::$TABLE_NAME . "` WHERE `" . ImageConnector::$COLUMN_ID . "` = ?");
			$this->selectByAlbumStatement = $mysqli->prepare("SELECT * FROM `" . ImageConnector::$TABLE_NAME . "` WHERE `" . ImageConnector::$COLUMN_ALBUM . "` = ?");
			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . ImageConnector::$TABLE_NAME . "`");
			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . ImageConnector::$TABLE_NAME . " WHERE `" . ImageConnector::$COLUMN_ID . "` = ?");
			$this->deleteByAlbumStatement = $mysqli->prepare("DELETE FROM " . ImageConnector::$TABLE_NAME . " WHERE `" . ImageConnector::$COLUMN_ALBUM . "` = ?");
			$this->setIdStatement = $mysqli->prepare("UPDATE `" . ImageConnector::$TABLE_NAME . "` SET `" . ImageConnector::$COLUMN_ID . "` = ? WHERE `" . ImageConnector::$COLUMN_ID . "` = ?");
		}
		
		public function create($image, $album, $landscape) {
			$this->createStatement->bind_param("sii", $image, $album, $landscape);
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
		
		public function selectByAlbum($album) {
			$this->selectByAlbumStatement->bind_param("i", $album);
			if(!$this->selectByAlbumStatement->execute()) return false;
			$result = $this->selectByAlbumStatement->get_result();
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
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
		
		public function deleteByAlbum($album) {
			$this->deleteByAlbumStatement->bind_param("i", $album);
			if(!$this->deleteByAlbumStatement->execute()) return false;
			
			return true;
		}
		
		public function setId($originalId, $newId) {
			$this->setIdStatement->bind_param("ii", $newId, $originalId);
			if(!$this->setIdStatement->execute()) return false;
			
			return true;
		}
	}
?>
