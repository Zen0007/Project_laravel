@extends('layout.app')

@section('title', 'dev.log — A Programmer\'s Blog')

@section('content')
    @include('sections.home')
    @include('sections.articles')
    @include('sections.projects')
    @include('sections.about')
@endsection
