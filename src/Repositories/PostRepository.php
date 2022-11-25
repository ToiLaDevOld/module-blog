<?php

namespace ToiLaDev\Blog\Repositories;

use ToiLaDev\Repositories\Repository;
use ToiLaDev\Blog\Models\BlogPost;

class PostRepository extends Repository implements PostRepositoryImpl
{
    public function __construct(BlogPost $model) {
        $this->_model = $model;
    }
}