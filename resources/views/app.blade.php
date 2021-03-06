<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f1922">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','')</title>
    <meta name="keywords" content="@yield('meta_keywords','')">
    <meta name="description" content="@yield('meta_description','')">
    <link rel="canonical" href="{{url()->current()}}"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('header-scripts')
</head>

<body>
<header class="header">
    <div class="container d-flex justify-content-between">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 height="40" viewBox="0 0 837 153" xml:space="preserve" stroke="none" stroke-width="0"
                 stroke-linecap="round" stroke-linejoin="round" class="logo" onclick="window.location.href = '/'">
                    <polygon fill="#ff003f" points="146,145.6 77.6,77.1 146,8.7 "></polygon>
                <path fill="#fff"
                      d="M111.8,111.3L77.7,77.2c0,0-0.1-0.1-0.1-0.1L9,8.7c0,45.6,0,91.2,0,136.8c12-11.4,22.9-22.8,34.3-34.1l34.2,34.1L111.8,111.3z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M243.7,99l-0.3-41.5l-19.8,33.3h-13.5l-19.8-31.9V99h-28V7.9h25.2l29.7,48.5l28.9-48.5h25.2l0.3,91.1H243.7z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M282.9,53.5c0-28,21.5-47.6,50.7-47.6c17.8,0,31.9,6.5,40.8,18.2l-19.4,17.3c-5.3-6.8-11.7-10.7-19.9-10.7c-12.7,0-21.3,8.8-21.3,22.8c0,13.9,8.6,22.8,21.3,22.8c8.2,0,14.6-3.9,19.9-10.7l19.4,17.3c-9,11.7-23,18.2-40.8,18.2C304.3,101.1,282.9,81.4,282.9,53.5z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M422.3,76.1H414V99h-30.7V7.9h43.8c25.4,0,41.5,13.3,41.5,34.3c0,13.1-6.2,23-17.2,28.6L470.6,99h-32.8L422.3,76.1zM425.2,31.6H414V53h11.2c8.5,0,12.5-4,12.5-10.7S433.6,31.6,425.2,31.6z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M555.9,75.8V99h-75.7V7.9h74v23.2h-43.8v10.7h38.5v22.1h-38.5v12H555.9z"></path>
                <path class="hidden" fill="#fff"
                      d="M629.8,83.1h-34.6L589.1,99h-31.2l39.8-91.1h30.2L667.6,99h-31.7L629.8,83.1z M621.3,61l-8.8-22.9L603.6,61H621.3z">
                </path>
                <path class="hidden" fill="#fff" d="M687.8,31.7h-26.7V7.9h84v23.8h-26.7V99h-30.7V31.7z"></path>
                <path class="hidden" fill="#fff"
                      d="M828.8,75.8V99h-75.7V7.9h74v23.2h-43.8v10.7h38.5v22.1h-38.5v12H828.8z"></path>
                <path class="hidden" fill="#fff"
                      d="M162.5,115.7h13.3c9.9,0,16.6,6.1,16.6,15.3s-6.7,15.3-16.6,15.3h-13.3V115.7z M175.6,141.5c6.8,0,11.2-4.2,11.2-10.5s-4.4-10.5-11.2-10.5h-7.4v21H175.6z">
                </path>
                <path class="hidden" fill="#fff" d="M198.5,115.7h5.7v30.6h-5.7V115.7z"></path>
                <path class="hidden" fill="#fff"
                      d="M233.1,130.7h5.4v12.2c-3.2,2.6-7.6,3.9-11.9,3.9c-9.4,0-16.4-6.6-16.4-15.8s7-15.8,16.5-15.8c5.1,0,9.4,1.7,12.2,5l-3.6,3.5c-2.4-2.4-5.1-3.5-8.4-3.5c-6.5,0-11.1,4.4-11.1,10.8c0,6.2,4.6,10.8,11,10.8c2.2,0,4.3-0.4,6.3-1.6V130.7z">
                </path>
                <path class="hidden" fill="#fff" d="M245.9,115.7h5.7v30.6h-5.7V115.7z"></path>
                <path class="hidden" fill="#fff" d="M266,120.5h-10.1v-4.8h25.8v4.8h-10.1v25.8H266V120.5z"></path>
                <path class="hidden" fill="#fff"
                      d="M304.2,139.3H289l-3,7.1h-5.8l13.7-30.6h5.6l13.8,30.6h-5.9L304.2,139.3z M302.4,134.8l-5.7-13.4l-5.7,13.4H302.4z">
                </path>
                <path class="hidden" fill="#fff" d="M317.1,115.7h5.7v25.8h15.9v4.8h-21.6V115.7z"></path>
                <path class="hidden" fill="#fff"
                      d="M383.1,146.3l0-20.3l-10,16.8h-2.5l-10-16.5v20.1h-5.4v-30.6h4.7l12.1,20.3l11.9-20.3h4.7l0,30.6H383.1z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M416.5,139.3h-15.2l-3,7.1h-5.8l13.7-30.6h5.6l13.8,30.6h-5.9L416.5,139.3z M414.6,134.8l-5.7-13.4l-5.7,13.4H414.6z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M449.2,146.3l-6.2-9c-0.4,0-0.8,0-1.2,0H435v8.9h-5.7v-30.6h12.5c8,0,13,4.1,13,10.9c0,4.6-2.4,8.1-6.5,9.7l7,10.1H449.2zM441.6,120.5H435v12.2h6.6c5,0,7.5-2.3,7.5-6.1S446.5,120.5,441.6,120.5z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M471.6,133.5l-4.8,5v7.8h-5.7v-30.6h5.7v15.7l15.1-15.7h6.4l-12.8,13.7l13.6,16.9h-6.6L471.6,133.5z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M515.7,141.6v4.8h-22.8v-30.6h22.2v4.8h-16.6v8h14.7v4.7h-14.7v8.4H515.7z"></path>
                <path class="hidden" fill="#fff" d="M528.2,120.5h-10.1v-4.8h25.8v4.8h-10.1v25.8h-5.7V120.5z"></path>
                <path class="hidden" fill="#fff" d="M548.2,115.7h5.7v30.6h-5.7V115.7z"></path>
                <path class="hidden" fill="#fff"
                      d="M589.2,115.7v30.6h-4.7l-16.8-20.8v20.8h-5.6v-30.6h4.7l16.8,20.8v-20.8H589.2z"></path>
                <path class="hidden" fill="#fff"
                      d="M618.1,130.7h5.4v12.2c-3.2,2.6-7.6,3.9-11.9,3.9c-9.4,0-16.4-6.6-16.4-15.8s7-15.8,16.5-15.8c5.1,0,9.4,1.7,12.2,5l-3.6,3.5c-2.4-2.4-5.1-3.5-8.4-3.5c-6.5,0-11.1,4.4-11.1,10.8c0,6.2,4.6,10.8,11,10.8c2.2,0,4.3-0.4,6.3-1.6V130.7z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M662.7,139.3h-15.2l-3,7.1h-5.8l13.7-30.6h5.6l13.8,30.6h-5.9L662.7,139.3z M660.8,134.8l-5.7-13.4l-5.7,13.4H660.8z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M695.9,130.7h5.4v12.2c-3.2,2.6-7.6,3.9-11.9,3.9c-9.4,0-16.4-6.6-16.4-15.8s7-15.8,16.5-15.8c5.1,0,9.4,1.7,12.2,5l-3.6,3.5c-2.4-2.4-5.1-3.5-8.4-3.5c-6.5,0-11.1,4.4-11.1,10.8c0,6.2,4.6,10.8,11,10.8c2.2,0,4.3-0.4,6.3-1.6V130.7z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M731.5,141.6v4.8h-22.8v-30.6h22.2v4.8h-16.6v8h14.7v4.7h-14.7v8.4H731.5z"></path>
                <path class="hidden" fill="#fff"
                      d="M764.9,115.7v30.6h-4.7l-16.8-20.8v20.8h-5.6v-30.6h4.7l16.8,20.8v-20.8H764.9z"></path>
                <path class="hidden" fill="#fff"
                      d="M770.9,131c0-9.1,7-15.8,16.3-15.8c5,0,9.2,1.8,12.1,5.1l-3.7,3.5c-2.2-2.4-5-3.6-8.1-3.6c-6.3,0-10.9,4.5-10.9,10.8c0,6.3,4.6,10.8,10.9,10.8c3.2,0,5.9-1.2,8.1-3.6l3.7,3.5c-2.8,3.3-7.1,5.1-12.1,5.1C777.9,146.8,770.9,140.2,770.9,131z">
                </path>
                <path class="hidden" fill="#fff"
                      d="M817.4,135.5v10.8h-5.7v-10.7l-12-19.9h6l8.9,14.9l9-14.9h5.6L817.4,135.5z"></path>
        </svg>
        <div class="header__menu">
            <div class="overlay"></div>
            <nav class="main-menu">
                <a href="/services/" class="main-menu__link{{ request()->is('services*') ? ' main-menu__link--active' : '' }}">????????????</a>
                <a href="/works/" class="main-menu__link{{ request()->is('works*') ? ' main-menu__link--active' : '' }}">????????????</a>
                <a href="/testimonials/" class="main-menu__link{{ request()->is('testimonials*') ? ' main-menu__link--active' : '' }}">????????????</a>
                <a href="/articles/" class="main-menu__link{{ request()->is('articles*') ? ' main-menu__link--active' : '' }}">????????????</a>
                <a href="/contacts/" class="main-menu__link{{ request()->is('contacts*') ? ' main-menu__link--active' : '' }}">????????????????</a>
                <div id="contacts"></div>
            </nav>
            <button class="button-menu">
                <span class="button-menu__line"></span>
                <span class="button-menu__line"></span>
                <span class="button-menu__line"></span>
            </button>
        </div>
    </div>
</header>
<main class="main">
    @yield('content')
</main>
</main>
<footer class="footer">
    <div class="copyright">&copy; 2021 Mcreate. ?????? ?????????? ????????????????.</div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
@stack('footer-scripts')
</body>
</html>
