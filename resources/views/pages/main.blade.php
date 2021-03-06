@extends('app')

@section('title', $page['meta'][0]['title'])
@section('meta_keywords', $page['meta'][0]['keywords'])
@section('meta_description', $page['meta'][0]['description'])

@section('content')
    <section class="section section--main section-bg--page-main">
        <div class="container">
            <div class="main-section">
                <h1 class="main-section__title">{{ $page['title'] }}</h1>
                <p class="main-section__description">{{ strip_tags($page['content']) }}</p>
            </div>
        </div>
    </section>
    <section class="section section--services">
        <div class="container">
            <h2 class="section__title">Наши Услуги</h2>
            <div class="services">
                @foreach($services as $item)
                    <div class="services__item">
                        <h3 class="services__item-title">{{ $item->title }}</h3>
                        <p class="services__item-description">{{ strip_tags($item->content) }}</p>
                        <a href="{{ route('services.show', ['slug' => $item->slug]) }}" class="services__item-link">Подробнее</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section section--works">
        <div class="container">
            <h2 class="section__title">Наши работы</h2>
        </div>
        <div class="works">
            @foreach($works as $item)
                <div class="works-item">
                    <a class="works-item__link" href="{{ route('works.show', ['slug' => $item['slug']]) }}"></a>
                    <img class="works-item__img" src="{{ $item['img_cover'] }}" alt="">
                    <h3 class="works-item__title">{{ preg_replace('#^https?://#', '', $item['url']) }}</h3>
                </div>
            @endforeach
            <div class="container">
                <a href="/works/" class="button button--center">Смореть все</a>
            </div>
        </div>
    </section>
    <section class="section section--services">
        <div class="container">
            <h2 class="section__title">Отзывы</h2>
            <div class="testimonials">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $item)
                        <div class="swiper-slide">
                            <h3 class="testimonials__title">{{ $item['title'] }} - ID: {{ $item['id'] }}</h3>
                            <div class="testimonials__desc">{!! $item['content'] !!}</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--contacts">
        <div class="container">
            <h2 class="section__title section__title--center">Контакты</h2>
            <form id="feedback" action="" class="feedback" novalidate>
                <div class="feedback__block">
                    <input type="text" name="name" class="feedback__input" placeholder="Имя *" autocomplete="off" required>
                </div>
                <div class="feedback__block">
                    <input type="text" name="phone" class="feedback__input" placeholder="Телефон *" autocomplete="off" required>
                </div>
                <div class="feedback__block">
                    <textarea name="message" rows="3" class="feedback__textarea"  placeholder="Сообщение..."></textarea>
                </div>
                <input type="hidden" name="page_url" value="{{  url()->current() }}">
                <p>Нажимая «Отправить», Вы принимаете условия
                    <a href="">политики конфиденциальности</a>.
                </p>
                <button class="button feedback__submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
