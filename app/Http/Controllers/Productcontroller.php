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
        // 商品一覧画面表示
        $product = new Product();
        $company = new Company();
        
        $products = $product->getList();
        $companies = $company->getListcompany();

        return view('product', compact('products','companies'));
        
    }

    public function search(Request $request){
        // 検索機能
        $keyword = $request->input('keyword');

        $product = new Product();
        $company = new Company();

        $products = $product->SearchList($keyword);
        dd($keyword);

        return view('product', compact('products'));
    }

    public function create(){

        // 登録フォーム

       $model = new Product();
       $companies = $model ->getCompanyNameById();

        return view('product_form', compact('companies'));
    }

    public function exeCreate(ProductRequest $request){

        // 登録処理

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
        // 削除機能
        
        $product = Product::find($id);
        
        $product->delete();
        
        return redirect()->route('product');
    }

    public function detail($id)
    {
        // 詳細画面表示
        $product = Product::find($id);

        $company = new Company();

        $companies = $company->getCompanyNameById();

        return view('detail', compact('product','companies'));
    }

    public function edit($id)
    {
        // 編集処理
        $company = new Company();

        $product = Product::find($id);
        $companies = $company->getCompanyNameById($product->company_id);

        return view('edit', compact('product','companies'));
    }

    public function update(ProductRequest $request, $id)
    {
        // 更新処理

        $product = Product::find($id);
        $product->updateProduct($request, $product);
        $companies = $product ->getCompanyNameById();

        return redirect()->route('product', compact('product','companies'));
    }

    
   
    

    
}
