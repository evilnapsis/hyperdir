<?php
class PostCategoryData extends Extra {
	public static $tablename = "post_category";

	public $post_id;
	public $category_id;


	public function __construct(){
	}

	public function getPost(){ return PostData::getById($this->post_id); }
	public function getCategory(){ return CategoryData::getById($this->category_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (post_id,category_id) ";
		$sql .= "value (\"$this->post_id\",\"$this->category_id\")";
		return Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where post_id=$this->post_id and category_id=$this->category_id";
		Executor::doit($sql);
	}

	public static function getByPC($p,$c){
		$sql = "select * from ".self::$tablename." where post_id=$p and category_id=$c";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostCategoryData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}

	public static function getAllByPostId($id){
		$sql = "select * from ".self::$tablename." where post_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}


	public static function getAllByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}


}
?>
