# amitkhare/validology
Validology is an easy to use PHP validation library

## Install

Run this command from the directory in which you want to install.

Via Composer:

    php composer.phar require amitkhare/validology

Via Git:

    git clone https://github.com/amitkhare/validology.git

Manual Install:

    Download: https://github.com/amitkhare/validology/archive/master.zip
    Extract it, require "PATH-TO/"."validology.php" where you want to use it.

Usage:
    
    <?php
        use AmitKhare\Validology;
        
        require("PATH-TO/"."validology.php"); // only need to include if installed manually.
        
        $v = new Validology();
        
        $v->setSource($_POST);
        
        $v->check("username","required|string|min:4|max:10");
        $v->check("email","required|email");
        $v->check("mobile","required|numeric|min:4|max:10");
        
        if($v->isValid()){
        	echo "PASS";
        } else {
            print_r($v->getStatus());
        }
