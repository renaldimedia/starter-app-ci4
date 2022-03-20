<?php

namespace Config;

/**
 * Permissions
 *
 * Holds the permissions that are used by the system
 * 
 *
 */
class Permissions
{
    /**
     * @var array
     */
    public $permissions = array(
        'list_admin' => 'App\Admins::index'
    );
}