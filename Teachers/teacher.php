<?php 
	class Teacher {
		private $name;
		private $directoryId;
		private $email;
		
		public function __contruct($name,$email, $directoryId) {
			$this->name = $name;
			$this->directory_id = $directory_id;
			$this->email = $email;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getDIrectoryID() {
			return $this->directoryId;	
		}
		
		public function getEmail() {
			return $this->email;
		}
	}
?>