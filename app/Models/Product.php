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
        $products= DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->get();

        return $products;
    }


    public function getList(){
        $products = DB::table('products')
        ->join('companies','company_id','=','companies.id')
        ->get();

        return $products;
    }

    public function SearchList($keyword){
        //  検索処理

        //  { $results = DB::table('products') 
        //     ->join('companies', 'products.company_id', '=', 'companies.id') 
        //     ->select('products.company_id', 'products.product_name') 
        //     ->where('products.product_name', 'LIKE', "%{$keyword}%") 
        //     ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%") 
        //     ->paginate(10)
        //     ->get(); 
            // }

           $products=DB::table('products')
           ->join('companies','company_id','=','companies.id')
           ->select('products.*','companies.campanies_name')
           ->where('products.product_name', 'LIKE', "%$keyword%")
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
}
