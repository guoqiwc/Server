<?php
/**
 * 读取界面
 */
class LoadingPage implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSRequestLoadingPageMessage ( $bin );
	}
	function handle() {
		if (count ( $this->package->getCsLangList () ) <= 0) {
			return;
		}
		$mysql = Mysql::getInstence ();
		$sql = "SELECT * FROM `t_loading_page` WHERE";
		$list = $this->package->getCsLangList ();
		// 遍历语言数组
		for($index = 0; $index < count ( $list ); ++ $index) {
			$language = $list [$index]->getLangName ();
			$sql .= " `language` = '$language'";
			$sql .= " OR";
		}
		$sql = substr ( $sql, 0, strlen ( $sql ) - 3 ) . "ORDER BY `language` ASC,`index` ASC";
		$result = $mysql->query ( $sql );
		$this->package = new SCResponeLoadingPageMessage ();
		$_scLangList = array ();
		for($index = 0; $index < $result->num_rows; ++ $index) {
			$row = $result->fetch_row ();
			$vo = new LangContextNetVO ();
			$vo->setIndex ( $row [2] );
			$vo->setLangName ( $row [1] );
			$vo->setLangContent ( $row [3] );
			array_push ( $_scLangList, $vo );
		}
		$this->package->setScLangList ( $_scLangList );
		$result->close ();
		return $this->package->build ()->getByteArray ();
	}
}

?>