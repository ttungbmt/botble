<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="{{ app()->getLocale() }}"><![endif]-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family={{ urlencode(theme_option('primary_font', 'Roboto')) }}&display=swap" rel="stylesheet">

        <style>
            :root {
                --color-1st: {{ theme_option('primary_color', '#bead8e') }};
                --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
            }
        </style>

        @php
            Theme::asset()->container('footer')->remove('simple-slider-js');
        @endphp

        {!! Theme::header() !!}

        <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
        <!--WARNING: Respond.js doesn't work if you view the page via file://-->
        <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
    <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
    <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}
    <header class="header" id="header">
        <div class="header-wrap">
            <nav class="nav-top">
                <div class="container">
                    <div class="row">
                        @if (theme_option('social_links'))
                            <div class="col-md-6">
                                <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a d-inline-block">
                                    @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                                        @if (count($socialLink) == 3)
                                            <a href="{{ $socialLink[2]['value'] }}"
                                               title="{{ $socialLink[0]['value'] }}" class="hi-icon {{ $socialLink[1]['value'] }}" target="_blank">
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6 text-end">
                            @if (is_plugin_active('member'))
                                <ul class="d-inline-block">
                                    @if (auth('member')->check())
                                        <li><a href="{{ route('public.member.dashboard') }}" rel="nofollow"><img src="{{ auth('member')->user()->avatar_url }}" class="img-circle" width="20" alt="{{ auth('member')->user()->name }}"> &nbsp;<span>{{ auth('member')->user()->name }}</span></a></li>
                                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" rel="nofollow"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a></li>
                                    @else
                                        <li><a href="{{ route('public.member.login') }}" rel="nofollow"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a></li>
                                    @endif
                                </ul>
                                @if (auth('member')->check())
                                    <form id="logout-form" action="{{ route('public.member.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            @endif

                            <div class="language-wrapper d-inline-block">
                                {!! apply_filters('language_switcher') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <header data-sticky="false" data-sticky-checkpoint="200" data-responsive="991" class="page-header page-header--light">
        <div class="container">
            <!-- LOGO-->
            <div class="page-header__left">
                <a href="{{ route('public.single') }}" class="page-logo">
                    @if (theme_option('logo'))
                        <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" height="50">
                    @endif
                </a>
            </div>
            <div class="page-header__right">
                <!-- MOBILE MENU-->
                <div class="navigation-toggle navigation-toggle--dark" style="display: none"><span></span></div>
                <div class="pull-left">
                    <!-- SEARCH-->
                    <div class="search-btn c-search-toggler"><i class="fa fa-search close-search"></i></div>
                    <!-- NAVIGATION-->
                    <nav class="navigation navigation--light navigation--fade navigation--fadeLeft">
                        {!!
                            Menu::renderMenuLocation('main-menu', [
                                'options' => ['class' => 'menu sub-menu--slideLeft'],
                                'view'    => 'main-menu',
                            ])
                        !!}
                    </nav>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        @if (is_plugin_active('blog'))
            <div class="super-search hide" data-search-url="{{ route('public.ajax.search') }}">
                <form class="quick-search" action="{{ route('public.search') }}">
                    <input type="text" name="q" placeholder="{{ __('Type to search...') }}" class="form-control search-input" autocomplete="off">
                    <span class="close-search">&times;</span>
                </form>
                <div class="search-result"></div>
            </div>
        @endif
    </header>
    <div id="page-wrap">
