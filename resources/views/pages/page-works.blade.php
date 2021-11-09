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

    <section class="section section--works">
        <div class="works">
            @foreach( $works as $item)
                <div class="works-item">
                    <a class="works-item__link" href="{{ route('works.show', ['slug' => $item['slug']]) }}"></a>
                    <img class="works-item__img" src="{{ $item['img_cover'] }}" alt="">
                    <h3 class="works-item__title">{{ preg_replace('#^https?://#', '', $item['url']) }}</h3>
                </div>
            @endforeach
        </div>
    </section>
@endsection
