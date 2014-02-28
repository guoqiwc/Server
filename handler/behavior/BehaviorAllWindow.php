<?php
/**
 * 主界面行为
 */
class BehaviorAllWindow {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$type = $this->package->getType ();
		$state = $this->package->getDuration ();
		$timeStamp = $this->package->getTimeStamp ();
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_all_window_b`(ip,mac,type,duration,time) VALUES ('$ip','$mac','$type', $state,'$timeStamp');" );
		return;
	}
}
?>