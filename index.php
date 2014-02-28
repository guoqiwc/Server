<?php
require "/message/Message.php";
require '/handler/interfaces/Handler.php';
$bin = file_get_contents ( "php://input" );
if ($bin == null || $bin == "") {
} else {
	$bt = new ByteTools ( $bin );
	$bt->setPosition ( 6 );
	$messageId = $bt->readShort ();
	switch ($messageId) {
		case 10000 :
			$handler = new Login ( $bin );
			// $handler->handle ();
			break;
		case 10002 :
			$handler = new Logout ( $bin );
			// $handler->handle ();
			break;
		case 20000 :
			$handler = new Error ( $bin );
			// $handler->handle ();
			break;
		case 30000 :
			$handler = new Title ( $bin );
			// $handler->handle ();
			break;
		case 40000 :
			new LoadingPage ( $bin );
			break;
		case 50000 :
			$handler = new BehaviorAllWindow ( $bin );
			$handler->handle ();
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
			$handler = new HelpWindow ( $bin );
			$handler->handle ();
			break;
		case 50012 :
			new WebshotWindow ( $bin );
			break;
		case 50014 :
			new Webshot ( $bin );
			break;
		case 60000 :
			new Broadcast ( $bin );
			break;
	}
}
?>