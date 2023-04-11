<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;


class Productcontroller extends Controller
{
    public function company() {
        $model = new Product();
        $products = $model->getCompanyNameById();

    }

    public function showList(Request $request)
    {
        $model = new Product();
        $products = $model->getList();

        return view('product',compact('products'));
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

    public function search(ProductRequest $request) {
        $products = Product::paginate(20);

        $search = $request->input('search');

        $query = Product::query();

        
        $products = Product::$query->where('product_name', 'like', "%($request->search)%")
        ->orwhere('comment', 'like', "%($request->search)%")
        ->paginate(20);

        return view('product', compact('products'));
    } 
    

    
}
