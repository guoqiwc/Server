<?php
/**
 * 悬浮窗行为
 */
class SuspensionWindow {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorSuspensionWindowRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$type = $this->package->getType ();
		$timeStamp = $this->package->getTimeStamp ();
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_suspension_window_b`(ip,mac,type,time) VALUES ('$ip','$mac','$type', '$timeStamp');" );
		return;
	}
}

?>