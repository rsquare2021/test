<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/_merchant/auth_login.php', function() {
    ddd('test');
    $data = [
        'category_name' => 'dashboard',
        'page_name' => 'analytics',
        'has_scrollspy' => 0,
        'scrollspy_offset' => '',
    ];
    return view('dashboard')->with($data);
});

Route::middleware("auth:admin")->get("/", "Admin\CampaignController@index");

// 管理業務
Route::group(['middleware' => 'checkIP'], function () {
    Route::namespace("Admin")->name("admin.")->prefix("admin")->group(function() {

        // ログイン
        Auth::routes([
            "register" => false,
            "reset" => true,
            "verify" => false,
        ]);

        Route::middleware("auth:admin")->group(function() {
            Route::get("/", "CampaignController@index")->name("home");

            // NextTube、FLINT、Rスクエアのみアクセスできる。
            Route::middleware("can:developer")->group(function() {
                Route::middleware("can:super_admin")->group(function() {
                    // 会社
                    // Route::resource("company", "CompanyController", ["only" => ["index", "create", "store", "edit", "update"]]);
                    // 店舗ツリー
                    Route::resource("shop_tree", "ShopTreeController", ["only" => ["create", "store", "destroy"]]);
                    // 景品
                    Route::resource("product", "ProductController", ["only" => ["index", "create", "store", "edit", "update"]]);
                    Route::get("product/{id}/delete", "ProductController@destroy")->name("product.destroy");
                    Route::get("product/csv", "ProductController@uploadCsv")->name("product.upload");
                    Route::post("product/csv", "ProductController@importCsv")->name("product.import");
                    // 景品カテゴリー
                    Route::resource("product/product_cat", "ProductCategoryController", ["only" => ["index", "create", "store", "edit", "update"]]);
                    // 景品プリセット
                    Route::resource("product/preset", "ProductPresetController", ["only" => ["index", "create", "store", "edit", "update", "destroy"]]);
                });
            });

            // スーパー管理ユーザーのみアクセスできる。
            Route::middleware("can:super_admin")->group(function() {
                // 管理ユーザー
                Route::resource("user", "AccountController", ["only" => ["index", "create", "store", "edit", "update", "destroy"]]);
                Route::middleware("can:editable_admin,user")->group(function() {
                    Route::get('user/{user}/charge/edit', "AccountController@charge")->name("user.charge.edit");
                    Route::put("user/{user}/charge/", "AccountController@updateCharge")->name("user.charge.update");
                });

                // 店舗ツリー
                Route::resource("shop_tree", "ShopTreeController", ["only" => ["edit", "update"]]);
                Route::middleware("can:editable_shop_tree_element,Shop_tree")->group(function() {
                    Route::get("shop_tree/{Shop_tree}/download", "ShopTreeController@download")->name("shop_tree.download");
                    // 店舗情報
                    Route::get("shop/{Shop_tree}/edit", "ShopTreeController@editShop")->name("shop.edit");
                    Route::post("shop/{Shop_tree}/update", "ShopTreeController@updateShop")->name("shop.update");
                });

                // キャンペーン
                Route::resource("project", "CampaignController", ["only" => ["create", "store"]]);
                Route::middleware("can:editable_campaign,project")->group(function() {
                    Route::get("/project/{project}/copy", "CampaignController@createCopy")->name("project.copy.create");
                    Route::post("/project/{project}/copy", "CampaignController@storeCopy")->name("project.copy.store");
                    // キャンペーン抽選
                    Route::get("/project/{project}/lottery", "LotteryController@execute")->name("project.lottery");
                    // 応募一覧
                    Route::get("/project/{project}/apply", "ApplyController@index")->name("project.apply");
                    Route::post("/project/{project}/apply/status", "ApplyController@changeStatus")->name("project.apply.status");
                });
                // 景品交換CSVダウンロード
                Route::get("/download/ShippingCsv/", "ProductController@shippingCsvSelect")->name("project.download.shippingCsv.select");
                Route::get("/download/ShippingCsv/send", "ProductController@exportSelectShippingCsv")->name("project.download_select_shipping_csv");
                Route::get("/downloadShippingCsv/{yyyymmdd}", "ProductController@exportShippingCsv")->name("project.download_shipping_csv");
                // POSレジデータアップロード
                Route::get("/pos/csv", "PosController@csv")->name("pos.csv");
                Route::post("/pos/csv/upload", "PosController@upload")->name("pos.csv.upload");
                //phpMyAdmin
                Route::group(['middleware' => 'checkIP'], function () {
                    Route::group(['middleware' => 'basicauth'], function () {
                        Route::get("/database", "AccountController@database")->name("database");
                    });
                });
            });
            
            // 一般管理ユーザー・スーパー管理ユーザーがアクセスできる。
            Route::middleware("can:regular_admin")->group(function() {
                // キャンペーン
                Route::resource("project", "CampaignController", ["only" => ["index", "edit", "update"]]);
                Route::middleware("can:editable_campaign,project")->group(function() {
                    // キャンペーン店舗確認・編集
                    Route::get("/project/{project}/shop/edit", "CampaignController@editShops")->name("project.shop.edit");
                    Route::put("/project/{project}/shop", "CampaignController@updateShops")->name("project.shop.update");
                    // キャンペーン景品追加
                    Route::get("/project/{project}/product/lottery/edit", "CampaignProductController@editLotteryGift")->name("project.product.edit.lottery");
                    Route::put("/project/{project}/product/lottery", "CampaignProductController@updateLotteryGift")->name("project.product.update.lottery");
                    Route::match(["get", "put"], "/project/{project}/product/catalog/edit", "CampaignProductController@editCatalogGift")->name("project.product.edit.catalog");
                    Route::put("/project/{project}/product/catalog", "CampaignProductController@updateCatalogGift")->name("project.product.update.catalog");
                    // Route::get("/project/{project}/product/create", "CampaignProductController@create")->name("project.product.create");
                });
                // エンドユーザー一覧
                Route::get("enduser", "EnduserController@index")->name("enduser.list");
                // レシート管理
                Route::get("re", "ReceiptController@index")->name("receipt.list");
                // レシート画像取得
                Route::get("re/img/get", "ReceiptController@imgGet")->name("receipt.img.get");
                // 目検一覧
                Route::get("re/list", "ReceiptController@mekenList")->name("meken.list");
                // 目検詳細
                Route::get("re/{re_id}", "ReceiptController@mekenDetail")->name("meken.detail");
                Route::post("re/{re_id}/edit", "ReceiptController@mekenEdit")->name("meken.edit");
                // 目検業者管理
                Route::get("/re/work/list", "ReceiptController@mekenWorks")->name("meken.work");
                // 目検ステータスマスター管理
                Route::get("/re/master/meken", "master@meken")->name("master.meken");
                // 読み取りステータスマスター管理
                Route::get("/re/work/yomitori", "master@yomitori")->name("master.yomitori");
            });

            // プロフィール
            Route::get("/profile", "AccountController@editProfile")->name("profile.edit");
            Route::put("/profile", "AccountController@updateProfile")->name("profile.update");
        });
    });
});
    
