<?php
/**
 * 登出日志模块
 */
class Logout implements Handler {
	private $package;
	function __construct($package) {
		$this->package = $package;
	}
	function handle() {
		// TODO 更改
		$mac = "FF-FF-FF-FF-FF-FF";
		$login = 0; // 1为登陆 0为退出
		$ip = $_SERVER ["REMOTE_ADDR"];
		$time = ( int ) microtime ( true );
		$mysql = Mysql::getInstence ();
		if ($mysql->insert ( "INSERT INTO `t_login`(user_id,mac,ip,os,version,time,login) VALUES ('1', '$mac', '$ip', '', '', '$time', '$login');" ) != false) {
			// TODO 增加成功返回包
		} else {
		}
	}
}
?>