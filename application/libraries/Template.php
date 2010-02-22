<?php defined('BASEPATH') or die('No direct script access.');
/**
 * Template
 *
 * Templating system architecture for Application.
 *
 * @license 	MIT Licence
 * @category	Libraries
 * @author  	Andrew Smith
 * @link    	http://www.silentworks.co.uk
 * @copyright	Copyright (c) 2008 - 2009, Silent Works.
 * @date		23 Dec 2008
 */
class Template extends MY_Controller
{
    public $template;
    
    var $local_data;
    var $obj;

    public function __construct($template = "template")
    {
        $this->obj =& get_instance();
        $this->template = $template;
    }

    public function __set($key, $value)
    {
        $this->local_data[$key] = $value;
    }

    public function template($template)
    {
      $this->template = $template;
    }
    
    public function viv($view, $data = NULL)
    {
    	return $this->obj->load->view($view, $data, TRUE);
    }

    public function view($view, $data = NULL, $return = FALSE, $container = 'content_for_layout')
    {
    	if (!isset($this->local_data[$container])) {
			$this->local_data[$container] = $this->obj->load->view($view, $data, TRUE);
		} else
            $this->local_data[$container] .= $this->obj->load->view($view, $data, TRUE);

        if($return)
        {
            $output = $this->obj->load->view($this->template, $this->local_data, TRUE);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->template, $this->local_data, FALSE);
        }
    }
}
/* End of file Template.php */
/* Location: ./application/libraries/Template.php */