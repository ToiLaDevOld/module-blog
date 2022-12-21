<?php

namespace ToiLaDev\Blog\Forms;

use Illuminate\Contracts\View\View;
use ToiLaDev\Blog\Services\BlogService;
use ToiLaDev\Forms\Base\Email;
use ToiLaDev\Forms\Base\Form;
use ToiLaDev\Forms\Base\Hide;
use ToiLaDev\Forms\Base\Image;
use ToiLaDev\Forms\Base\Quill;
use ToiLaDev\Forms\Base\Select;
use ToiLaDev\Forms\Base\Text;
use ToiLaDev\Forms\Base\Textarea;

class BlogForm
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService) {
        $this->blogService = $blogService;
    }

    public function create($categories): View
    {
        $form = new Form('add-post',
            route: 'admin.blog.posts.store',
            wrap: 'col-12'
        );
        $form->add('Add New Post');
        $form->add(new Text('name', same: 'title', slug: 'slug'));
        $form->add(new Text('slug'));
        $form->add(new Text('title'));
        $form->add(new Select('categories', multiple: true, options: toSelect($categories->toFlatTree())));
        $form->add(new Textarea('excerpt'));
        $form->add(new Quill('body'));
        $form->add(new Image());

        return $form->render();
    }

    public function edit($attrs): View
    {
        $post = $attrs[0];
        $categories = $attrs[1];
        if (is_numeric($post)) {
            $post = $this->blogService->find($post);
        }
        if (empty($post)) {
            return '';
        } else {
            $form = new Form('add-post',
                action: route('admin.blog.posts.update', $post->id),
                wrap: 'col-12',
                method: 'put'
            );
            $form->add('Edit Post');
            $form->add(new Hide('id', value: $post->id));
            $form->add(new Text('name', same: 'title', slug: 'slug', value: $post->name));
            $form->add(new Text('slug', value: $post->slug));
            $form->add(new Text('title', value: $post->title));
            $form->add(new Select('categories', multiple: true, options: toSelect($categories->toFlatTree()), value: $this->blogService->idCategories($post)));
            $form->add(new Textarea('excerpt', value: $post->excerpt));
            $form->add(new Quill('body', value: $post->body));
            $form->add(new Image(value: $post->image));

            return $form->render();
        }
    }

    public function createCategory($categories): View
    {
        $form = new Form('add-category',
            route: 'admin.blog.categories.store',
            wrap: 'col-12'
        );
        $form->add('Add New Category');
        $form->add(new Text('name', same: 'title', slug: 'slug'));
        $form->add(new Text('slug'));
        $form->add(new Text('title'));
        $form->add(new Textarea('excerpt'));
        $form->add(new Select('parent_id', title: 'Parent', multiple: true, options: toSelect($categories->toFlatTree()), default: '_____'));
        $form->add(new Image());

        return $form->render();
    }

    public function editCategory($attrs): View|string
    {
        $category = $attrs[0];
        $categories = $attrs[1];
        if (is_numeric($category)) {
            $category = $this->blogService->secondFind($category);
        }
        if (empty($category)) {
            return '';
        } else {
            $form = new Form('edit-category',
                action: route('admin.blog.categories.update', $category->id),
                wrap: 'col-12',
                method: 'put'
            );
            $form->add('Edit Category');
            $form->add(new Hide('id', value: $category->id));
            $form->add(new Text('name', same: 'title', slug: 'slug', value: $category->name));
            $form->add(new Text('slug', value: $category->slug));
            $form->add(new Text('title', value: $category->title));
            $form->add(new Select('parent_id', title: 'Parent', multiple: true, options: toSelect($categories->toFlatTree()), value: $category->parent_id, default: '_____'));
            $form->add(new Textarea('excerpt', value: $category->excerpt));
            $form->add(new Image(value: $category->image));

            return $form->render();
        }
    }
}