<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;


class SalesController extends Controller
{
    //在庫を減算する
 
public function sub(Request $request)
{

    DB::beginTransaction();

    try {      
        $model = new Sales();
        $salesid = $request->input('product_id');

        $st = $model->getstockbyid($salesid);

        if($st === 0){
            return response()->json(['error' => '購入できません。'],400);
        }

        $model->dec($salesid);

        $model->registSales($salesid);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

   return response()->json(['message' => $st],200);
}
}