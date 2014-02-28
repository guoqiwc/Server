<?php
/**
 * 登录日志模块
 */
class Login implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSLoginRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$os = $this->package->getOSName ();
		$version = $this->package->getVersion ();
		$time = $this->package->getTimeStamp ();
		settype ( $time, "float" );
		$login = 1; // 1为登陆 0为退出
		
		$mysql = Mysql::getInstence ();
		if ($mysql->insert ( "INSERT INTO `t_login`(user_id,mac,ip,os,version,time,login) VALUES ('1', '$mac', '$ip', '$os', '$version', '$time', '$login');" ) != false) {
			return;
		} else {
		}
	}
}
?>