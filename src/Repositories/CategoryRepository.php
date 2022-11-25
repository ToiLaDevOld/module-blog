<?php

namespace ToiLaDev\Blog\Repositories;

use ToiLaDev\Repositories\Repository;
use ToiLaDev\Blog\Models\BlogCategory;

class CategoryRepository extends Repository implements CategoryRepositoryImpl
{
    public function __construct(BlogCategory $model) {
        $this->_model = $model;
    }
}