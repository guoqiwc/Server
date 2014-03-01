<?php
require "/message/Message.php";
require '/handler/interfaces/Handler.php';
$bin = file_get_contents ( "php://input" );
if ($bin == null || $bin == "") {
} else {
	$messageByte = substr ( $bin, 6, 2 );
	$data = unpack ( "s", $messageByte );
	switch ($data[1]) {
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
			$handler->handle ();
			break;
		case 4000 :
			$handler = new LoadingPage ( $bin );
			$handler->handle ();
			break;
		case 5000 :
			$handler = new BehaviorAllWindow ( $bin );
			$handler->handle ();
			break;
		case 5002 :
			$handler = new BehaviorMainWindow ( $bin );
			$handler->handle ();
			break;
		case 5004 :
			$handler = new SuspensionWindow ( $bin );
			$handler->handle ();
			break;
		case 5006 :
			$handler = new SettingWindow ( $bin );
			$handler->handle ();
			break;
		case 5008 :
			$handler = new AboutWindow ( $bin );
			$handler->handle ();
			break;
		case 5010 :
			$handler = new HelpWindow ( $bin );
			$handler->handle ();
			break;
		case 5012 :
			$handler = new WebshotWindow ( $bin );
			$handler->handle ();
			break;
		case 5014 :
			$handler = new Webshot ( $bin );
			$handler->handle ();
			break;
		case 6000 :
			new Broadcast ( $bin );
			break;
	}
}
?>