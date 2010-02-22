<?php defined('BASEPATH') or die('No direct script access.');

/**
 * Strong Class
 *
 * User authentication and authorization library
 *
 * @license 	MIT Licence
 * @category	Libraries
 * @author  	Andrew Smith
 * @link    	http://www.silentworks.co.uk
 * @copyright	Copyright (c) 2009, Silent Works.
 * @date		02 May 2009
 */
class Strong
{	
	public function __construct()
	{
		$this->_load_instance();
		
		// Get configuration settings for Strong
		$this->config->load('strong');
		
		log_message('debug', 'Strong Library loaded');
	}

	/**
	 * Try to Login
	 *
	 * @example $strong->login('username', 'password')
	 * @param object string login
	 * @param string password
	 * @return  boolean
	 */
	public function login($user, $password, $remember = FALSE)
	{
		if (empty($password)) return FALSE;

		// Create a hashed password with Doctrine mutilator
        $usr = new Users();
        $usr->password = $password;
		
		$user_data = $this->users->where('username = ?', $user)->fetchOne();
		
		if($user_data AND $user_data['password'] === $usr->password) {
            if ($remember === TRUE)
			{
				// Create a new autologin token
				$token = new User_token();

				// Set token data
				$token->user_id = $user_data['id'];
				$token->expires = time() + $this->config['lifetime'];
				$token->save();

				// Set the autologin cookie
				set_cookie('strongautologin', $token->token, $this->config['lifetime']);
			}
			
            $this->complete_login($user_data);
			return TRUE;
        }
	}

	/**
	 * Check if user is logged in
	 *
	 * @example $strong->logged_in()
	 * @return boolean
	 */
	public function logged_in($role = NULL)
	{
		$status = FALSE;
		
		$user_session = $this->ci->session->userdata('auth_user');
		
		// Checks if a user is logged in and valid
		if (!empty($user_session) AND $user_session['logged_in'] == TRUE)
		{
			// Everything is okay so far
			$status = TRUE;

			if ( ! empty($role))
			{
				$status = $this->users->fields_values(array('id' => $user_session['id']))->has_role($role);
				// Check that the user has the given role
				// $status = $auth_user->has_role($role);
			}
		}
		return $status;
	}

	public function logout($destroy = FALSE)
	{
		// Delete the autologin cookie if it exists
		//cookie::get('authautologin') and cookie::delete('authautologin');
		if ($destroy === TRUE)
		{
			// Destroy the session completely
			$this->ci->session->sess_destroy();
		} else {
			// Remove the user object from the session
			$this->ci->session->unset_userdata('auth_user');
		}

		// Double check
		return ! $this->ci->session->userdata('auth_user');
	}

	/*
	 * Password Hashing
	 */
	public function hash_password($password, $salt = FALSE)
	{
		if($salt == FALSE)
		{
			// Create a salt seed, same length as the number of offsets in the pattern
			$salt = md5($this->config->item('salt_pattern'));
		}

		$hash = $this->hash($salt.$password);

		// Add the part to the password, appending the salt character
		$password = substr($hash.$salt, 0, $this->config->item('length'));

		return $password;
	}

	protected function hash($str)
	{
		return hash($this->config->item('hash_type'), $str);
	}

	protected function complete_login($user)
	{
        Doctrine_Query::create()->update('Users u')
                    ->set('u.logins', $user['logins'] + 1)
                    ->set('u.last_login', '?', time())
                    ->where('u.id = ?', $user['id'])
                    ->execute();
		
		$user_info = array(
						'id' => $user['id'],
						'username' => $user['username'],
						'email' => $user['email'],
						'logged_in' => TRUE);
		
		// Store session data
		$this->ci->session->set_userdata('auth_user', $user_info);
	}
	
	/**
	 * Assign Libraries
	 *
	 * Assigns required CodeIgniter libraries to Strong.
	 *
	 * @access	private
	 * @return	void
	 */
	private function _load_instance()
	{
        $this->ci =& get_instance();

		if ($this->ci)
		{
            $this->lang = $this->ci->lang;
            $this->load = $this->ci->load;
            $this->config = $this->ci->config;
            $this->users = Doctrine_Query::create()->from('Users')
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

            $this->ci->load->library('session');
		}
	}

}
/* End of file Strong.php */
/* Location: ./application/libraries/Strong.php */