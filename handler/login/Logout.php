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
		if ($mysql->insert ( "INSERT INTO `t_login`(user_id,mac,ip,os,version,time,login) VALUES ('1', '$mac', '$ip', '', '', '$time', '$login');" ) != false) {
			// TODO 增加成功返回包
			return;
		} else {
		}
	}
}
?>