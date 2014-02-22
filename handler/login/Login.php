<?php
/**
 * 登录日志模块
 */
class Login implements Handler {
	private $package;
	function __construct($package) {
		$this->package = $package;
	}
	function handle() {
		// TODO 更改
		$mac = "FF-FF-FF-FF-FF-FF";
		$os = "Windows 8.1 X64 企业版";
		$version = "2.1.4";
		$login = 1; // 1为登陆 0为退出
		$ip = $_SERVER ["REMOTE_ADDR"];
		$time = ( int ) microtime ( true );
		$mysql = Mysql::getInstence ();
		if ($mysql->insert ( "INSERT INTO `t_login`(user_id,mac,ip,os,version,time,login) VALUES ('1', '$mac', '$ip', '$os', '$version', '$time', '$login');" ) != false) {
			// TODO 增加成功返回包
		} else {
		}
	}
}
?>