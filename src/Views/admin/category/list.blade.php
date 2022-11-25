@extends('Admin::layouts.sortable')
@section('title', __('Blog Categories'))
@section('card-title', __('List Categories'))
@section('base-url', route('admin.blog.categories.index'))
@section('card-body')
    @form([\ToiLaDev\Blog\Forms\BlogForm::class, 'createCategory'], $categories)
@endsection