/////////////////////////////////////////////////////////////
// 目検画面
/////////////////////////////////////////////////////////////
// 目検ログイン
Route::group(['middleware' => 'checkIP'], function () {
    Route::get("/merchant/login", "Merchant\LoginController@index")->name("merchant.meken.login");
    Route::post("/merchant/login/send", "Merchant\LoginController@login")->name("merchant.meken.login.send");
    // 目検業者ログアウト
    Route::get("/merchant/logout/logout", "Merchant\ReceiptController@logout")->name("merchant.logout");
    // 目検ユーザー一覧
    Route::get("/merchant/user/", "Merchant\UserController@index")->name("merchant.user");
    // 目検ユーザー追加
    Route::get("/merchant/user/create", "Merchant\UserController@create")->name("merchant.user.create");
    // 目検ユーザー追加更新
    Route::post("/merchant/user/create/add", "Merchant\UserController@insert")->name("merchant.user.create.add");
    // 目検ユーザー編集
    Route::get("/merchant/user/{mk_user_id}", "Merchant\UserController@edit")->name("merchant.user.edit");
    // 目検ユーザー編集更新
    Route::post("/merchant/user/{mk_user_id}/update", "Merchant\UserController@update")->name("merchant.user.edit.update");
    // 目検ユーザー稼働切り替え
    Route::post("/merchant/user/active", "Merchant\UserController@active")->name("merchant.user.active");
    // 目検一覧
    Route::get("/merchant/list", "Merchant\ReceiptController@mekenList")->name("merchant.meken.list");
    // 目検詳細
    Route::get("/merchant/{re_id}", "Merchant\ReceiptController@mekenDetail")->name("merchant.meken.detail");
    Route::post("/merchant/{re_id}/edit", "Merchant\ReceiptController@mekenEdit")->name("merchant.meken.edit");
    // 目検作業履歴
    Route::get("/merchant/work/list", "Merchant\ReceiptController@mekenWorks")->name("merchant.meken.work");
    // レシート画像取得
    Route::get("/merchant/img/get", "Merchant\ReceiptController@imgGet")->name("merchant.img.get");
});

