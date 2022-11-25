<?php

namespace ToiLaDev\Blog\Controllers\Admin;


use Illuminate\Http\Request;
use ToiLaDev\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Response;
use ToiLaDev\Blog\Requests\PostRequest;
use ToiLaDev\Blog\Services\BlogService;

class CategoryController extends Controller
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

    public string $mainRouteName = 'admin.blog.categories.index';

    public $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $this->breadcrumb('Blogs');

        $categories = $this->blogService->allCategories();

        return moduleAdminView('category.list', [
            'categories' => $categories,
            'sortable' => $this->blogService->toTree($categories)
        ]);
    }

    public function store(Request $request) {

        $category = $this->blogService->createCategoryFromRequest($request);

        return $this->storeResponse($category);
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();

        $category = $this->blogService->secondFind($id);
        $categories = $this->blogService->allCategories();

        return moduleAdminView('category.edit', [
            'categories' => $categories,
            'sortable' => $this->blogService->toTree($categories),
            'category' => $category
        ]);
    }

    public function update(int $id, Request $request) {
        $category = $this->blogService->updateCategoryFromRequest($id, $request);

        return $this->updateResponse($category);
    }

    public function destroy(int $id, Request $request) {

        $this->blogService->secondDelete($id);

        return $this->deleteResponse();
    }

    public function sort(Request $request) {
        $this->blogService->sortCategoryFromRequest($request);

        return $this->updateResponse();
    }

}
