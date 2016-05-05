<?php
namespace AmitKhare\PHPValidation;

class ValidateIt {

	private $code;
	private $msgs;
	private $source;

	function __construct(){
		$this->msgs = array();
		$this->code = 200;
	}
	
	public function setSource($source){
		$this->source;
	}

	public function check($field="",$rules="required|numeric|min:2|max:5"){
		if(!isset($this->source[$field]) || $this->source[$field]==""){
			$this->setStatus(500,$this->readable($field));
		}
	}

	private function  _fetchRules($rules){
		$rules = explode("|", $rules);
		switch($rules){
                case 'email':
                    $this->validateEmail($var, $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeEmail($var);
                    }
                    break;

                case 'url':
                    $this->validateUrl($var);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeUrl($var);
                    }
                    break;

                case 'numeric':
                    $this->validateNumeric($var, $opt['min'], $opt['max'], $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeNumeric($var);
                    }
                    break;

                case 'string':
                    $this->validateString($var, $opt['min'], $opt['max'], $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeString($var);
                    }
                break;

                case 'float':
                    $this->validateFloat($var, $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeFloat($var);
                    }
                    break;

                case 'ipv4':
                    $this->validateIpv4($var, $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeIpv4($var);
                    }
                    break;

                case 'ipv6':
                    $this->validateIpv6($var, $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitizeIpv6($var);
                    }
                    break;

                case 'bool':
                    $this->validateBool($var, $opt['required']);
                    if(!array_key_exists($var, $this->errors))
                    {
                        $this->sanitized[$var] = (bool) $this->source[$var];
                    }
                    break;
            }
	}

	private function readable($field){
		$str = "The '".$field."' field is not set.";
		return $str;
	}

	public function setStatus($code,$msg){
			$this->code=$code;
			$this->msgs[]=$msg;
	}

	public function isValid(){
		if($this->code===200){
			return true;
		}
		return false;
	}

	public function getStatus(){
		$status = array(
				"code"=>$this->code,
				"msgs"=>$this->msgs
			);
		return $status;
	}
	static function makeStatus($code=200,$msg="ok"){
		return array("code"=>$code,"msgs"=>array($msg));
	}

	static function ifSet($data=array(),$field="",$default=0){
		if(isset($data[$field])){
			return $field;
		}
		return $default;
	}

	/**
     *
     * @Check if POST variable is set
     *
     * @access private
     *
     * @param string $var The POST variable to check
     *
     */
    private function is_set($var)
    {
        if(!isset($this->source[$var]))
        {
            
            $mssg = $var . ' is not set';
            $this->setStatus(500,$mssg);
        }
    }



    /**
     *
     * @validate an ipv4 IP address
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    private function validateIpv4($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        if(filter_var($this->source[$var], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === FALSE)
        {
            
            $mssg = $var . ' is not a valid IPv4';
            $this->setStatus(500,$mssg);
        }
    }

    /**
     *
     * @validate an ipv6 IP address
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    public function validateIpv6($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }

        if(filter_var($this->source[$var], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === FALSE)
        {
            
            $mssg = $var . ' is not a valid IPv6';
            $this->setStatus(500,$mssg);
        }
    }

    /**
     *
     * @validate a floating point number
     *
     * @access private
     *
     * @param $var The variable name
     *
     * @param bool $required
     */
    private function validateFloat($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        if(filter_var($this->source[$var], FILTER_VALIDATE_FLOAT) === false)
        {
            
            $mssg = $var . ' is an invalid float';
            $this->setStatus(500,$mssg);
        }
    }

    /**
     *
     * @validate a string
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param int $min the minimum string length
     *
     * @param int $max The maximum string length
     *
     * @param bool $required
     *
     */
    private function validateString($var, $min=0, $max=0, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }

        if(isset($this->source[$var]))
        {
            if(strlen($this->source[$var]) < $min)
            {
                
                $mssg = $var . ' is too short';
            }
            elseif(strlen($this->source[$var]) > $max)
            {
                
                $mssg = $var . ' is too long';
            }
            elseif(!is_string($this->source[$var]))
            {
                
                $mssg = $var . ' is invalid';
            }
        }
    }

    /**
     *
     * @validate an number
     *
     * @access private
     *
     * @param string $var the variable name
     *
     * @param int $min The minimum number range
     *
     * @param int $max The maximum number range
     *
     * @param bool $required
     *
     */
    private function validateNumeric($var, $min=0, $max=0, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        if(filter_var($this->source[$var], FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))===FALSE)
        {
            
            $mssg = $var . ' is an invalid number';
            $this->setStatus(500,$mssg);
        }
    }

    /**
     *
     * @validate a url
     *
     * @access private
     *
      * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    private function validateUrl($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        if(filter_var($this->source[$var], FILTER_VALIDATE_URL) === FALSE)
        {
            
            $mssg = $var . ' is not a valid URL';
            $this->setStatus(500,$mssg);
        }
    }


    /**
     *
     * @validate an email address
     *
     * @access private
     *
     * @param string $var The variable name 
     *
     * @param bool $required
     *
     */
    private function validateEmail($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        if(filter_var($this->source[$var], FILTER_VALIDATE_EMAIL) === FALSE)
        {
            
            $mssg = $var . ' is not a valid email address';
            $this->setStatus(500,$mssg);
        }
    }


    /**
     * @validate a boolean 
     *
     * @access private
     *
     * @param string $var the variable name
     *
     * @param bool $required
     *
     */
    private function validateBool($var, $required=false)
    {
        if($required==false && strlen($this->source[$var]) == 0)
        {
            return true;
        }
        filter_var($this->source[$var], FILTER_VALIDATE_BOOLEAN);
        {
            
            $mssg = $var . ' is Invalid';
            $this->setStatus(500,$mssg);
        }
    }
}