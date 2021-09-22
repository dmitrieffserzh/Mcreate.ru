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
                <div class="services__item">
                    <h3 class="services__item-title">Разработка</h3>
                    <p class="services__item-description">Разработка корпоративных сайтов и интернет-магазинов.</p>
                    <a href="" class="services__item-link">Подробнее</a>
                </div>
                <div class="services__item">
                    <h3 class="services__item-title">Поддержка</h3>
                    <p class="services__item-description">Продвижение сайта в поисковых системах (SEO).</p>
                    <a href="" class="services__item-link">Подробнее</a>
                </div>
                <div class="services__item">
                    <h3 class="services__item-title">Продвижение</h3>
                    <p class="services__item-description">Следим за сайтом, пишем и размещаем новости.</p>
                    <a href="" class="services__item-link">Подробнее</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section section--portfolio">
        <div class="container">
            <h2 class="section__title">Наши работы</h2>
        </div>
        <div class="portfolio">
            @foreach( $portfolio as $item)
            <div class="portfolio-item">
                <a class="portfolio-item__link" href="#"></a>
                <img class="portfolio-item__img" src="{{ $item['img_cover'] }}" alt="">
                <h3 class="portfolio-item__title">{{ $item['title'] }}</h3>
            </div>
            @endforeach
            <!--<div class="container">
                <a href="#" class="button button--center">Смореть все</a>
            </div>-->
        </div>
    </section>
    <section class="section section--services">
        <div class="container">
            <h2 class="section__title">Отзывы</h2>
        </div>
    </section>

    <section class="section section--contacts">
        <div class="container">
            <h2 class="section__title">Контакты</h2>
            <form action="" class="feedback">
                <input type="text" class="feedback__input" placeholder="Имя">
                <input type="text" class="feedback__input" placeholder="Телефон">
                <textarea name="" rows="3" class="feedback__textarea" placeholder="Сообщение..."></textarea>
                <p>Нажимая «Отправить», Вы принимаете условия
                    <a href="">политики конфиденциальности</a>.
                </p>
                <button class="button feedback__submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection