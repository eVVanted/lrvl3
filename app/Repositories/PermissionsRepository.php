<?php
/**
 * Created by PhpStorm.
 * User: Eugene
 * Date: 27.08.2019
 * Time: 12:39
 */

namespace Corp\Repositories;


use Corp\Permission;

class PermissionsRepository extends Repository
{
    public function __construct(Permission $permission){
        $this->model = $permission;
    }

}