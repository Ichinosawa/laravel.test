<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.company_name')
            ->get();
    }


    public function getList(){
        $products = DB::table('products')->get();

        return $products;
    }

    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'company_id' => $data->company_id,
        ]);
    }

    public function updateProduct($request, $product)
    {
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
}
