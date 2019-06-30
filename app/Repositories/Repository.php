<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 28.06.2019
 * Time: 21:16
 */

namespace Corp\Repositories;

use Config;


abstract class Repository
{
    protected $model = FALSE;

    public function get($select='*', $take = false){

        $builder = $this->model->select($select);
        if($take){
            $builder->take($take);
        }
        return $builder->get();
    }
}