<?php
class SettingData extends Extra {
    public static $tablename = "config";
    public $id;
    public $slug;
    public $name;
    public $description;

    public function __construct() {
    }

    public function update() {
        $sql = "update ".self::$tablename." set description=\"$this->description\" where slug=\"$this->slug\"";
        Executor::doit($sql);
    }

    public static function getByKey($key) {
        $sql = "select * from ".self::$tablename." where slug=\"$key\"";
        $query = Executor::doit($sql);
        return Model::one($query[0], new SettingData());
    }

    public static function getValue($key) {
        $s = self::getByKey($key);
        if($s) return $s->description;
        return "";
    }

    public static function getAll() {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new SettingData());
    }
}
?>
