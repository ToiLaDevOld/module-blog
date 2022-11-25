@extends('Admin::layouts.card')
@section('title', __('Create Blog Post'))
@section('card-body')
    @form([ \ToiLaDev\Blog\Forms\BlogForm::class, 'create'], $categories)
@endsection