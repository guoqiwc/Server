<?php
class UserBehavior implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$os = "";
		$version = "";
		$time = $this->package->getLogOffTimeStamp ();
		$login = 0; // 1为登陆 0为退出
		$mysql = Mysql::getInstence ();
		
		// 1.检查是否为重复提交的数据
		$sql = "SELECT * FROM t_login WHERE mac = '$mac' AND time = '$time' AND login = 0;";
		$result = $mysql->query ( $sql );
		if ($result->num_rows > 0) {
			// 开始攒包
			$this->package = new SCUserBehaviorRequestMessage ();
			$this->package->setIsSuccess ( 1 );
			echo $this->package->build ()->getByteArray ();
			return;
		}
	}
}

?>