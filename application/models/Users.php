<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * @property integer $id
 * @property integer $ministry_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $logins
 * @property integer $last_login
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     Andrew Smith <a.smith@silentworks.co.uk>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Users extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('ministry_id', 'integer', 4);
        $this->hasColumn('username', 'string', 32, array('unique' => true));
        $this->hasColumn('password', 'string', 50);
        $this->hasColumn('email', 'string', 144, array('unique' => true));
        $this->hasColumn('logins', 'integer', 4);
        $this->hasColumn('last_login', 'integer', 4);
    }

    public function setUp()
    {
        $this->hasMutator('password', '_hash_password');

        $this->hasOne('Ministries', array(
            'local' => 'ministry_id',
            'foreign' => 'id'
        ));

        $this->hasOne('UserDetails', array(
            'local' => 'id',
            'foreign' => 'user_id'
        ));
        
        $this->hasMany('Roles', array(
            'local' => 'user_id',
            'foreign' => 'role_id',
            'refClass' => 'UsersRoles'
        ));
    }

    protected function _hash_password($password)
    {
        $CI =& get_instance();

        $salt = md5($CI->config->item('salt_pattern'));
        $hash = hash($CI->config->item('hash_type'), $password.$salt);

        // Add the part to the password, appending the salt character
		$this->_set('password', substr($hash.$salt, 0, $CI->config->item('length')));
    }
}