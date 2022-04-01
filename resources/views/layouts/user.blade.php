@include('inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="cam">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ENEOS WING 2022年度 乗務員様 謝恩祭</title>
    <link rel="icon" type="image/x-icon" href="/uploads/{{$campaign->id}}/favicon.ico">
    <link rel="apple-touch-icon" href="/uploads/{{$campaign->id}}/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" type="image/png" href="/uploads/{{$campaign->id}}/android-chrome-192x192.png" sizes="192x192">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link type="text/css" rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet"> -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-WJ8424D');</script>
    <!-- End Google Tag Manager -->

    <!-- Styles -->
    @include('inc.styles_user') 
</head>
<body id="{{ $page_name }}" class="" @auth style="padding-bottom:57px;" @endauth>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ8424D" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <header @auth id="header_menu" @endauth>
            <div class="logo">
                <a href="{{ route('campaign.dashboard', $campaign->id) }}">
                    <div class="logo_img"><img src="/uploads/{{$campaign->id}}/logo-color.svg"></div>
                    <p>{{ $campaign->name }}</p>
                </a>
            </div>
            @auth
                <div class="menu_btn">
                    <div id="account" class=""><i class="far fa-user-circle"></i>{{ $point->remaining_point }} pts</div>
                    <ul class="user_menu">
                        <li class="gray text-center">アカウント情報</li>
                        <li><a href="{{ route('campaign.email.edit', $campaign->id) }}"><i class="far fa-user-circle"></i>{{$user->email}}</a></li>
                        <li><a href="{{ route('campaign.password.change', $campaign->id) }}"><i class="fas fa-lock"></i>パスワード変更</a></li>
                        <li class="p-2"><i class="fab fa-product-hunt"></i>保有ポイント数：{{ $point->remaining_point }} pts</li>
                        <li class="p-2"><i class="fab fa-product-hunt"></i>ポイント合算 ※準備中</li>
                        <li><a href="{{ route('campaign.contact.index', $campaign->id) }}"><i class="far fa-envelope"></i>お問い合わせ</a></li>
                        <li>
                            <form method="post" action="{{ route('campaign.logout', $campaign->id) }}">
                                @csrf
                                <input type="submit" value="サインアウト">
                            </form>
                        </li>
                    </ul>
                </div>
                <div id="footer_menu">
                    <ul>
                        <li>
                            <a href="{{ route('campaign.dashboard', $campaign->id) }}">
                                <i class="fas fa-home"></i>
                                <center>ダッシュボード</center>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('campaign.receipt.snap', $campaign->id) }}">
                                <i class="fas fa-camera"></i>
                                <center>レシート撮影</center>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('campaign.catalog.gift.index', $campaign->id) }}">
                                <i class="fas fa-search"></i>
                                <center>景品一覧</center>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('campaign.receipt.index', $campaign->id) }}">
                                <i class="fas fa-receipt"></i>
                                <center>レシート履歴</center>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('campaign.apply.index', $campaign->id) }}">
                                <i class="fas fa-gift"></i>
                                <center>景品交換履歴</center>
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
        </header>

        <div id="content" class="main-content">

            @yield('content')

                <!-- <a href="{{ route('campaign.dashboard', $campaign->id) }}" class="basic_login blue_btn mt-4 totop">ダッシュボード</a> -->

        </div>
        <!--  END CONTENT PART  -->
        
    </div>
    <!-- END MAIN CONTAINER -->
    @if ($page_name != 'account_settings')
        @include('inc.footer_user')
    @endif
    @include('inc.scripts_user')

</body>
</html>
