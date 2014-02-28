<?php
require "/message/Message.php";
require '/handler/interfaces/Handler.php';
$bin = $_POST ["data"];
$bt = new ByteTools ( $bin );
$bt->setPosition ( 6 );
$messageId = $bt->readShort ();
switch ($messageId) {
	case 10000 :
		new Login ( $bin );
		break;
	case 10002 :
		new Logout ( $bin );
		break;
	case 20000 :
		new Error ( $bin );
		break;
	case 30000 :
		new Title ( $bin );
		break;
	case 40000 :
		new LoadingPage ( $bin );
		break;
	case 50000 :
		new BehaviorAllWindow ( $bin );
		break;
	case 50002 :
		new BehaviorMainWindow ( $bin );
		break;
	case 50004 :
		new SuspensionWindow ( $bin );
		break;
	case 50006 :
		new SettingWindow ( $bin );
		break;
	case 50008 :
		new AboutWindow ( $bin );
		break;
	case 50010 :
		new HelpWindow ( $bin );
		break;
	case 60000 :
		new Broadcast ( $bin );
		break;
}
?>