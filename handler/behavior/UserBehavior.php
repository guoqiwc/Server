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
		$sql = "";
		// TODO 2.所有窗口行为
		$list = $this->package->getDurationList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$type = $list [$index]->getType ();
			$duration = $list [$index]->getDuration ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_all_window_b` (ip,mac,type,duration,time) VALUES ('$ip','$mac','$type',$duration,'$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 3.主界面用户行为采集
		$list = $this->package->getMainWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$type = $list [$index]->getType ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_main_window_b`(ip,mac,type,time) VALUES ('$ip','$mac','$type', '$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 4.悬浮窗用户行为采集
		$list = $this->package->getSuspensionWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$type = $list [$index]->getType ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_suspension_window_b`(ip,mac,type,time) VALUES ('$ip','$mac','$type', '$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 5.设置面板用户行为采集
		$list = $this->package->getSettingWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$timeStamp = $list [$index]->getTimeStamp ();
			$launchAfterBoot = $list [$index]->getLaunchAfterBoot ();
			$defaultPath = $list [$index]->getDefaultPath ();
			$colorType = $list [$index]->getColorType ();
			$language = $list [$index]->getLanguage ();
			$loadOverTime = $list [$index]->getLoadOverTime ();
			$loadRefreshTime = $list [$index]->getLoadRefreshTime ();
			$colorBeeLevel = $list [$index]->getColorBeeLevel ();
			$colorBeeSize = $list [$index]->getColorBeeSize ();
			$paletteHueLevel = $list [$index]->getPaletteHueLevel ();
			$paletteSaturationLevel = $list [$index]->getPaletteSaturationLevel ();
			$paletteBrightnessLevel = $list [$index]->getPaletteBrightnessLevel ();
			$isChangedDefaultPath = $list [$index]->getIsChangedDefaultPath ();
			$sql = "INSERT INTO `t_setting_window_b`(ip,mac,time,launch_after_boot,default_path,color_type,language,load_over_time,load_refresh_time,color_bee_level,color_bee_size,palette_hue_level,palette_saturation_level,palette_brightness_level,is_changed_default_path) VALUES ('$ip','$mac','$timeStamp','$launchAfterBoot','$defaultPath' , '$colorType','$language','$loadOverTime','$loadRefreshTime','$colorBeeLevel','$colorBeeSize','$paletteHueLevel','$paletteSaturationLevel','$paletteBrightnessLevel','$isChangedDefaultPath');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 6.关于
		$list = $this->package->getAboutWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$type = $list [$index]->getType ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$state = $list [$index]->getState ();
			$sql = "INSERT INTO `t_about_window_b`(ip,mac,type,time,state) VALUES ('$ip','$mac','$type', '$timeStamp', '$state');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 7.帮助页面用户行为采集
		$list = $this->package->getHelpWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$checkLaunch = $list [$index]->getCheckLaunch ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$holdTime = $list [$index]->getHoldTime ();
			$sql = "INSERT INTO `t_help_window_b`(ip,mac,check_lanuch,time,hold_time_list) VALUES ('$ip','$mac','$checkLaunch', '$timeStamp', '$holdTime');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 8.网页截图窗体用户行为采集
		$list = $this->package->getWebshotWindowList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$type = $list [$index]->getType ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_webshot_window_b`(ip,mac,type,time) VALUES ('$ip','$mac','$type','$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 9.网页截图用户行为采集
		$list = $this->package->getWebshotList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$maxTaskNum = $list [$index]->getMaxTaskNum ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_webshot_b`(ip,mac,max_task_num,time) VALUES ('$ip','$mac','$maxTaskNum','$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		// TODO 10.广播
		$list = $this->package->getBroadCastList ();
		for($index = 0; $index < count ( $list ); ++ $index) {
			$boradCastGuid = $list [$index]->getBoradCastGuid ();
			$timeStamp = $list [$index]->getTimeStamp ();
			$sql = "INSERT INTO `t_broadcast_b`(ip,mac,boradcast_guid,time) VALUES ('$ip','$mac','$boradCastGuid','$timeStamp');";
			$mysql->insert ( $sql );
		}
		$sql = "";
		$this->package = new SCUserBehaviorRequestMessage ();
		$this->package->setIsSuccess ( 1 );
		echo $this->package->build ()->getByteArray ();
		return;
	}
}
?>