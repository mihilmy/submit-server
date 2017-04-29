<?php 
	class Assignment {
		private $Id;
		private $name;
		private $courseName;
		private $dueDate;
		private $maxScore;
		private $testId;
		private $createdAt;
		
		/*
		this constructor expects the dueDate and createdAt to be in this format 
		'Year-Month-Day Hour:Minute' 
		
		date_default_timezone_set('EST');
		*/
		public function __contruct($Id,$name,$courseName, $dueDate, $maxScore, $testId, $createdAt) {
			$this->Id = $Id;
			$this->name = $name;
			$this->courseName = $courseName;
			date_default_timezone_set('EST');
			$this->dueDate = new DateTime($dueDate);
			$this->maxScore = $maxScore;
			$this->testId = $testId;
			$this->createdAt = new DateTime($createdAt);
		}
		
		public function getId() {
			return $this->Id;
		}
		
		public function getName() {
			return $this->name;	
		}
		
		public function getCourseName() {
			return $this->courseName;
		}
		public function getMaxScore() {
			return $this->maxScore;
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
		
		public function getCreatedAtString() {
			return $this->createdAt->format('Y-m-d H:i');
		}
		
		public function getCreatedAtObject() {
			return $this->createdAt;
		}
	}
?>

Assignments Majed(index,show,create,edit)
ID
Name
Course Name (Foreign Key)
Due Date
Max Score
Test ID
Create At
