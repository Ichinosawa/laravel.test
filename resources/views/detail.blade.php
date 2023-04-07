@extends('layouts.app')

@section('content')
<h1>詳細確認</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>画像</th>
      <th>商品名</th>
      <th>メーカー</th>
      <th>価格</th>
      <th>在庫数</th>
      <th>コメント</th>
      <th>編集</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>{{ $product->img_path }}</td>
    <td>{{ $product->product_name }}</td>
    <td>{{ $product->company_id }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->stock }}</td>
    <td>{{ $product->comment }}</td>
    <td><a href="{{ route('product.edit', ['id'=>$product->id]) }}" class="btn btn-primary">編集</a></td>
    </tr>

    <button type="button" onclick="location.href='{{ route('product') }}'"> 戻る </button>
  </tbody>
</table>
@endsection