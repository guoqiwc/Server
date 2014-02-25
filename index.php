<?php
require '/handler/interfaces/Handler.php';
require "/message/Message.php";

$bt = new ByteTools ();
$string = "呵呵の";
$bt->writeLongString ( $string );
$bt->setPosition ( 0 );
echo $bt->readLongString ();

/*
 * $login = new LoadingPage ( "guolaoshi" ); $login->handle ();
 */

?>