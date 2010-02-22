<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * UserDetails
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     Andrew Smith <a.smith@silentworks.co.uk>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class UserDetails extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('user_details');
        $this->hasColumn('user_id', 'integer', 4);
        $this->hasColumn('first_name', 'string', 140);
        $this->hasColumn('last_name', 'string', 140);
        $this->hasColumn('address', 'string', 255);
    }

    public function setUp()
    {
        $this->hasOne('Users', array(
            'local' => 'user_id',
            'foreign' => 'id'
        ));
    }
}