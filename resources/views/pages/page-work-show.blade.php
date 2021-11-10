@extends('app')

@section('title', $work["meta"][0]['title'])
@section('meta_keywords',$work["meta"][0]['keywords'])
@section('meta_description', $work["meta"][0]['description'])

@section('content')
    <section class="section section--page section-bg--page-" @if($work['img_main']) style="
            background: url('{{ $work['img_main'] }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            "@endif>
        <div class="container">
            <div class="page-section">
                <h1 class="page-section__title">{!! $work['title'] !!}</h1>
                <p class="page-section__description"></p>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="works-content">
                {{ strip_tags($work['content']) }}
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <h2 class="section__title">Что мы сделали?</h2>
            <div class="works-do">
                @foreach($work['work'] as $item)
                    <div class="works-do-item">
                        <span class="works-do-item__icon"></span>
                        <h3 class="works-do-item__title">{{ $item['Описание'] }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <h2 class="section__title">Результаты</h2>
            <div class="works-results">
                @foreach($work['results'] as $item)
                    <div class="works-results-item">
                        <div class="works-results-item__number">{{ $item['Цифра'] }}.</div>
                        <div class="works-results-item__desc">{{ $item['Описание'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section section--works">
        <div class="works">
            @foreach($works as $item)
                <div class="works-item">
                    <a class="works-item__link" href="{{ route('works.show', ['slug' => $item['slug']]) }}"></a>
                    <img class="works-item__img" src="{{ $item['img_cover'] }}" alt="">
                    <h3 class="works-item__title">{{ preg_replace('#^https?://#', '', $item['url']) }}</h3>
                </div>
            @endforeach
        </div>
    </section>
@endsection
