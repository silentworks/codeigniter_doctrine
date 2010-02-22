<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Redirect
 *
 * @author Andrew Smith
 */
class Redirect
{
    var $ci = NULL;
    var $settings = array();
    var $success = NULL;
    var $warning = NULL;

    //put your code here
    public function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->library('session');
        $this->ci->load->helper('url');
    }

    public function flash_success($msg, $url)
    {
        $this->ci->session->set_flashdata('success', $msg);
        if (!empty($url))
        {
            redirect($url);
        }
    }

    public function flash_warning($msg, $url)
    {
        $this->ci->session->set_flashdata('warning', $msg);
        if (!empty($url))
        {
            redirect($url);
        }
    }

    public function id_empty($id, $url)
    {
        if (!$id) {
            $this->flash_warning('Invalid Id. Please check your link.', $url);
        }
    }
}
/* End of file Redirect.php */
/* Location: ./application/libraries/Redirect.php */