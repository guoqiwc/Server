<?php
/**
 * 广播
 */
class Broadcast implements Handler {
	private $path = "http://";
	private $package;
	function __construct($bin) {
		$this->path .= $_SERVER ['HTTP_HOST'] . ':' . $_SERVER ["SERVER_PORT"] . '/Server/Resources/GetPicture.php';
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
			$time = $list [$index]->getIteration ();
			$sql .= "(`language` = '$language' AND `time` > '$time' ) OR";
		}
		$_language = $list [count ( $list ) - 1]->getLangName ();
		$_version = $list [count ( $list ) - 1]->getIteration ();
		$sql .= "(`language` = '$_language' AND `time` > '$_version' AND is_valid=1)";
		$sql .= "ORDER BY `language` DESC, `time` DESC;";
		$result = $mysql->query ( $sql );
		
		$needDeleteList = array ();
		if ($this->package->getIsDebug () != 1) {
			// 检查是否有需要删除的信息
			$list = $this->package->getCsCurrentHas ();
			// 遍历已有新闻列表
			for($index = 0; $index < count ( $list ); ++ $index) {
				$guid = $list [$index]->getGuid ();
				$sql = "SELECT id FROM t_broadcast WHERE id=$guid AND is_valid=0;";
				$result = $mysql->query ( $sql );
				if ($result->num_rows > 0) {
					$row = $result->fetch_row ();
					$needDeleteList [] = $row [0];
				}
			}
		}
		
		// 开始攒包
		$this->package = new SCResponeBroadCastMessage ();
		$_scTimeStampList = array ();
		$_scBroadCastList = array ();
		$language = "";
		for($index = 0; $index < $result->num_rows; ++ $index) {
			$row = $result->fetch_row ();
			// 递推获得最新语言的时间戳
			if ($language == "" || $language != $row [1]) {
				$language = $row [1];
				$pb = new BroadCastTimeStampNetVO ();
				$pb->setLangName ( $language );
				$pb->setIteration ( $row [3] );
				array_push ( $_scTimeStampList, $pb );
			}
			$pb = new SCBroadCastContextNetVO ();
			$pb->setGuid ( $row [0] );
			$pb->setLangName ( $row [1] );
			$pb->setIteration ( $row [3] );
			$pb->setTitle ( $row [4] );
			$pb->setImageUrl ( $this->path . $row [5] );
			$pb->setImageWidth ( $row [6] );
			$pb->setImageHeight ( $row [7] );
			$pb->setContext ( $row [8] );
			$pb->setLink ( $row [9] );
			$pb->setDate ( $row [10] );
			array_push ( $_scBroadCastList, $pb );
		}
		$this->package->setScTimeStampList ( $_scTimeStampList );
		$this->package->setScBroadCastList ( $_scBroadCastList );
		
		$_temp = array ();
		for($index = 0; $index < count ( $needDeleteList ); ++ $index) {
			$pb = new SCNeedDeleteBroadNetVO ();
			$pb->setGuid ( $needDeleteList [$index] );
			array_push ( $_temp, $pb );
		}
		$this->package->setNeedDeleteList ( $_temp );
		$result->close ();
		return $this->package->build ()->getByteArray ();
	}
}
?>