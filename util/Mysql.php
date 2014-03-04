<?php
/**
 * Mysql工具类
 */
class Mysql {
	private static $mysql;
	private static $mysqli;
	// 屏蔽构造函数
	private function __construct() {
		if (self::$mysqli == null) {
			// self::$mysqli = new mysqli ( "127.0.0.1", "root", "root", "server", "3306" );
			self::$mysqli = new mysqli ( "127.0.0.1", "symentyc_guoqi", "555263", "symentyc_server", "3306" );
			self::$mysqli->set_charset ( "UTF8" );
			if (self::$mysqli->connect_errno) {
				echo "Failed to connect to MySQL: " . self::$mysqli->connect_error;
			}
		}
	}
	// 获得实例
	public static function getInstence() {
		if (self::$mysql == null) {
			self::$mysql = new Mysql ();
		}
		return self::$mysql;
	}
	// 插入
	public static function insert($sql) {
		return self::$mysqli->query ( $sql );
	}
	
	// 查询
	public static function query($sql) {
		return self::$mysqli->query ( $sql );
	}
	
	// 大量查询
	public static function queryLarge($sql) {
		return self::$mysqli->query ( $sql, MYSQLI_USE_RESULT );
	}
}
?>