<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 30.06.2019
 * Time: 16:34
 */

namespace Corp\Repositories;


use Corp\Portfolio;

class PortfoliosRepository extends Repository
{
    public function __construct(Portfolio $portfolio){
        $this->model = $portfolio;
    }

    public function one($alias, $attr = []){
        $portfolio = parent::one($alias,$attr);
        if($portfolio && $portfolio->img){
            $portfolio->img = json_decode($portfolio->img);
        }

        return $portfolio;
    }



}