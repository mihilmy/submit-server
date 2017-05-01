<?php 
	class Teacher {
		private $name;
		private $directory_id;
		private $email;
		
		public function __contruct($name,$directory_id,$email, $password) {
			$this->name = $name;
			$this->directory_id = $directory_id;
			$this->email = $email;
			$this->password = $password;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getDIrectoryID() {
			return $this->SSN;	
		}
		
		public function getEmail() {
			return $this->email;
		}
	}
?>