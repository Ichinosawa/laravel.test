<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['id', 'product_id'];

public function getstockbyid($id)
{
    $sales = DB::table('products')
    ->select('stock')
    ->where('id',$id)
    ->value('stock');

    return(int)$sales;
}


public function dec($id)
{
    
    // 在庫を減らす処理

    $sales = DB::table('products')
    ->select('products.stock')
    ->where('id' , '=', $id)
    ->decrement('stock', 1);

    return $sales;
}

public function registSales($id)
{
    DB::table('sales')->insert([
       'product_id' => $id,
       'created_at' => NOW(),
       'updated_at' => NOW(),
    ]);
}
}
