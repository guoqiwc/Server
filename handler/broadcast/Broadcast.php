<?php
/**
 * 广播
 */
class Broadcast implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSRequestBroadCastMessage ( $bin );
	}
	function handle() {
		if (count ( $this->package->getCsBroadCastList () ) <= 0) {
			return;
		}
		$mysql = Mysql::getInstence ();
		$sql = "SELECT * FROM t_broadcast WHERE";
		$list = $this->package->getCsBroadCastList ();
		// 遍历语言数组
		for($index = 0; $index < count ( $list ) - 1; ++ $index) {
			$language = $list [$index]->getLangName ();
			$time = $list [$index]->getTimeStamp ();
			$sql .= "(`language` = '$language' AND `time` > '$time' ) OR";
		}
		$_language = $list [count ( $list ) - 1]->getLangName ();
		$_time = $list [count ( $list ) - 1]->getTimeStamp ();
		$sql .= "(`language` = '$_language' AND `time` > '$_time' )";
		$sql .= "ORDER BY `language` DESC, `time` DESC;";
		$result = $mysql->query ( $sql );
		
		// 开始攒包
		$this->package = new SCResponeBroadCastMessage ();
		$_scTimeStampList = array ();
		$_scBroadCastList = array ();
		$language = "";
		for($index = 0; $index < $result->num_rows; ++ $index) {
			$row = $result->fetch_row ();
			// 递推获得最新语言的时间戳
			if ($language == "" || $language != $row ['language']) {
				$language = $row ['language'];
				$pb = new BroadCastTimeStampNetVO ();
				$pb->setLangName ( $language );
				$pb->setTimeStamp ( $row ['time'] );
				array_push ( $_scTimeStampList, $pb );
			}
			$pb = new SCBroadCastContextNetVO ();
			$pb->setLangName ( $row ['language'] );
			$pb->setIndex ( $row ['index'] );
			$pb->setTitle ( $row ['title'] );
			$pb->setImageUrl ( $row ['image_url'] );
			$pb->setImageWidth ( $row ['image_width'] );
			$pb->setImageHeight ( $row ['image_height'] );
			$pb->setContext ( $row ['context'] );
			$pb->setLink ( $row ['link'] );
			array_push ( $_scBroadCastList, $pb );
		}
		$this->package->setScTimeStampList ( $_scTimeStampList );
		$this->package->setScBroadCastList ( $_scBroadCastList );
		$result->close ();
		echo $this->package->build ()->toString ();
	}
}
?>