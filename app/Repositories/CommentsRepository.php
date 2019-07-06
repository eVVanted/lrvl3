<?php
/**
 * Created by PhpStorm.
 * User: Wanted
 * Date: 06.07.2019
 * Time: 21:34
 */

namespace Corp\Repositories;
use Corp\Comment;

class CommentsRepository extends Repository
{
    public function __construct(Comment $comment){
        $this->model = $comment;
    }



}