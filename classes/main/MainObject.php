<?php




class MainObject{
	public function __construct(){
		$a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        } 
	}

	public function get($property_name){
		if(property_exists($this, $property_name))
			return $this->$property_name; //return $$propertyname
		return null;
	}
}
