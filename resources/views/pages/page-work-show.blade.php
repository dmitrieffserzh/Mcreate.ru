@extends('app')

@section('title', $work[0]["meta"][0]['title'])
@section('meta_keywords',$work[0]["meta"][0]['keywords'])
@section('meta_description', $work[0]["meta"][0]['description'])

@section('content')
    <section class="section section--page section-bg--page-" @if($work[0]['img_main']) style="
            background: url('{{ $work[0]['img_main'] }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            "@endif>
        <div class="container">
            <div class="page-section">
                <h1 class="page-section__title">{{ $work[0]['title'] }}</h1>
                <p class="page-section__description">test desc</p>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="works-content">
                {{ strip_tags($work[0]['content']) }}
            </div>
        </div>
    </section>
    <section class="section section--works">
        <div class="works">
        @foreach($works as $item)
                <div class="works-item">
                    <a class="works-item__link" href="{{ route('works.show', ['slug' => $item['slug']]) }}"></a>
                    <img class="works-item__img" src="{{ $item['img_cover'] }}" alt="">
                    <h3 class="works-item__title">{{ $item['title'] }}</h3>
                </div>
        @endforeach
        </div>
    </section>
@endsection