<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;


class Productcontroller extends Controller
{
    // public function company() {
    //     $model = new Product();
    //     $products = $model->getCompanyNameById();
    // }

    public function showList(Request $request)
    {
        $product = Product::query();
        

        $keyword = $request->input('keyword');
        

        if(!empty($keyword)) {
            $product->where('product_name', 'LIKE', "%{$keyword}%")
            ->get();
        }

       



            $products = $product->paginate(3);
            

           

            return view('product', compact('products'));
        
    }
    public function create(){

        return view('product_form');
    }

    public function exeCreate(ProductRequest $request){

        DB::beginTransaction();

        try {      
            $model = new Product();
            $model->registProduct($request);
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        
        return redirect(route('product'));
    }

    public function delete($id)
    {
        
        $product = Product::find($id);
        
        $product->delete();
        
        return redirect()->route('product');
    }

    public function detail($id)
    {
        $product = Product::find($id);

        return view('detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->updateProduct($request, $product);

        return redirect()->route('product', compact('product'));
    }

   
    

    
}
