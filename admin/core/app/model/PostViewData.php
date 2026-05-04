<?php
class PostViewData extends Extra {
	public static $tablename = "post_view";

	public $id;
	public $viewer_id;
	public $post_id;
	public $created_at;
	public $realip;
    public $c;

	public function __construct(){
		$this->viewer_id = "NULL";
		$this->post_id = "NULL";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (viewer_id,post_id,created_at,realip) ";
		$sql .= "value ($this->viewer_id,$this->post_id,$this->created_at,\"$this->realip\")";
		return Executor::doit($sql);
	}

	public static function getAllByPostId($id){
		$sql = "select * from ".self::$tablename." where post_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostViewData());
	}

	public static function countByPostId($id){
		$sql = "select count(*) as c from ".self::$tablename." where post_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostViewData())->c;
	}

	public static function getByIPAndPost($ip, $post_id){
		$sql = "select * from ".self::$tablename." where realip=\"$ip\" and post_id=$post_id and date(created_at)=date(NOW())";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostViewData());
	}

    public static function countByDay($day){
		$sql = "select count(*) as c from ".self::$tablename." where date(created_at)=\"$day\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostViewData())->c;
	}

}
?>
