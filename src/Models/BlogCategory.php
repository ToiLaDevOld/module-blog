<?php

namespace ToiLaDev\Blog\Models;

use ToiLaDev\Models\Base;
use ToiLaDev\Models\Employee;
use ToiLaDev\Traits\CastTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class BlogCategory extends Base {
    use SoftDeletes, CastTrait, NodeTrait;

    protected $table = 'blog_categories';

    protected $fillable = ['name', 'image', 'title', 'excerpt', 'parent_id', '_lft', '_rgt'];

    public function posts() {
        return $this->belongsToMany(BlogPost::class, 'blog_categories_posts', 'category_id', 'post_id');
    }
}
