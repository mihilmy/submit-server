<?php
	//Used as to contain database interaction to one class
	Class DatabaseProvider{

		//Local host connection strings
		private $username;
		private $password;

		//Singelton instance accessed by static Instance method below
		private $instance = new DatabaseProvider();

		//Static method to return the singelton instance of the class
		public static function Instance() {
			return $this->instance
		}

		//------------Students related DB Operations---------------------
		public function getAllStudents() {

		}

		public function getSingleStudent() {

		}

		public function newStudent() {

		}

		public function updateStudent(){

		}

		public function removeStudent(){

		}

		//------------Teachers related DB Operations---------------------

		public function getAllTeachers() {

		}

		public function getSingleTeacher(){

		}

		public function newTeacher(){

		}

		public function updateTeacher(){

		}

		public function removeTeacher(){

		}

		//------------Classes related DB Operations---------------------

		public function getAllClasses(){

		}

		public function getSingleClass(){

		}

		public function newClass(){

		}

		public function updateClass(){

		}

		public function removeClass(){

		}

		//------------Tests related DB Operations-----------------------

		public function getAllTests(){

		}

		public function getSingleTest(){

		}

		public function newTest(){

		}

		public function updateTest(){

		}

		public function removeTest(){

		}

		//-------------Join Relation Operations--------------------------


	}

?>