<?php
namespace AmitKhare\PHPValidation;

require(__DIR__."/validateit.php");

$v = new ValidateIt();

$v->setSource($_GET);

$v->check($field="",$rules="required|numeric|min:2|max:5");

print_r($v->isValid());