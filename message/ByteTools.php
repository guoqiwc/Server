<?php
/**
 * 协议解析工具
 */
class ByteTools {
	private $byteArray = array ();
	private $position = 0;
	function __construct($bin = null) {
		if ($bin != null) {
			$this->byteArray = substr ( $bin, 0, strlen ( $bin ) );
		}
	}
	function setPosition($position) {
		$count = count ( $this->byteArray );
		if ($count < $position) {
			for($index = $count; $index < $position; $index ++) {
				$this->byteArray [] = 0x00;
			}
		}
		$this->position = $position;
	}
	function readByte() {
		$value = substr ( $this->byteArray, $this->position, 1 );
		$data = unpack ( "c", $value );
		$this->position += 1;
		return $data [1];
	}
	function readShort() {
		$value = substr ( $this->byteArray, $this->position, 2 );
		$data = unpack ( "s", $value );
		$this->position += 2;
		return $data [1];
	}
	function readInt() {
		$value = substr ( $this->byteArray, $this->position, 4 );
		$data = unpack ( "l", $value );
		$this->position += 4;
		return $data [1];
	}
	function readLongString() {
		$length = $this->readShort ();
		$str = "";
		for($index = 0; $index < $length; ++ $index) {
			$str .= ($this->byteArray [$this->position ++]);
		}
		return $str;
	}
	function writeByte($value) {
		$val = intval ( $value );
		$this->byteArray [$this->position ++] = ($val & 0xff);
	}
	function writeShort($value) {
		$val = intval ( $value );
		$this->byteArray [$this->position ++] = ($val & 0xff);
		$this->byteArray [$this->position ++] = ($val >> 8 & 0xff);
	}
	function writeInt($value) {
		$val = ( int ) $value;
		$this->byteArray [$this->position ++] = ($val & 0xff);
		$this->byteArray [$this->position ++] = ($val >> 8 & 0xff);
		$this->byteArray [$this->position ++] = ($val >> 16 & 0xFF);
		$this->byteArray [$this->position ++] = ($val >> 24 & 0xff);
	}
	function writeLongString($string) {
		$length = strlen ( $string );
		$this->writeShort ( $length );
		for($index = 0; $index < $length; ++ $index) {
			$this->byteArray [$this->position ++] = ord ( $string [$index] );
		}
	}
	function getByteArray() {
		$string = "";
		foreach ( $this->byteArray as $chr ) {
			$string .= chr ( $chr );
		}
		return $string;
	}
}
?>