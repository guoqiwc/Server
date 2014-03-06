<?php
if ($_GET == null || $_GET["name"] == null) {
	return;
}
header ( "Content-type: image/jpeg" );
readfile ( $_GET ["name"] );
?>