<?php

namespace ToiLaDev\Blog\Controllers\Admin;


use ToiLaDev\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use ToiLaDev\Blog\DataTables\PostsDataTable;
use ToiLaDev\Blog\Requests\PostRequest;
use ToiLaDev\Blog\Services\BlogService;

class PostController extends Controller
{
    public $permissions = [
        'blog.view' => ['index'],
        'blog.create' => ['create', 'store'],
        'blog.edit' => ['edit', 'update'],
        'blog.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['name' => 'Content Manager']
    ];

    public string $mainRouteName = 'admin.blog.posts.index';

    public $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();
        $this->blogService = $blogService;
    }

    public function index(PostsDataTable $dataTable)
    {
        $this->breadcrumb();

        return $dataTable->render('Blog::admin.post.list');
    }

    public function create(Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();
        $categories = $this->blogService->allCategories();

        return moduleAdminView('post.create', [
            'categories' => $categories
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();

        $categories = $this->blogService->allCategories();
        $post = $this->blogService->find($id);

        return moduleAdminView('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function store(PostRequest $request) {
        $post = $this->blogService->createFromRequest($request);

        return $this->storeResponse($post);
    }

    public function update(int $id, PostRequest $request) {
        $post = $this->blogService->updateFromRequest($id, $request);
        return $this->updateResponse($post);
    }

    public function destroy(int $id, Request $request) {

        $this->blogService->delete($id);

        return $this->deleteResponse();
    }

}
