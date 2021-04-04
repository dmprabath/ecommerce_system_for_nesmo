<?php 
	class Config{
		public static $host = "localhost";  //server name
		public static $db_uname = "root"; // user name
		public static $db_upass = "";     //user password
		public static $db_name = "nesmo_db"; // database name

	}

	class DB{
		public static function connect(){
			$host = Config::$host;
			$uname = Config::$db_uname;
			$upass = Config::$db_upass;
			$db = Config::$db_name;
            // connect mysql database
			$dbobj = new mysqli($host,$uname,$upass,$db);

			if($dbobj->connect_errno){
				echo("DB connection Error<br/>");
				echo("Error Text :".$dbobj->connect_error);
				exit;
			}
			//return database
			return $dbobj;
		}
	}

	
	
?>