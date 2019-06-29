<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 29.06.2019
 * Time: 21:56
 */

namespace Corp\Repositories;
use Corp\Slider;


class SlidersRepository extends Repository
{
    public function __construct(Slider $slider){
        $this->model = $slider;
    }

}