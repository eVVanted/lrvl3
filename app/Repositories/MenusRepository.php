<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 28.06.2019
 * Time: 21:15
 */

namespace Corp\Repositories;

use Corp\Menu;


class MenusRepository extends Repository
{
    public function __construct(Menu $menu){
        $this->model = $menu;
    }

}