/////////////////////////////////////////////////////////////
// エンドユーザーここから
/////////////////////////////////////////////////////////////
Route::namespace("User")->name("campaign.")->group(function() {
    // 1_1_ログイン & キャンペーン概要 & 不参加のリダイレクト先
    Route::get('/{campaign_id}', "Auth\LoginController@showLoginForm")->name("login");
    Route::post("/{campaign_id}", "Auth\LoginController@login");
    Route::post("/{campaign_id}/logout", "Auth\LoginController@logout")->name("logout");
    // 2_1_アカウント作成（選択画面）
    Route::get('/{campaign_id}/signup', "Auth\RegisterController@selectRegistrationMethod")->name("register.method");
    // 2_2_アカウント作成（メール：入力）
    Route::get('/{campaign_id}/signup/mail', "Auth\RegisterController@showRegistrationForm")->name("register");
    Route::post("/{campaign_id}/signup/mail", "Auth\RegisterController@register")->name("register");
    // 2_4_アカウント仮登録完了（メール）
    Route::get('/{campaign_id}/signup/mail/pre_complete', "Auth\RegisterController@precomplete")->name("register.precomplete");
    // 2_5_アカウント登録完了（共通）
    Route::get('/{campaign_id}/signup/{method}/complete', "Auth\VerificationController@complete")->where(["method" => "register|update"])->name("verification.complete");
    // 2_6_パスワード再発行
    Route::get('/{campaign_id}/password/reset', "Auth\ForgotPasswordController@showLinkRequestForm")->name("password.request");
    // 2_7_パスワード再発行URL送信画面
    Route::post("/{campaign_id}/password/email", "Auth\ForgotPasswordController@sendResetLinkEmail")->name("password.email");
    // 2_8_新パスワード入力
    Route::get("/{campaign_id}/password/reset/{token}", "Auth\ResetPasswordController@showResetForm")->name("password.reset");
    Route::post("/{campaign_id}/password/reset", "Auth\ResetPasswordController@reset")->name("password.update");
    // 2_9_メールアドレス設定 & 変更
    Route::get('/{campaign_id}/mail/change', "Auth\VerificationController@editEmail")->name("email.edit");
    // 2_10_メールアドレス確認URL送信画面
    Route::put("/{campaign_id}/mail/change/send", "Auth\VerificationController@updateEmail")->name("email.update");
    Route::get("/{campaign_id}/email/verify/{method}/{id}/{hash}", "Auth\VerificationController@verify")->where(["method" => "register|update"])->name("verification.verify");
    // Route::get("/{campaign_id}/email/verify", "Auth\VerificationController@show")->name("verification.notice");
    // 6_1_景品一覧（ポイントカタログ）
    Route::get('/{campaign_id}/list', "CatalogGiftController@pre_list")->name("top.catalog.gift.index");
    // 6_2_景品詳細（ポイントカタログ）
    Route::get('/{campaign_id}/list/{gift_id}', "CatalogGiftController@pre_show")->name("top.catalog.gift.show");
    // 9_1_よくある質問
    Route::get('/{campaign_id}/faq', "CampaignGuideController@faq")->name("faq");
    // 9_2_当サイトのご利用にあたって
    Route::get('/{campaign_id}/terms', "CampaignGuideController@terms")->name("terms");
    // プライバシーポリシー
    Route::get('/{campaign_id}/privacypolicy', "CampaignGuideController@privacypolicy")->name("privacypolicy");
    // giftee Box 商品ラインナップ
    Route::get('/{campaign_id}/point/gift/gifteebox/intro', "CampaignGuideController@gifteebox")->name("gifteebox");
    // えらべるPay 商品ラインナップ
    Route::get('/{campaign_id}/point/gift/selectablepay/intro', "CampaignGuideController@selectablepay")->name("selectablepay");
    // メールアドレス確認URL送信画面（再送信用）
    Route::get('/{campaign_id}/signup/mail_velify', "Auth\VerificationController@resendVerificationEmail")->name("email.resend");
    Route::post("/{campaign_id}/email/resend", "Auth\VerificationController@resend")->name("verification.resend");
    // キャンペーン期間外アクセス
    Route::get('/{campaign_id}/out_term', "CampaignGuideController@out_term")->name("out_term");
});

