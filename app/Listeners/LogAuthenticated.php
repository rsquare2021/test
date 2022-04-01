<?php

namespace App\Listeners;

use App\Models\Admin;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        if($event->user instanceof Admin) {
            // updated_atを更新しないようにする。
            DB::table("admins")->where("id", $event->user->id)->update(["latest_login_at" => now()]);
        }
    }
}
