<?php 
	require_once("../Services/DatabaseProvider.php");
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
			$conn = DatabaseProvider::getInstance();
			$conn = $conn->getConnectionString();
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO assignments (name,class_name,due_date,max_score)
			VALUES ('$name', '$courseName' , '$dueDate', $maxScore);";

			if ($conn->query($sql) === TRUE) {
				$instance->Id = $conn->insert_id;
				$conn->close();
                return $instance;
			} else {
				$conn->close();
				return null;
			}
		}
		
		public static function parseDbResult($row) {
            $instance = new self();
            date_default_timezone_set('EST');
			$instance->Id = $row['assignment_ID'];
			$instance->name = $row['name'];
			$instance->courseName = $row['class_name'];
			date_default_timezone_set('EST');
			$instance->dueDate = new DateTime($row['due_date']);
			$instance->maxScore = $row['max_score'];
            return $instance;
		}
		
		public function getId() {
			return $this->Id;
		}
		
		public function getName() {
			return $this->name;	
		}
        
        public function setName($newName) {
            $conn = new mysqli("localhost", "amazos", "amazos2017", "submit_server");
            $sql = "UPDATE Assignments SET name='$newName' WHERE assignment_ID=$this->Id";

            if ($conn->query($sql) === TRUE) {
                $this->name = $newName;
				$conn->close();
                return true;
            } else {
				$conn->close();
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
            $conn = new mysqli("localhost", "amazos", "amazos2017", "submit_server");
            $sql = "UPDATE Assignments SET max_score=$newMax WHERE assignment_ID=$this->Id";

            if ($conn->query($sql) === TRUE) {
                $this->maxScore = $newMax;
				$conn->close();
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
            $conn = new mysqli("localhost", "amazos", "amazos2017", "submit_server");
            $sql = "UPDATE Assignments SET due_date='$newDueDate' WHERE assignment_ID=$this->Id";

            if ($conn->query($sql) === TRUE) {
                $this->dueDate = new DateTime($newDueDate);
				$conn->close();	
                return true;
            } else {
				$conn->close();
                return false;
            }
        }
	}
?>