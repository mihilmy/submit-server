<?php
	//Used as to contain database interaction to one class
	class DatabaseProvider{

		//Local host connection strings
		private $servername;
		private $username;
		private $password;
		private $database;
		private $conn;
		private static $instance;

		public function __construct(){
			$this->servername = "localhost";
			$this->username = "amazos";
			$this->password = "amazos2017";
			$this->database = "submit_server";
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
		}

		public function getConnectionString(){
			return $this->conn;
		}

		public function closeConnectionString(){
			mysqli_close($this->conn);
		}

		private function publishStudents(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS students ( 
				    directory_ID INT(9) AUTO_INCREMENT PRIMARY KEY,
    				name varchar(255) NOT NULL,
    				email varchar(255) NOT NULL,
					password varchar(255) NOT NULL,
					reg_date TIMESTAMP
					)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING STUDENTS';
			 }
			 	
		}

		private function publishTeachers(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS teachers ( 
				    directory_ID INT(9) AUTO_INCREMENT PRIMARY KEY,
    				name varchar(255) NOT NULL,
    				email varchar(255) NOT NULL,
					password varchar(255) NOT NULL,
					reg_date TIMESTAMP
					)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING TEACHERS';
			 }
		}

		private function publishClasses(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS classes ( 
    				name varchar(255) NOT NULL PRIMARY KEY,
    				teacherID int,
    				FOREIGN KEY(teacherID)	REFERENCES teachers(directory_ID)
    				)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING CLASSES';
			 }
		}

		private function publishAssignments(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS assignments ( 
    				assignment_ID INT(9) AUTO_INCREMENT PRIMARY KEY,
    				name varchar(255) NOT NULL,
    				class_name varchar(255),
    				due_date DATETIME NOT NULL,
    				max_score int NOT NULL,
    				FOREIGN KEY(class_name) REFERENCES classes(name)
    				)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING assignments';
			 }
		}

		private function publishStudent_Classes(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS student_classes ( 
    				student_ID INT NOT NULL,
    				class_name varchar(255) NOT NULL,
    				FOREIGN KEY(student_ID) REFERENCES students(directory_ID),
    				FOREIGN KEY(class_name) REFERENCES classes(name)
    				)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING student_classes';
			 }
		}

		private function publishTeacher_Classes(){
			$query = <<<DEMO
				CREATE TABLE IF NOT EXISTS teacher_classes ( 
    				teacher_id INT NOT NULL,
    				class_name varchar(255) NOT NULL,
    				FOREIGN KEY(teacher_id) REFERENCES teachers(directory_ID),
    				FOREIGN KEY(class_name) REFERENCES classes(name)
    				)
DEMO;


			 if (mysqli_query($this->conn, $query) === false){
			 	echo 'ERROR PUBLISING teachers_classes';
			 }
		}

		public function publish(){
			$this->publishStudents();
			$this->publishTeachers();
			$this->publishClasses();
			$this->publishAssignments();
			$this->publishStudent_Classes();
			$this->publishTeacher_Classes();
		}

		public static function getInstance()
		{
			// Check is $_instance has been set
			if(!isset(self::$instance)) 
			{
				// Creates sets object to instance
				self::$instance = new DatabaseProvider();
				self::$instance->publish();
			}

			// Returns the instance
			return self::$instance;
		}

	}



?>