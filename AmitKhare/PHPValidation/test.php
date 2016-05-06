<?php
namespace AmitKhare\PHPValidation;

require(__DIR__."/validateit.php");

$v = new ValidateIt();

$v->setSource($_GET);

$v->check("username","required|string|min:4|max:10");
$v->check("email","required|email");
$v->check("firstName","required|string|max:25");
$v->check("mobile","required|numeric|min:4|max:10");

if($v->isValid()){
	echo "check pass\n\r\n\r";
}
echo "getStatus:\n\r";
print_r($v->getStatus());
echo "getSanitized:\n\r";
print_r($v->getSanitized());