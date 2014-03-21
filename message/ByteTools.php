<?php
/**
 * 协议解析工具
 */
class ByteTools {
	private $byteArray = array ();
	private $position = 0;
	function __construct($bin = null) {
		if ($bin != null) {
			$this->byteArray = str_split ( $bin );
		}
	}
	function get($index) {
		$value = $this->byteArray [$index];
		$data = unpack ( "c", $value );
		return $data [1];
	}
	function set($index, $value) {
		$val = intval ( $value );
		$this->byteArray [$index] = ($val & 0xff);
	}
	function getLength() {
		return count ( $this->byteArray );
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
		$value = $this->byteArray [$this->position];
		$data = unpack ( "c", $value );
		$this->position += 1;
		return $data [1];
	}
	function readShort() {
		$value = $this->byteArray [$this->position] . $this->byteArray [$this->position + 1];
		$data = unpack ( "s", $value );
		$this->position += 2;
		return $data [1];
	}
	function readInt() {
		$value = $this->byteArray [$this->position] . $this->byteArray [$this->position + 1] . $this->byteArray [$this->position + 2] . $this->byteArray [$this->position + 3];
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
	function readString($length) {
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
	function writeString($length, $string) {
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