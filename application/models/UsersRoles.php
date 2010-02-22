<?php

/**
 * UsersRoles
 *
 * @property integer $user_id
 * @property integer $role_id
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     Andrew Smith <a.smith@silentworks.co.uk>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class UsersRoles extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->hasColumn('user_id', 'integer', null, array(
            'primary' => true
        ));

        $this->hasColumn('role_id', 'integer', null, array(
            'primary' => true
        ));
    }
}