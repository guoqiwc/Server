<?php
class Error implements Handler {
	private $package;
	function __construct($package) {
		$this->package = $package;
	}
	function handle() {
		// TODO 更改
		$mac = "FF-FF-FF-FF-FF-FF";
		$os = "Windows 8.1 X64 企业版";
		$version = "2.1.4";
		$ip = $_SERVER ["REMOTE_ADDR"];
		$time = ( int ) microtime ( true );
		$message = "启动错误！";
		$mysql = Mysql::getInstence ();
		if ($mysql->insert ( "INSERT INTO `t_error`(user_id,mac,ip,os,version,time,error_message) VALUES ('1', '$mac', '$ip', '$os', '$version', '$time', '$message');" ) != false) {
			// TODO 增加成功返回包
		} else {
		}
	}
}
?>