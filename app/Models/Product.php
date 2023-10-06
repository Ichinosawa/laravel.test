<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use Kyslik\ColumnSortable\Sortable;

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
    
        // ソート機能
    use Sortable;

    public function getCompanyNameById() {
        // テーブル結合
        $products= DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->get();

        return $products;
    }

    public function registProduct($data,$image_path) {
        // 登録処理
        DB::table('products') ->insert([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
            'company_id' => $data->company_id,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

    }

    public function updateProduct($request, $product,$image_path)
    {
        // 更新処理
        $result = $product->fill([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $image_path,
            'updated_at' => NOW(),
            'company_id' => $request->company_id
        ])->save();

        return $result;
    }

    public function search($keyword,$search,$jougenprice,$kagenprice,$jougenstock,$kagenstock)
    {
        
        // 検索処理
        $products = DB::query();

     

        // ソート機能とテーブル結合
        $products= Product::sortable('products')
        ->join('companies','company_id','=','companies.id')
        ->select('products.*','companies.company_name','products.price','products.stock');

        if($keyword){
            $products->where('product_name', 'LIKE', "%$keyword%");
        }

        if($search){
            $products->where('company_name', 'LIKE', "%$search%");
        }

        if($jougenprice){
            $products->where('price','<',$jougenprice);
        }

        if($kagenprice){
            $products->where('price','>',$kagenprice);
        }

        if($jougenstock){
            $products->where('stock','<',$jougenstock);
        }

        if($kagenstock){
            $products->where('stock','>',$kagenstock);
        }

        $product = $products->get();

        return $product;
      
    }
    
}
