<?php

namespace ToiLaDev\Blog\Controllers;

use ToiLaDev\Controllers\Controller;
use ToiLaDev\Blog\Models\BlogPost;
use ToiLaDev\Blog\Services\BlogService;

class PostController extends Controller
{

    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
        parent::__construct();
    }

    public function displayView(BlogPost $post) {
        $post->load(['owner:id,first_name,last_name,email,avatar', 'categories:id,name', 'categories.cast']);
        return moduleView('post' , ['post' => $post]);
    }

    public function index($page = 1) {
        $posts = BlogPost::paginate(page: $page);
        return moduleView('list', ['posts' => $posts]);
    }
}
