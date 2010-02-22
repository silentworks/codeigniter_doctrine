<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Core
 *
 * Controls the Application Authorization and Authentication.
 *
 * @category	Controllers
 * @author  	Andrew Smith
 * @link    	http://www.silentworks.co.uk
 * @copyright	Copyright (c) 2009 - 2010, Silent Works.
 * @date		22 Feb 2010
 */
abstract class Core extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->strong->logged_in())
            redirect('auth/login');

        $this->template->app_name = $this->config->item('app_name');
    }
}
/* End of file core.php */
/* Location: ./application/controllers/core.php */