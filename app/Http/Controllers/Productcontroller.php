<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;


class Productcontroller extends Controller
{
    public function upload(Request $request)
    {
        // ディレクトリ名
        $dir = 'sample';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        // ファイル情報をDBに保存
        $image = new Image();
        $image->name = $file_name;
        $image->path = 'storage/' . $dir . '/' . $file_name;
        $image->save();


        return redirect('/');
    }


    public function showList(Request $request)
    {
         // 商品一覧画面表示/検索処理

        $keyword = $request->input('keyword');
        $search = $request->input('search');
        $jougenprice = $request->input('jougenprice');
        $kagenprice = $request->input('kagenprice');
        $jougenstock = $request->input('jougenstock');
        $kagenstock = $request->input('kagenstock');
        

       
        $nonon = new Product();

        // メーカーの検索部分の値挿入
        $model = new Company();
        $companies = $model ->getCompanyNameById();


        // ソート機能と検索機能
        $products = $nonon->search($keyword,$search,$jougenprice,$kagenprice,$jougenstock,$kagenstock);

       
            
        return view('product', compact('products','keyword','companies','search','jougenprice','kagenprice','jougenstock','kagenstock'));
           
        
    }

    public function create(){

        // 登録フォーム

       $model = new Company();
       $companies = $model ->getCompanyNameById();

        return view('product_form', compact('companies'));
    }

    public function exeCreate(Request $request){

        // 登録処理

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
        // 削除機能
        $product = Product::find($id);
        
        $product->delete();
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
