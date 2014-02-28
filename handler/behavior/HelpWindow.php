<?php
/**
 * 帮助窗口
 */
class HelpWindow implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorHelpWindowRequestMessage ( $bin );
	}
	function handle() {
		$checkLaunch = $this->package->getCheckLaunch ();
		$timeStamp = $this->package->getTimeStamp ();
		$mac = $this->package->getMacId ();
		$ip = $_SERVER ["REMOTE_ADDR"];
		$str = "";
		$list = $this->package->getHoldTimeList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$str .= $list [$index]->getHoldTime () . "&";
		}
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_help_window_b`(ip,mac,check_lanuch,time,hold_time_list) VALUES ('$ip','$mac','$checkLaunch', '$timeStamp', '$str');" );
		return;
	}
}
?>