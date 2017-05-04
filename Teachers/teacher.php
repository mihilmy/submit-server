<?php 
	class Teacher {
		private $name;
		private $directoryId;
		private $email;
		
		public function __construct($name,$email,$directoryId) {
			$this->name = $name;
			$this->directoryId = $directoryId;
			$this->email = $email;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getDirectoryId() {
			return $this->directoryId;	
		}
		
		public function getEmail() {
			return $this->email;
		}
	}
?>