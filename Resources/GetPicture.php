<?php
echo 'http://' . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"];
if ($_GET == null || $_GET["name"] == null) {
	return;
}
header ( "Content-type: image/jpeg" );
readfile ( $_GET ["name"] );
?>