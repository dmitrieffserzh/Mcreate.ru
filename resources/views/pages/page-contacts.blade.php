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

   <div class="container">
       <form id="feedback" action="" class="feedback" novalidate>
           <div class="feedback__block">
               <input type="text" name="name" class="feedback__input" placeholder="Имя *" autocomplete="off" required>
           </div>
           <div class="feedback__block">
               <input type="text" name="phone" class="feedback__input" placeholder="Телефон *" autocomplete="off" required>
           </div>
           <div class="feedback__block">
               <textarea name="message" rows="3" class="feedback__textarea" placeholder="Сообщение..."></textarea>
           </div>
           <p>Нажимая «Отправить», Вы принимаете условия
               <a href="">политики конфиденциальности</a>.
           </p>
           <button class="button feedback__submit">Отправить</button>
       </form>
   </div>
    <div id="map" style="width:100%; height:60vh;margin: 5rem 0 0;"></div>
    @push('header-scripts')
        <script src="//api-maps.yandex.ru/2.0/?load=package.standard,package.geoObjects&lang=ru-RU" type="text/javascript"></script>
    @endpush
    @push('footer-scripts')
        <script>
            ymaps.ready(init);
            function init() {
                var myMap = new ymaps.Map("map", {
                        center: [55.751979, 37.617499],
                        zoom: 15
                    }),
                    myPlacemark = new ymaps.Placemark([55.751979, 37.617499], {
                       // hintContent: 'Надпись, которая всплаывет при наведении на метку'
                    }, {
                        iconImageHref: 'img/map-point.svg',
                        iconImageSize: [46, 60],
                        iconImageOffset: [-23, -60]
                    })

                myMap.geoObjects
                    .add(myPlacemark)
            }
        </script>
    @endpush
    <style>
        .ymaps-layers-pane {
            -webkit-filter: grayscale(100%);
        }
    </style>
@endsection
