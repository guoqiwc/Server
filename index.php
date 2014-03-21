<?php
interface Handler {
	// 处理函数
	function handle();
}
require "message/Message.php";
require "util/Mysql.php";

require "handler/behavior/UserBehavior.php";
require "handler/login/Login.php";
require "handler/login/Logout.php";
require "handler/error/Error.php";
require "handler/word/Title.php";
require "handler/word/LoadingPage.php";
require "handler/broadcast/Broadcast.php";
// require "Resources/GetPicture.php";
$bin = file_get_contents ( "php://input" );
$en = new EncryptUtil ();
$bin = $en->decrypt ( $bin, EncryptUtil::$password );
if ($bin == null || $bin == "") {
} else {
	$messageByte = substr ( $bin, 6, 2 );
	$data = unpack ( "s", $messageByte );
	switch ($data [1]) {
		case 1000 :
			$handler = new Login ( $bin );
			$handler->handle ();
			break;
		case 1002 :
			$handler = new Logout ( $bin );
			$handler->handle ();
			break;
		case 2000 :
			$handler = new Error ( $bin );
			$handler->handle ();
			break;
		case 3000 :
			$handler = new Title ( $bin );
			echo $en->encrypt ( $handler->handle (), EncryptUtil::$password );
			break;
		case 4000 :
			$handler = new LoadingPage ( $bin );
			echo $en->encrypt ( $handler->handle (), EncryptUtil::$password );
			break;
		case 5000 :
			$handler = new UserBehavior ( $bin );
			echo $en->encrypt ( $handler->handle (), EncryptUtil::$password );
			break;
		case 6000 :
			$handler = new Broadcast ( $bin );
			echo $en->encrypt ( $handler->handle (), EncryptUtil::$password );
			break;
	}
}
class EncryptUtil {
	/**
	 * 文件头
	 */
	private $head = "0000000";
	/**
	 * 密码
	 */
	public static $password = "901230";
	
	/**
	 * 加密函数
	 */
	function encrypt($byteString, $passWord, $precision = 1) {
		$isHasEncode = false;
		$bt = new ByteTools ( $byteString );
		if ($bt->getLength () >= 10) {
			$bt->setPosition ( 0 );
			$byte = $bt->readByte ();
			$headTemp = $bt->readString ( 7 );
			if ($headTemp == $this->head && $byte == 0) {
				$isHasEncode = true;
			} else {
				$isHasEncode = false;
			}
		}
		$bt->setPosition ( 0 );
		if ($isHasEncode == true) 		// 如果已经被加密过了，则不进行加密
		{
			return $byteString;
		} else {
			$key = new ByteTools ( $passWord );
			$index = 0;
			for($i = 0; $i < $bt->getLength (); $i += $precision) {
				$bt->set ( $i, $bt->get ( $i ) ^ $key->get ( $index % $key->getLength () ) );
				++ $index;
			}
			$bt->setPosition ( 0 );
			$result = new ByteTools ();
			$result->setPosition ( 0 );
			$result->writeByte ( 0 );
			$result->writeString ( 7, $this->head );
			$result->writeShort ( $precision );
			return $result->getByteArray () . $bt->getByteArray ();
		}
	}
	
	/**
	 * 揭秘函数
	 *
	 * @return string
	 */
	function decrypt($byteString, $passWord) {
		$isHasEncode = false;
		$precision = 0;
		$bt = new ByteTools ( $byteString );
		if ($bt->getLength () >= 10) {
			$bt->setPosition ( 0 );
			$byte = $bt->readByte ();
			$headTemp = $bt->readString ( 7 );
			$precision = $bt->readShort ();
			if ($headTemp == $this->head && $byte == 0) {
				$isHasEncode = true;
			} else {
				$isHasEncode = false;
			}
		}
		$bt->setPosition ( 0 );
		if ($isHasEncode == false) 		// 如果没有被加密过，则返回传入字节数组
		{
			return $byteString;
		} else {
			$result = new ByteTools ( substr ( $byteString, 10, strlen ( $byteString ) - 10 ) );
			$key = new ByteTools ( $passWord );
			$index = 0;
			for($i = 0; $i < $result->getLength (); $i += $precision) {
				$result->set ( $i, $result->get ( $i ) ^ $key->get ( $index % $key->getLength () ) );
				++ $index;
			}
		}
		return $result->getByteArray ();
	}
}
?>