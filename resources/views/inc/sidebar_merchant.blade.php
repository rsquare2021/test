@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN TOPBAR  -->
    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="/merchant/list/">
                        <img src="{{asset('public/storage/img/logo2.svg')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="/merchant/list/" class="nav-link"> NEXT SS システム </a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories" id="topAccordion">
                <li class="menu  {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                    <a href="/merchant/list/">
                        <div class="">
                            <span>リスト</span>
                        </div>
                    </a>
                </li>
                <li class="menu  {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                    <a href="/merchant/work/list/">
                        <div class="">
                            <span>作業履歴</span>
                        </div>
                    </a>
                </li>
                @if($kengen == 1)
                <li class="menu  {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                    <a href="{{ route('merchant.user') }}">
                        <div class="">
                            <span>スタッフ管理</span>
                        </div>
                    </a>
                </li>
                @endif
            </ul>
            
        </nav>
        
        <h5 class="title mt-3">{{ $title }}</h5>
        
    </div>
    <!--  END TOPBAR  -->

@endif