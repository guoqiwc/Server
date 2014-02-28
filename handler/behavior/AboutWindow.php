<?php
/**
 * 关于窗口
 */
class AboutWindow implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorAboutWindowRequestMessage ( $bin );
	}
	function handle() {
		$type = $this->package->getType ();
		$mac = $this->package->getMacId ();
		$timeStamp = $this->package->getTimeStamp ();
		$state = $this->package->getState ();
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_about_window_b`(ip,mac,type,time,state) VALUES ('$ip','$mac','$type', '$timeStamp', '$state');" );
		return;
	}
}
?>