Route::namespace("User")->group(function() {
    // LINEログイン
    Route::get("/{campaign_id}/login/{provider}", "Auth\LoginController@redirectToProvider")->name("campaign.login.provider");
    Route::get("/login/{provider}/callback", "Auth\LoginController@handleProviderCallback");
});

Route::middleware("auth:user", "verified")->namespace("User")->name("campaign.")->group(function() {
    // 2_11_キャンペーン参加
    Route::get('/{campaign_id}/confirm', "Auth\LoginController@confirmToJoinCampaign")->name("entry");
    Route::post("/{campaign_id}/confirm", "Auth\LoginController@joinCampaign");
});

Route::middleware("auth:user", "joined", "verified.emailuser")->namespace("User")->name("campaign.")->group(function() {
    // 3_1_ダッシュボード
    Route::get('/{campaign_id}/dashboard', "HomeController@dashboard")->name("dashboard");
    // 5_1_レシート送信履歴
    Route::get('/{campaign_id}/dashboard/serial', "ReceiptController@index")->name("receipt.index");
    // 6_1_景品一覧（ポイントカタログ）
    Route::get('/{campaign_id}/dashboard/point/gift', "CatalogGiftController@index")->name("catalog.gift.index");
    // 6_2_景品詳細（ポイントカタログ）
    Route::get('/{campaign_id}/dashboard/point/gift/{gift_id}', "CatalogGiftController@show")->name("catalog.gift.show");
    // 6_2_景品詳細（ポイントカタログ）
    Route::get('/{campaign_id}/dashboard/point/gift/{gift_id}/error', "CatalogGiftController@error")->name("catalog.gift.error");
    Route::group(['middleware' => 'checkApplyTerm'], function () {
        // 8_1_レシート撮影カメラ画面
        Route::get('/{campaign_id}/dashboard/snap', "ReceiptController@snap")->name("receipt.snap");
        // 8_2_レシート撮影送信完了
        Route::get('/{campaign_id}/dashboard/snap/complete', "ReceiptController@snapComplete")->name("receipt.snap.complete");
        // 8_3_レシート撮影送信エラー
        Route::get('/{campaign_id}/dashboard/snap/error', "ReceiptController@snapError")->name("receipt.snap.error");
        // 8_4_送信前処理
        Route::post('/{campaign_id}/dashboard/snap/before_post_receipt', "ReceiptController@snapBefore")->name("receipt.snap.before");
        // 8_5_送信処理
        Route::post('/{campaign_id}/dashboard/snap/post_receipt', "ReceiptController@snapSend")->name("receipt.snap.send");
    });
});

