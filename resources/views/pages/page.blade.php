@extends('app')

@section('title', $page['meta'][0]['title'])
@section('meta_keywords', $page['meta'][0]['keywords'])
@section('meta_description', $page['meta'][0]['description'])

@section('content')
<h1>{{ $page['title'] }}</h1>
{!! $page['content'] !!}
@endsection