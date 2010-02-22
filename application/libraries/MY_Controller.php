<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
 
/* autoload controllers */
spl_autoload_register('my_controller::autoload');

class MY_Controller extends Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	/** Library base class autoload **/
	public static function autoload($class)
	{
		// Change class name to lowercase
		$class = strtolower($class);
 
		/* autoload application controllers */	
		if(is_file($location = APPPATH.'controllers/'.$class.EXT)) {
			include_once $location;
		}
	}
}