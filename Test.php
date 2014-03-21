<?php
require 'message/ByteTools.php';
$filename = "configure_1.dat";
$handle = fopen ( $filename, "rb" ); // 读取二进制文件时，需要将第二个参数设置成'rb'
                                     
// 通过filesize获得文件大小，将整个文件一下子读到一个字符串中
$contents = fread ( $handle, filesize ( $filename ) );
$en = new EncryptUtil ();
$contents = $en->encrypt ( $contents, EncryptUtil::$password );
$contents = $en->decrypt ( $contents, EncryptUtil::$password );
fclose ( $handle );

?>