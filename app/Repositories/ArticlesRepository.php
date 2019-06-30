<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 30.06.2019
 * Time: 18:39
 */

namespace Corp\Repositories;


use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $articles){
        $this->model = $articles;
    }



}