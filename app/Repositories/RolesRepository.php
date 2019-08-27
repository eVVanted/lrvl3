<?php
/**
 * Created by PhpStorm.
 * User: Eugene
 * Date: 27.08.2019
 * Time: 12:41
 */

namespace Corp\Repositories;


use Corp\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role){
        $this->model = $role;
    }

}