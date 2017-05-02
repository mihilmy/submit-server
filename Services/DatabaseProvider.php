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

		public static function getInstance(){
			// Check is $_instance has been set
			if(!isset(self::$instance)) 
			{
				// Creates sets object to instance
				self::$instance = new DatabaseProvider();
			}

			// Returns the instance
			return self::$instance;
		}

	}



?>