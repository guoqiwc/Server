<?php
/**
 * 新闻
 */
class BroadcastBehavior {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorBroadCastRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$boradCastGuid = $this->package->getBoradCastGuid ();
		$timeStamp = $this->package->getTimeStamp ();
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_broadcast_b`(ip,mac,boradcast_guid,time) VALUES ('$ip','$mac','$boradCastGuid','$timeStamp');" );
		return;
	}
}
?>