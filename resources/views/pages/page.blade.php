@extends('app')

@section('title', $page['meta'][0]['title'])
@section('meta_keywords', $page['meta'][0]['keywords'])
@section('meta_description', $page['meta'][0]['description'])

@section('content')
<h1>{{ $page['title'] }}</h1>
{!! $page['content'] !!}





    <div class="portfolio">
        <div class="portfolio-list">
            @foreach( $portfolio as $item)
            <div class="portfolio-item">
                <h3 class="portfolio-item__title">{{ $item->title }}</h3>
            </div>
            @endforeach
        </div>
    </div>



@endsection