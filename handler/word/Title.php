<?php
/**
 * 标题栏每日一句
 */
class Title implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSRequestMainTitleMessage ( $bin );
	}
	function handle() {
		if (count ( $this->package->getScLangList () ) <= 0) {
			return;
		}
		$mysql = Mysql::getInstence ();
		$sql = "SELECT * FROM `t_title` WHERE";
		$list = $this->package->getScLangList ();
		// 遍历语言数组
		for($index = 0; $index < count ( $list ); ++ $index) {
			$language = $list [index]->getLangName ();
			$sql .= " `language` = '$language'";
			$sql .= " OR";
		}
		$sql = substr ( $sql, 0, strlen ( $sql ) - 3 ) . "ORDER BY `language` ASC,`index` ASC";
		$result = $mysql->query ( $sql );
		$this->package = new SCResponeMainTitleMessage ();
		$_scLangList = array ();
		for($index = 0; $index < $result->num_rows; ++ $index) {
			$row = $result->fetch_row ();
			$vo = new LangContextNetVO ();
			$vo->setIndex ( $row ["index"] );
			$vo->setLangName ( $row ["language"] );
			$vo->setLangContext ( $row ["content"] );
			array_push ( $_scLangList, $vo );
		}
		$this->package->setScLangList ( $_scLangList );
		$result->close ();
		echo $this->package->build ()->toString ();
	}
}
?>