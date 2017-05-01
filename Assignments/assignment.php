<?php 
	class Assignment {
		public $Id;
		public $name;
		public $courseName;
		public $dueDate;
		public $maxScore;
		public $testId;
		
		/*
		this constructor expects the dueDate and createdAt to be in this format 
		'Year-Month-Day Hour:Minute' 
		
		date_default_timezone_set('EST');
		*/
		
		public function __construct() {
				// allocate your stuff
		}

		public static function createNew($name,$courseName, $dueDate, $maxScore) {
			$instance = new self();
			$instance->name = $name;
			$instance->courseName = $courseName;
			date_default_timezone_set('EST');
			$instance->dueDate = new DateTime($dueDate);
			$instance->maxScore = $maxScore;
			$instance->testId = null;
			$conn = new mysqli("localhost", "dbuser", "goodbyeWorld", "applicationdb");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO Assignments (Name,courseName,dueDate,maxScore)
			VALUES ('$name', '$courseName' , '$dueDate', $maxScore);";

			if ($conn->query($sql) === TRUE) {
				$instance->Id = $conn->insert_id;
                return $instance;
			} else {
				return null;
			}
		}
		
		public static function parseDbResult($row) {
            $instance = new self();
            date_default_timezone_set('EST');
			$instance->Id = $row['id'];
			$instance->name = $row['name'];
			$instance->courseName = $row['courseName'];
			date_default_timezone_set('EST');
			$instance->dueDate = new DateTime($row['dueDate']);
			$instance->maxScore = $row['maxScore'];
			$instance->testId = $row['testId'];
            return $instance;
		}
		
		public function getId() {
			return $this->Id;
		}
		
		public function getName() {
			return $this->name;	
		}
        
        public function setName($newName) {
            $conn = new mysqli("localhost", "dbuser", "goodbyeWorld", "applicationdb");
            $sql = "UPDATE Assignments SET name='$name' WHERE id=$this->id";

            if ($conn->query($sql) === TRUE) {
                $this->name = $newName;
                return true;
            } else {
                return false;
            }
		}
		
		public function getCourseName() {
			return $this->courseName;
		}
        
		public function getMaxScore() {
			return $this->maxScore;
		}
        
        public function setMaxScore($newMax) {
            $conn = new mysqli("localhost", "dbuser", "goodbyeWorld", "applicationdb");
            $sql = "UPDATE Assignments SET maxScore=$newMax WHERE id=$this->id";

            if ($conn->query($sql) === TRUE) {
                $this->maxScore = $newMax;
                return true;
            } else {
                return false;
            }
		}
		public function getTestId() {
			return $this->test;
		}
		
		public function getDueDateString() {
			return $this->dueDate->format('Y-m-d H:i');
		}
		
		public function getDueDateObject() {
			return $this->dueDate;
		}
        
        public function setDueDate($newDueDate) {
            $conn = new mysqli("localhost", "dbuser", "goodbyeWorld", "applicationdb");
            $sql = "UPDATE Assignments SET dueDate='$newDueDate' WHERE id=$this->id";

            if ($conn->query($sql) === TRUE) {
                $this->dueDate = new DateTime($newDueDate);
                return true;
            } else {
                return false;
            }
        }
	}
?>