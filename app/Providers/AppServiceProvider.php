<?php

namespace App\Providers;

use App\Facades\UserRoute;
use App\Services\UserRoute as UserRouteService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("user_route", function($app) {
            return new UserRouteService($app->make("request"));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ユーザーページのベースレイアウトに共有データを設定。
        View::composer("layouts.user", function($view) {
            $view->with([
                "user" => UserRoute::user(),
                "point" => UserRoute::point(),
                "campaign" => UserRoute::campaign(),
            ]);
        });
    }
}
