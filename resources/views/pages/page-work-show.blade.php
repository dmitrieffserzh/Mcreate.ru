@extends('app')

@section('title', $work[0]["meta"][0]['title'])
@section('meta_keywords',$work[0]["meta"][0]['keywords'])
@section('meta_description', $work[0]["meta"][0]['description'])

@section('content')
    <section class="section section--page section-bg--page-">
        <div class="container">
            <div class="page-section">
                <h1 class="page-section__title">{{ $work[0]['title'] }}</h1>
                <p class="page-section__description">{{ strip_tags($work[0]['content']) }}</p>
            </div>
        </div>
    </section>

    <section class="section section--works">
        <div class="works">

                <div class="works-item">
                    <a class="works-item__link" href="#"></a>
                    <img class="works-item__img" src="{{ $work[0]['img_cover'] }}" alt="">
                    <h3 class="works-item__title">{{ $work[0]['title'] }}</h3>
                </div>

        </div>
    </section>
@endsection