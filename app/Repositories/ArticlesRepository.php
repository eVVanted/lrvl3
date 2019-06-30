<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 30.06.2019
 * Time: 18:39
 */

namespace Corp\Repositories;


use Corp\Articles;

class ArticlesRepository extends Repository
{
    public function __construct(Articles $articles){
        $this->model = $articles;
    }



}