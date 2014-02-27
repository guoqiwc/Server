<?php
/**
 * 广播
 */
class Broadcast {
	private $package;
	function __construct($bin) {
		$this->package = new CSRequestBroadCastMessage($bin);
	}
	function handle() {
		
	
	}
}

?>