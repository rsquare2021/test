
    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-text">
                    <a href="index.html" class="nav-link"> NEXT SS システム </a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories" id="topAccordion">
                
                <li class="menu">
                    <a href="{{ route('admin.home') }}" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span>管理画面</span>
                        </div>
                    </a>
                </li>

                <li class="menu single-menu">
                    <a href="#app" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            <span>キャンペーン管理</span>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled">
                        <li><a href="{{ route('admin.project.index') }}"> キャンペーン一覧 </a></li>
                        
                            <li><a href="{{ route('admin.project.create') }}"> キャンペーン追加 </a></li>
                            <li><a href="{{ route('admin.project.download.shippingCsv.select') }}"> CSVダウンロード </a></li>
                            <li><a href="{{ route('admin.pos.csv') }}"> POSデータアップロード </a></li>
                    </ul>
                </li>

                
                    <li class="menu single-menu">
                        <a href="#uiKit" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                <span>景品管理</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled">
                            <li><a href="{{ route('admin.product.index') }}"> 景品一覧 </a></li>
                            <li><a href="{{ route('admin.product.create') }}"> 景品追加 </a></li>
                            <li><a href="{{ route('admin.preset.index') }}"> 景品プリセット一覧 </a></li>
                            <li><a href="{{ route('admin.preset.create') }}"> 景品プリセット追加 </a></li>
                            <li><a href="{{ route('admin.product_cat.index') }}"> 景品カテゴリー一覧 </a></li>
                            <li><a href="{{ route('admin.product_cat.create') }}"> 景品カテゴリー追加 </a></li>
                        </ul>
                    </li>
                
                    <li class="menu single-menu">
                        <a href="#tables" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                <span>ユーザー管理</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="tables"  data-parent="#topAccordion">
                            <li><a href="{{ route('admin.user.index') }}"> ユーザーリスト </a></li>
                            <li><a href="{{ route('admin.user.create') }}"> ユーザー追加 </a></li>
                            <li><a href="{{ route('admin.shop_tree.edit', 1) }}"> 店舗設定 </a></li>
                            
                                <li><a href="{{ route('admin.shop_tree.create') }}"> ツリー追加 </a></li>
                            
                        </ul>
                    </li>
                

                <li class="menu single-menu">
                    <a href="#forms" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            <span>レシート管理</span>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled">
                        <li><a href="{{ route('admin.receipt.list') }}"> レシート一覧 </a></li>
                        <li><a href="{{ route('admin.meken.list') }}"> 目検一覧 </a></li>
                        <li><a href="{{ route('admin.meken.work') }}"> 目検業者管理 </a></li>
                    </ul>
                </li>

                <li class="menu single-menu">
                    <a href="#more" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span>エンドユーザー</span>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled">
                        <li class=""><a href="{{ route('admin.enduser.list') }}"> エンドユーザー一覧 </a></li>
                    </ul>
                </li>

            </ul>
            
        </nav>
        
        <h5 class="title mt-3">{{ $title }}</h5>
        
    </div>
