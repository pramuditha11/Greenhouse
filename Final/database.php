<?php
	class Database {
		private static $dbName = 'esp32_mc_db'; // Database name
		private static $dbHost = 'localhost'; // Database host
		private static $dbUsername = 'root'; // Database username
		private static $dbUserPassword = ''; // Database password
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
			// One connection throughout the application
			if ( null == self::$cont ) {     
				try {
					// Establishing a PDO connection
					self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
				} catch(PDOException $e) {
					// Handle connection errors
					die($e->getMessage()); 
				}
			}
			// Return the database connection
			return self::$cont;
		}
		 
		public static function disconnect() {
			// Close the database connection
			self::$cont = null;
		}
	}
?>
