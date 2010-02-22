<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library(array('template', 'strong', 'redirect'));
        $this->template->template('login');

        $this->template->app_name = $this->config->item('app_name');
	}

	public function index()
	{
		redirect('/auth/login/');
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	public function login()
	{
        // Validate Form using Validation Library
    	$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() !== FALSE)
        {
            if($this->strong->login($this->input->post('username'), $this->input->post('password')))
            {
                $this->redirect->flash_success('You are successfully logged in', 'dashboard');
            }
        }

		$this->template->view('auth/login');
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->strong->logout(TRUE);
        $this->redirect->flash_success('You have successfully logged out', 'auth/login');
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	public function register()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    	// Validate Form using Validation Library
    	$this->form_validation->set_rules('username', 'Username', 'required|unique[Users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_conf]');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|unique[Users.email]');

		if ($this->form_validation->run() === FALSE)
		{
			$data['message'] = "Enter your information below";
		} else {
            $u = new Users();
            $u->username = $this->input->post('username');
            $u->password = $this->input->post('password');
            $u->email = $this->input->post('email');

	    	if($u->save())
	    		$data['message'] = "User Created Successfully.";
		}

    	$this->load->view('strong/create', $data);
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */