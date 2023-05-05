<!-- 商品一覧画面 -->

@extends('layouts.app')

@section('content')

<div class="search">
  <form action="{{ route('product') }}" method="GET">
  @csrf
  <!-- 検索フォーム -->
  <div class="product_name.search">
  <label for="product_name">{{ __('商品名') }}</label>
    <input type="text" name="keyword" id="keyword" >
  </div>  

  <div class="company_name.serch">
  <label for="company_name">{{ __('メーカー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" name="company_name" id="company_name">
          <option>{{"メーカーを選択してください"}}</option>
        @foreach ($companies as $company)
         <option name="keyword" id="keyword" >{{ $company->company_name }}</option>
         @endforeach
        </select>
       
  </div>
  
  <input type="submit" value="検索">
  </form>
</div>

<h1>商品一覧</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th></th>  
      <th>商品名</th>
      <th>メーカー</th>
      <th>価格</th>
      <th>在庫数</th>
      <th>商品説明</th>
      <th>画像</th>
      <th>作成日</th>
      <th>更新日</th>
      <th>詳細</th>
      <th>削除</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->product_name }}</td>
      <td>{{ $product->company_name }}</td>
      <td>{{ $product->price }}</td>
      <td>{{ $product->stock }}</td>
      <td>{{ $product->comment }}</td>
      <td>{{ $product->img_path }}</td>
      <td>{{ $product->created_at }}</td>
      <td>{{ $product->updated_at }}</td>
      <td><a href="{{ route('product.detail', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
      <td>
        <form action="{{ route('product.destroy', ['id'=>$product->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </td>
    </tr>
    @endforeach

    <div>
    
   
   
    </div>

    <button type="button" onclick="location.href='{{ route('product_form') }}'"> 商品登録 </button>
  </tbody>
</table>


@endsection