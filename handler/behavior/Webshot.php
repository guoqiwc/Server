<?php
class Webshot {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorWebshotRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$maxTaskNum = $this->package->getMaxTaskNum ();
		$timeStamp = $this->package->getTimeStamp ();
		$mysql = Mysql::getInstence ();
		$mysql->insert ( "INSERT INTO `t_webshot_b`(ip,mac,max_task_num,time) VALUES ('$ip','$mac','$maxTaskNum','$timeStamp');" );
		return;
	}
}

?>