<?php
/**
 * 登出日志模块
 */
class Logout implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSLogoffRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$os = "";
		$version = "";
		$time = $this->package->getTimeStamp ();
		$login = 0; // 1为登陆 0为退出
		$mysql = Mysql::getInstence ();
		if ($this->package->getIsPrevious () == 1) {
			$sql = "SELECT * FROM t_login WHERE mac = $mac AND time = $time AND login = 0;";
			$result = $mysql->query ( $sql );
			if ($result->num_rows > 0) {
				return;
			}
		}
		// 本次记录数据
		$mysql->insert ( "INSERT INTO `t_login`(user_id,mac,ip,os,version,time,login) VALUES ('1', '$mac', '$ip', '', '', '$time', '$login');" );
		$list = $this->package->getUserBehaviorCloseList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$ip = $_SERVER ["REMOTE_ADDR"];
			$mac = $this->package->getMacId ();
			$type = $list [$index]->getType ();
			$state = $list [$index]->getDuration ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$mysql->insert ( "INSERT INTO `t_all_window_b`(ip,mac,type,duration,time) VALUES ('$ip','$mac','$type', $state,'$timeStamp');" );
		}
		return;
	}
}
?>