Route::middleware("auth:user", "joined", "verified")->namespace("User")->name("campaign.")->group(function() {
    // 2_11_パスワード登録&変更画面
    Route::get("/{campaign_id}/password/change", "Auth\ChangePasswordController@index")->name("password.change");
    // 2_12_パスワード登録&変更画面
    Route::post("/{campaign_id}/password/change/send", "Auth\ChangePasswordController@update")->name("password.change.update");
    // 4_1_交換履歴一覧
    Route::get('/{campaign_id}/dashboard/exchange', "ApplyHistoryController@index")->name("apply.index");
    // 4_3_交換履歴発送先編集
    Route::get('/{campaign_id}/dashboard/exchange/{exchange_id}/edit', "ApplyHistoryController@editAddress")->name("apply.address.edit");
    Route::group(['middleware' => 'checkApplyTerm'], function () {
        // 4_5_交換履歴発送先編集完了
        Route::put("/{campaign_id}/dashboard/exchange/{exchange_id}", "ApplyHistoryController@updateAddress")->name("apply.address.update");
        // 4_6_交換履歴キャンセル確認
        Route::get('/{campaign_id}/dashboard/exchange/{exchange_id}/cancel/confirm', "ApplyHistoryController@confirmToCancelApply")->name("apply.cancel.confirm");
        // 4_7_交換履歴キャンセル完了
        Route::post('/{campaign_id}/dashboard/exchange/{exchange_id}/cancel', "ApplyHistoryController@cancelApply")->name("apply.cancel");
        // 6_3_発送先の入力（ポイントカタログ型）
        Route::post('/{campaign_id}/dashboard/point/gift/{gift_id}', "CatalogApplyController@setProductToApply")->name("catalog.gift.apply.set_product");
        Route::get('/{campaign_id}/dashboard/point/gift/{gift_id}/order', "CatalogApplyController@editAddressToApply")->name("catalog.gift.apply.address");
        // 6_5_景品交換完了（ポイントカタログ交換）
        Route::post('/{campaign_id}/dashboard/point/gift/{gift_id}/order/complete', "CatalogApplyController@setAddressToApply")->name("catalog.gift.apply.set_address");
    });
    // 7_1_お問い合わせ
    Route::get('/{campaign_id}/inquiry', 'ContactController@index')->name('contact.index');
    // 7_2_お問い合わせ確認
    Route::post('/{campaign_id}/inquiry/confirm', 'ContactController@confirm')->name('contact.confirm');
    // 7_3_お問い合わせ完了
    Route::post('/{campaign_id}/inquiry/thanks', 'ContactController@send')->name('contact.send');
});
/////////////////////////////////////////////////////////////
// エンドユーザーここまで
/////////////////////////////////////////////////////////////





Route::get('/analytics', function() {
    // $category_name = '';
    $data = [
        'category_name' => 'dashboard',
        'page_name' => 'analytics',
        'has_scrollspy' => 0,
        'scrollspy_offset' => '',
    ];
    return view('dashboard')->with($data);
});

    Route::get('/analytics', function() {
        // $category_name = '';
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        // $pageName = 'analytics';
        return view('dashboard')->with($data);
    });
    
    Route::get('/sales', function() {
        // $category_name = '';
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'sales',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'タイトル',
        ];
        // $pageName = 'sales';
        return view('dashboard2')->with($data);
    });

    // Authentication
    Route::prefix('authentication')->group(function () {
        Route::get('/lockscreen_boxed', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_boxed',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_boxed';
            return view('pages.authentication.auth_lockscreen_boxed')->with($data);
        });
        Route::get('/lockscreen', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_default',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_default';
            return view('pages.authentication.auth_lockscreen')->with($data);
        });
        Route::get('/login_boxed', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_boxed',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_boxed';
            return view('pages.authentication.auth_login_boxed')->with($data);
        });
        Route::get('/login', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_default',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_default';
            return view('pages.authentication.auth_login')->with($data);
        });
        Route::get('/pass_recovery_boxed', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_boxed',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_boxed';
            return view('pages.authentication.auth_pass_recovery_boxed')->with($data);
        });
        Route::get('/pass_recovery', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_default',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_default';
            return view('pages.authentication.auth_pass_recovery')->with($data);
        });
        Route::get('/register_boxed', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_boxed',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_boxed';
            return view('pages.authentication.auth_register_boxed')->with($data);
        });
        Route::get('/register', function() {
            // $category_name = 'auth';
            $data = [
                'category_name' => 'auth',
                'page_name' => 'auth_default',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            // $pageName = 'auth_default';
            return view('pages.authentication.auth_register')->with($data);
        });
    });