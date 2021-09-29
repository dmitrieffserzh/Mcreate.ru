@extends('app')

@section('title', $page['meta'][0]['title'])
@section('meta_keywords', $page['meta'][0]['keywords'])
@section('meta_description', $page['meta'][0]['description'])

@section('content')
    <section class="section section--page section-bg--page-{{ end($segment) }}">
        <div class="container">
            <div class="page-section">
                <h1 class="page-section__title">{{ $page['title'] }}</h1>
                <p class="page-section__description">{{ strip_tags($page['content']) }}</p>
            </div>
        </div>
    </section>

    <div id="map" style="width:100%; height:60vh;"></div>
    @push('scripts')
        <script>
            ymaps.ready(init);
            function init() {
                var myMap = new ymaps.Map("map", {
                        center: [55.751979, 37.617499],
                        zoom: 15
                    }),
                    myPlacemark1 = new ymaps.Placemark([55.751979, 37.617499], {
                        hintContent: 'Надпись, которая всплаывет при наведении на метку'
                    }, {
                        iconImageHref: 'https://static.tildacdn.com/tild3061-3235-4537-b066-616662373363/Group_783.svg',
                        iconImageSize: [130, 130],
                        iconImageOffset: [-65, -110]
                    })

                myMap.geoObjects
                    .add(myPlacemark1)
            }
        </script>
    @endpush
    <style>
        .ymaps-layers-pane {
            -webkit-filter: grayscale(100%);
        }
    </style>

@endsection