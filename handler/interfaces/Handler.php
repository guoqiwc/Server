<?php
require "util/Mysql.php";
require "handler/login/Login.php";
require "handler/login/Logout.php";
require "handler/error/Error.php";
require "handler/word/Title.php";
require "handler/word/LoadingPage.php";
require "handler/broadcast/Broadcast.php";
require "handler/behavior/HelpWindow.php";
require "handler/behavior/AboutWindow.php";
require "handler/behavior/SettingWindow.php";
require "handler/behavior/SuspensionWindow.php";
require "handler/behavior/BehaviorMainWindow.php";
require "handler/behavior/BehaviorAllWindow.php";
require "handler/behavior/WebshotWindow.php";
require "handler/behavior/Webshot.php";
interface Handler {
	// 处理函数
	function handle();
}
?>