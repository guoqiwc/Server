<?php
require "/util/Mysql.php";
require "handler/login/Login.php";
require "handler/login/Logout.php";
require "handler/error/Error.php";
interface Handler {
	// 处理函数
	function handle();
}
?>