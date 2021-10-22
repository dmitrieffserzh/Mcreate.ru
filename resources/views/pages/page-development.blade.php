@extends('app')

@section('title', $page['meta'][0]['title'])
@section('meta_keywords', $page['meta'][0]['keywords'])
@section('meta_description', $page['meta'][0]['description'])

@section('content')
    <section class="section section--page section-bg--page-{{ end($segment) }}">
        <div class="container">
            <div class="page-section">
                <h1 class="page-section__title">{{ $page['title'] }}</h1>
                <p class="page-section__description">{!! strip_tags($page['content']) !!}</p>
            </div>
        </div>
    </section>
@endsection
