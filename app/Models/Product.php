<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'company_id',
        'created_at',
        'updated_at'
    ];

    public function getCompanyNameById() {
        // テーブル結合
        $products= DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->get();

        return $products;
    }

    public function registProduct($data) {
        // 登録処理
        DB::table('products') ->insert([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'company_id' => $data->company_id,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

    }

    public function updateProduct($request, $product)
    {
        // 更新処理
        $result = $product->fill([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
            'updated_at' => NOW(),
            'company_id' => $request->company_id
        ])->save();

        return $result;
    }

    public function search($keyword,$search,$jougenprice,$kagenprice)
    {
        // 検索処理
        $products = DB::query();

        $products= DB::table('products')
        ->join('companies','company_id','=','companies.id')
        ->select('products.*','companies.company_name');

        if($keyword){
            $products->where('product_name', 'LIKE', "%$keyword%");
        }

        if($search){
            $products->where('company_name', 'LIKE', "%$search%");
        }

        // 確認していただきたいところ
        if($jougenprice){
            $products->where('price',max('$jougenprice'))->first();
        }

        if($kagenprice){
            $products->where('price',min('$kagenprice'))->first();
        }


        $product= $products->get();

        return $product;
      
    }
    
}
