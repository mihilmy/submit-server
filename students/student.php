<?php 
	class Student {
		private $name;
		private $directoryId;
		private $email;
		
		public function __contruct($name,$directoryId,$email) {
			$this->name = $name;
			$this->directoryId = $directoryId;
			$this->email = $name;
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