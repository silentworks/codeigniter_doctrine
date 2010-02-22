<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extended Form Validation class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @@author     Andrew Smith
 */
class MY_Form_validation extends CI_Form_validation
{
    function unique($value, $params)
	{
		$CI =& get_instance();

		$CI->form_validation->set_message('unique',
			'The %s is already being used.');

		list($model, $field) = explode(".", $params, 2);

        $find = "findOneBy".$field;

		if (Doctrine::getTable($model)->$find($value)) {
			return false;
		} else {
			return true;
		}

	}
}
// END Session Class

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */