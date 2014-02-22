<?php
/**
 * 标题栏每日一句
 */
class Title {
	private $package;
	function __construct($package) {
		$this->package = $package;
	}
	function handle() {
		$language = array (
				"CN",
				"EN" 
		);
		$mysql = Mysql::getInstence ();
		$sql = "SELECT * FROM `t_title` WHERE";
		// 遍历语言数组
		for($index = 0; $index < count ( $language ); ++ $index) {
			$sql .= " `language` = '$language[$index]'";
			$sql .= " OR";
		}
		$sql = substr ( $sql, 0, strlen ( $sql ) - 3 ) . "ORDER BY `language` ASC";
		$result = $mysql->query ( $sql );
		for($index = 0; $index < $result->num_rows; ++ $index) {
			// TODO 这里面开始攒包裹返回
			var_dump ( $row = $result->fetch_row () );
		}
		$result->close ();
	}
}
?>