<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\ApplyStatus;
use App\Models\Campaign;
use App\Models\LotteryType;
use Exception;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    /**
     * キャンペーンの後日抽選を実行する。
     *
     * @param  int $id キャンペーンID
     * @return \Illuminate\Http\Response
     */
    public function execute($id)
    {
        $campaign = Campaign::with(["campaign_type", "products.products"])->find($id);

        if(!$campaign->is_lottery_type()) {
            // エラーログを残して早期リターン
            return back();
        }

        DB::transaction(function() use($campaign) {
            $courses = $campaign->products()->where("lottery_type_id", LotteryType::BULK)->get();
            foreach($courses as $course) {
                $applies = $course->applies;
                foreach($course->products as $cppd) {
                    $applies = $applies->shuffle();
                    $wins = $applies->splice(0, $cppd->win_limit);
                    Apply::whereIn("id", $wins->pluck("id")->toArray())
                        ->update([
                            "campaign_product_id" => $cppd->id,
                            "apply_status_id" => ApplyStatus::WAITING_ADDRESS,
                        ]);
                }
                Apply::whereIn("id", $applies->pluck("id")->toArray())
                    ->update([
                        "apply_status_id" => ApplyStatus::LOST_LOTTERY,
                    ]);
            }
        });

        return back();
    }
}
