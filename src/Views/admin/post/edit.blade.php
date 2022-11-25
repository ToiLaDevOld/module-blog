@extends('Admin::layouts.card')
@section('title', __('Edit Blog Post'))
@section('card-body')
    @form([ \ToiLaDev\Blog\Forms\BlogForm::class, 'edit'], [$post, $categories])
@endsection