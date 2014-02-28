<?php
/**
 * 关于窗口
 */
class SettingWindow implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorSettingWindowRequestMessage ( $bin );
	}
	function handle() {
		$ip = $_SERVER ["REMOTE_ADDR"];
		$mac = $this->package->getMacId ();
		$timeStamp = $this->package->getTimeStamp ();
		$launchAfterBoot = $this->package->getLaunchAfterBoot ();
		$defaultPath = $this->package->getDefaultPath ();
		$colorType = $this->package->getColorType ();
		$language = $this->package->getLanguage ();
		$loadOverTime = $this->package->getLoadOverTime ();
		$loadRefreshTime = $this->package->getLoadRefreshTime ();
		$colorBeeLevel = $this->package->getColorBeeLevel ();
		$colorBeeSize = $this->package->getColorBeeSize ();
		$paletteHueLevel = $this->package->getPaletteHueLevel ();
		$paletteSaturationLevel = $this->package->getPaletteSaturationLevel ();
		$paletteBrightnessLevel = $this->package->getPaletteBrightnessLevel ();
		$mysql = Mysql::getInstence ();
		$sql = "INSERT INTO `t_setting_window_b`(ip,mac,time,launch_after_boot,default_path,color_type,language,load_over_time,load_refresh_time,color_bee_level,color_bee_size,palette_hue_level,palette_saturation_level,palette_brightness_level) VALUES ('$ip','$mac','$timeStamp','$launchAfterBoot','$defaultPath' , '$colorType','$language','$loadOverTime','$loadRefreshTime','$colorBeeLevel','$colorBeeSize','$paletteHueLevel','$paletteSaturationLevel','$paletteBrightnessLevel');";
		$mysql->insert ( $sql );
		return;
	}
}
?>