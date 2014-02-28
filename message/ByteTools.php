<?php
/**
 * 协议解析工具
 */
class ByteTools {
	private $byteArray = array ();
	private $position = 0;
	public function __construct($bin = null) {
		$this->byteArray = ($bin == null ? array () : $bin);
	}
	public function setPosition($position) {
		/*
		 * if (count ( $this->byteArray ) <= $position) { for($i = 0; $i < $position - count ( $this->byteArray ) + 1; ++ $i) { array_push ( $this->byteArray, "" ); } }
		 */
		$this->position = $position;
	}
	public function writeByte($byte) {
		$this->byteArray [$this->position] = (0xff & $byte);
		$this->position += 1;
	}
	public function readByte() {
		$byte = $this->byteArray [$this->position];
		$this->position += 1;
		var_dump ( unpack ( "H*", $byte ) );
		$byte = unpack ( "H*", $byte );
		var_dump ( $byte [1] );
		return intval ( $byte [1], 16 );
	}
	public function writeShort($short) {
		$this->byteArray [$this->position] = (0xff & $short);
		$this->byteArray [$this->position + 1] = (0xff00 & $short) >> 8;
		$this->position += 2;
	}
	public function readShort() {
		$str = substr ( $this->byteArray, $this->position, $this->position + 2 );
		$short = unpack ( "S", $str );
		$this->position += 2;
		return $short [1];
	}
	public function writeInt($int) {
		$this->byteArray [$this->position] = (0xFF & $int);
		$this->byteArray [$this->position + 1] = (0xFF00 & $int) >> 8;
		$this->byteArray [$this->position + 2] = (0xFF0000 & $int) >> 16;
		$this->byteArray [$this->position + 3] = (0xFF000000 & $int) >> 24;
		$this->position += 4;
	}
	public function readInt() {
		$str = substr ( $this->byteArray, $this->position, $this->position + 4 );
		$int = unpack ( "i", $str );
		$this->position += 4;
		return $int [1];
	}
	public function writeLongString($string) {
		$length = strlen ( $string );
		$this->writeShort ( $length );
		for($index = 0; $index < $length; ++ $index) {
			$this->byteArray [$this->position ++] = $string [$index]; // >= 128 ? ord ( $string [$index] ) - 256 : ord ( $string [$index] );
		}
	}
	public function readLongString() {
		$length = $this->readShort ();
		$str = "";
		for($index = 0; $index < $length; ++ $index) {
			$str .= ($this->byteArray [$this->position ++]); // >= 128 ? ord ( $string [$index] ) - 256 : ord ( $string [$index] );
		}
		return $str;
	}
	public function toString() {
		$str = "";
		for($index = 0; $index < count ( $this->byteArray ); ++ $index) {
			$str .= $this->byteArray [$index];
		}
		return $str;
	}
}
?>