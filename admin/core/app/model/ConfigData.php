<?php
class ConfigData extends Extra {
	public static $tablename = "config";

	public $id;
	public $slug;
	public $name;
	public $kind;
	public $description;
	public $advice;


	public function __construct(){
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (slug,name,kind,description) ";
		$sql .= "value (\"$this->slug\",\"$this->name\",\"$this->kind\",\"$this->description\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set description=\"$this->description\" where slug=\"$this->slug\"";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ConfigData());
	}

	public static function getByKey($key){
		$sql = "select * from ".self::$tablename." where slug=\"$key\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ConfigData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ConfigData());
	}

}
?>
