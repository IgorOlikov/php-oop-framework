<?php

require_once dirname(__DIR__).'/vendor/autoload.php';
//require_once __DIR__.'/../vendor/autoload.php';



use Framework\Http\Request;


$aaa = new Request();
//$bbb = new TestClass();

phpinfo();

dd(dirname(__DIR__).'/vendor/autoload.php');
//dd($bbb->test());
dd($aaa->createFromGlobals());

