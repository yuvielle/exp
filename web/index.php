<?php
require_once (realpath(dirname(__FILE__) . '/../lib/dispather.php'));

$test=new Dispatcher();//new dispatcher object
$test->getContent();//get content of the requested page