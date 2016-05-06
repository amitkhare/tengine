<?php
	use AmitKhare\ValidBit; // use namespace.

	require(__DIR__."/validbit.php"); // only need to include if not installed via composer.

	$v = new ValidBit(); // instantiate ValidBit;

	$v->setSource($_POST); // set data source array;

	$v->check("username","required|string|min:4|max:10");
	$v->check("email","required|email");
	$v->check("mobile","required|numeric|min:4|max:10");

	if($v->isValid()){
		echo "PASS";
	} else {
	    print_r($v->getStatus());
	}