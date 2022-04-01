<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function mekenList(Request $request)
    {
        return view("admin.re.master.meken", [
            'category_name' => 'master',
            'page_name' => 'master_meken',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検ステータスマスター',
        ]);
    }
}
