<!-- 商品一覧画面 -->

@extends('layouts.app')

@section('content')

<div id="table-striped">
<div class="search" >
  <form method="GET" id="search">
  @csrf
  <!-- 検索フォーム -->
  <div class="product_name.search">
  <label for="product_name">{{ __('商品名') }}</label>
    <input type="text" name="keyword" id="keyword" >
  </div>  

  <div class="company_name.serch">
  <label for="company_name">{{ __('メーカー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" name="search" >
          <option>{{"メーカーを選択してください"}}</option>
          <option>{{""}}</option>
        @foreach ($companies as $company)
         <option>{{ $company->company_name }}</option>
         @endforeach
        </select>
  </div>

  <div class="price.search">
    <label for="price">{{ __('価格') }}</label>

    <div class="jougen">
    <p>{{ __('上限') }}</p>
    <input type="number" name="jougenprice" id="jougenprice" >
    </div>

    <div class="kagen">
    <p>{{ __('下限') }}</p>
    <input type="number" name="kagenprice" id="kagenprice" >
    </div>

  </div>

  <div class="stock.serach">
  <label for="stock">{{ __('在庫数') }}</label>

    <div class="jougen">
    <p>{{ __('上限') }}</p>
    <input type="number" name="jougenstock" id="jougenstock" >
    </div>

    <div class="kagen">
    <p>{{ __('下限') }}</p>
    <input type="number" name="kagenstock" id="kagenstock" >
    </div>

  </div>
  
  <button type="submit" value="検索" id="kensaku">検索</button>
  </form>
</div>

<h1>商品一覧</h1>

<table class="table table-striped" id="product-table">
  <thead>
    <tr>
      <th>@sortablelink('id', 'ID')</th>  
      <th>@sortablelink('product_name', '商品名')</th>
      <th>@sortablelink('company_name', 'メーカー')</th>
      <th>@sortablelink('price', '価格')</th>
      <th>@sortablelink('stock', '在庫数')</th>
      <th>@sortablelink('comment', 'コメント')</th>
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
      <td><form method="POST" action="/upload" enctype="multipart/form-data">
  @csrf
  <input type="file" name="image">
  <img src="{{ asset($image->path) }}">
  <button>アップロード</button>
 </form>
 </td>
      <td>{{ $product->created_at }}</td>
      <td>{{ $product->updated_at }}</td>
      <td><a href="{{ route('product.detail', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
      <td>
        <form id="sakujo-form">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger sakujoBtn" name="sakujo" data-product-id="{{$product->id}}">削除</button>
        </form>
      </td>
    </tr>
    @endforeach

    <div>
    
   
   
    </div>

    <button type="button" onclick="location.href='{{ route('product_form') }}'"> 商品登録 </button>
  </tbody>
</table>
</div>


@endsection