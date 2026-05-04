<?php
class Database {
	public static $db;
	public static $con;
	public $user;
	public $host;
	public $pass;
	public $ddbb;

	function __construct(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="hyperdir";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con->query("SET sql_mode = ''");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
