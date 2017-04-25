<?php 
	class Teacher {
		private $name;
		private $SSN;
		private $email;
		
		public function __contruct($name,$SSN,$email) {
			$this->name = $name;
			$this->SSN = $SSN;
			$this->email = $name;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getSSN() {
			return $this->SSN;	
		}
		
		public function getEmail() {
			return $this->email;
		}
	}
?>