<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;


class Productcontroller extends Controller
{
    public function showList()
    {
        $model = new Product();
        $products = $model->getList();

        return view('product', ['products' => $products]);
    }

    public function create(){
        return view('product_form');
    }

    public function exeCreate(ProductRequest $request){

        DB::beginTransaction();

        try {
            
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect(route('product'));
    }

    

    
}
