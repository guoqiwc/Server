<?php
class UserBehavior implements Handler {
	private $package;
	function __construct($bin) {
		$this->package = new CSUserBehaviorRequestMessage ( $bin );
	}
	function handle() {
	}
}

?>