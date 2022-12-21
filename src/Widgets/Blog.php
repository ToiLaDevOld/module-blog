<?php

namespace ToiLaDev\Blog\Widgets;

use ToiLaDev\Blog\Services\BlogService;

class Blog
{

    public static function categories() {
        $blogService = app()->make(BlogService::class);
        $categories = $blogService->allCategories();
        $categories->load(['cast']);
        return widgetView('categories', [
            'categories'    => $blogService->toTree($categories)
        ]);
    }

    public static function recentPosts() {
        $blogService = app()->make(BlogService::class);
        return widgetView('recent-posts', [
            'posts'    => $blogService->recentPosts()
        ]);
    }

    public static function search() {
        return widgetView('search');
    }
}