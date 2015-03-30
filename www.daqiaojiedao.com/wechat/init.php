<?php
require_once "config.php";

if ($config['DEFAULT_MODEL'] != "SIMPLE"){
	exit;
}

require_once "wechat.class.php";

$wechat = new Wechat();
