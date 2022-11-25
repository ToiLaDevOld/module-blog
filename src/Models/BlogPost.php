<?php

namespace ToiLaDev\Blog\Models;

use ToiLaDev\Models\Base;
use ToiLaDev\Models\Employee;
use ToiLaDev\Traits\CastTrait;
use ToiLaDev\Traits\LogActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Base {
    use SoftDeletes, CastTrait, LogActivityTrait;

    protected $table = 'blog_posts';

    protected $fillable = ['name', 'image', 'title', 'excerpt', 'body', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(Employee::class, 'owner_id');
    }

    public function categories() {
        return $this->belongsToMany(BlogCategory::class, 'blog_categories_posts', 'post_id', 'category_id');
    }
}
