@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')



    <!--  BEGIN FOOTER  -->
    <div class="footer_top">
        <p class="title"><img src="/uploads/{{$campaign->id}}/logo-color-white.svg"> <br class="sp">{{ $campaign->name }}</p>
        <div class="flex">
            <ul>
                <li>
                    <a href="{{ route('campaign.faq', $campaign->id) }}">よくある質問</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ route('campaign.terms', $campaign->id) }}">当サイトのご利用にあたって</a>
                </li>
                <li>
                    <a href="https://www.eneos-wing.co.jp/information/privacy-policy.html" target="_blank">プライバシーポリシー</a>
                </li>
                <li>
                    <a href="https://www.eneos-wing.co.jp/" target="_blank">運営会社</a>
                </li>
            </ul>
        </div>
    </div>
    <!--  END FOOTER  -->

@endif