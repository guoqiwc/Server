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
		if (count ( $this->byteArray ) <= $position) {
			for($i = 0; i < $position - count ( $this->byteArray ) + 1; ++ $i) {
				$this->byteArray [] = 0x00;
			}
		}
		$this->position = $position;
	}
	public function writeByte($byte) {
		$this->byteArray [$this->position] = (0xff & $byte);
		$this->position += 1;
	}
	public function readByte() {
		$byte = $this->byteArray [$this->position] & 0xFF;
		$this->position += 1;
		return $byte;
	}
	public function writeShort($short) {
		$this->byteArray [$this->position] = (0xff & $short);
		$this->byteArray [$this->position + 1] = (0xff00 & $short) >> 8;
		$this->position += 2;
	}
	public function readShort() {
		$short = $this->byteArray [$this->position] & 0xFF;
		$short |= (($this->byteArray [$this->position + 1] << 8) & 0xFF00);
		$this->position += 2;
		return $short;
	}
	public function writeInt($int) {
		$this->byteArray [$this->position] = (0xFF & $int);
		$this->byteArray [$this->position + 1] = (0xFF00 & $int) >> 8;
		$this->byteArray [$this->position + 2] = (0xFF0000 & $int) >> 16;
		$this->byteArray [$this->position + 3] = (0xFF000000 & $int) >> 24;
		$this->position += 4;
	}
	public function readInt() {
		$int = $this->byteArray [$this->position] & 0xFF;
		$int |= (($this->byteArray [$this->position + 1] << 8) & 0xFF00);
		$int |= (($this->byteArray [$this->position + 2] << 16) & 0xFF0000);
		$int |= (($this->byteArray [$this->position + 3] << 24) & 0xFF000000);
		$this->position += 4;
		return $int;
	}
	public function writeLongString($string) {
		$length = strlen ( $string );
		$this->writeShort ( $length );
		for($index = 0; $index < $length; ++ $index) {
			$this->byteArray [$this->position ++] = ord ( $string [$index] ); // >= 128 ? ord ( $string [$index] ) - 256 : ord ( $string [$index] );
		}
	}
	public function readLongString() {
		$length = $this->readShort ();
		$str = '';
		for($index = 0; $index < $length; ++ $index) {
			$str .= chr ( $this->byteArray [$this->position ++] );
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