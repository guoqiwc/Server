<?php
class Error implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSErrorRequestMessage ( $bin );
	}
	function handle() {
		// TODO 更改
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$os = $this->package->getOSName ();
		$version = $this->package->getVersion ();
		$time = $this->package->getTimeStamp ();
		$message = $this->package->getErrorMessage ();
		$mysql = Mysql::getInstence ();
		if ($mysql->insert ( "INSERT INTO `t_error`(user_id,mac,ip,os,version,time,error_message) VALUES ('1', '$mac', '$ip', '$os', '$version', '$time', '$message');" ) != false) {
			return;
		} else {
		}
	}
}
?>