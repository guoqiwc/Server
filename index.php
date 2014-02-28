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
			$handler->handle ();
			break;
		case 40000 :
			//$handler = new LoadingPage ( $bin );
			//$handler->handle ();
			break;
		case 50000 :
			$handler = new BehaviorAllWindow ( $bin );
			$handler->handle ();
			break;
		case 50002 :
			$handler = new BehaviorMainWindow ( $bin );
			$handler->handle ();
			break;
		case 50004 :
			$handler = new SuspensionWindow ( $bin );
			$handler->handle ();
			break;
		case 50006 :
			$handler = new SettingWindow ( $bin );
			$handler->handle ();
			break;
		case 50008 :
			$handler = new AboutWindow ( $bin );
			$handler->handle ();
			break;
		case 50010 :
			$handler = new HelpWindow ( $bin );
			$handler->handle ();
			break;
		case 50012 :
			$handler = new WebshotWindow ( $bin );
			$handler->handle ();
			break;
		case 50014 :
			$handler = new Webshot ( $bin );
			$handler->handle ();
			break;
		case 60000 :
			new Broadcast ( $bin );
			break;
	}
}
?>