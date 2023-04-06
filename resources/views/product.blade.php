@extends('layouts.app')

@section('content')
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
      <td>{{ $product->company_id }}</td>
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

    <button type="button" onclick="location.href='{{ route('product_form') }}'"> 商品登録 </button>
  </tbody>
</table>


@endsection