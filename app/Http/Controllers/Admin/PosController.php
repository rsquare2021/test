<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SplFileObject;

class PosController extends Controller
{
    public function csv()
    {
        return view("admin.pos.csv", [
            'category_name' => 'pos',
            'page_name' => 'pos',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'POSデータアップロード',
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            "csv" => ["required", "file"],
        ]);

        DB::transaction(function() use($request) {
            $csv = $request->file("csv")->openFile();
            // $csv->setFlags(SplFileObject::DROP_NEW_LINE);
            $now = Carbon::now();
            $data = [];
            // 計上日付と給油日付でキーブレイク処理をするので前レコードの値を保存する。
            $prev_cutoff_ymd = "";
            $prev_pay_ymd ="";

            foreach($csv as $i => $row) {
                if($i == 0) continue;
                $row = str_getcsv(mb_convert_encoding($row, "UTF-8", "SJIS"));
                $cutoff_ymd = $row[1];
                $pay_ymd = $row[2];

                // 給油日付のキーブレイク。貯めたデータをインサートし、給油日付に対応するテーブルを生成する。
                if($pay_ymd != $prev_pay_ymd) {
                    // 月も変わった場合、テーブルを作成する。
                    $yyyymm = substr($pay_ymd, 0, 6);
                    $prev_yyyymm = substr($prev_pay_ymd, 0, 6);
                    if($yyyymm != $prev_yyyymm) {
                        $this->insertData($data, $prev_pay_ymd);
                        if(!Schema::connection("wing_data")->hasTable("sales${yyyymm}")) {
                            Schema::connection("wing_data")->create("sales${yyyymm}", function(Blueprint $table) {
                                $table->collation = "utf8mb4_0900_ai_ci";
                                $table->bigIncrements("id");
                                $table->string("ss", 100);
                                $table->string("cut_off_date");
                                $table->string("pay_date");
                                $table->integer("no");
                                $table->integer("time");
                                $table->string("cd", 100);
                                $table->string("count", 100);
                                $table->timestamps();
                            });
                        }
                    }
                }
                
                // 計上日付のキーブレイク。計上日付は昇順にソートされているので、ブレイクしたらその日付データをすべてリセットする。
                if($cutoff_ymd != $prev_cutoff_ymd) {
                    DB::connection("wing_data")->table("sales".substr($pay_ymd, 0, 6))->where("cut_off_date", $cutoff_ymd)->delete();
                }

                if(count($data) >= 1000) {
                    $this->insertData($data, $pay_ymd);
                }

                $data[] = [
                    "ss" => $row[0],
                    "cut_off_date" => $row[1],
                    "pay_date" => $row[2],
                    "no" => $row[3],
                    "time" => $row[4],
                    "cd" => $row[5],
                    "count" => trim($row[6]),
                    "created_at" => $now->toDateTimeString(),
                    "updated_at" => $now->toDateTimeString(),
                ];

                $prev_cutoff_ymd = $row[1];
                $prev_pay_ymd = $row[2];
            }
            $this->insertData($data, $prev_pay_ymd);
        });

        return back();
    }

    private function insertData(&$data, $ymd)
    {
        if(!$data) return;
        DB::connection("wing_data")->table("sales".substr($ymd, 0, 6))->insert($data);
        $data = [];
    }
}
