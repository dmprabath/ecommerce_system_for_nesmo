<?php 
	class Config{ //create class for database details
		public static $host = "localhost"; 
		public static $db_uname = "root";	// username
		public static $db_upass = "";		//password
		public static $db_name = "nesmo_db";//database name
	}

	class DB{
		public static function connect(){
			$host = Config::$host;
			$uname = Config::$db_uname;
			$upass = Config::$db_upass;
			$db = Config::$db_name;

			$dbobj = new mysqli($host,$uname,$upass,$db); //create database connection
						
			if($dbobj->connect_errno){
				echo("DB connection Error<br/>");
				echo("Error Text :".$dbobj->connect_error);
				exit;
			}
			return $dbobj;
		}
	}
?>