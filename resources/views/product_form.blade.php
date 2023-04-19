@extends('layouts.app')

@section('content')
<div class="container">

 <h1>商品登録画面</h1>

 <form action="{{ route('submit') }}" method="POST">
    @csrf
  <div class="form-group">
    <label for="product_name">{{ __('商品名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
    <input type="text" class="form-control" name="product_name" id="product_name">
    @if($errors->has('product_name'))
      <p>{{ $errors->first('product_name') }}</p>
    @endif
  </div>

  <div class="form-group">
  <label for="company_id">{{ __('メーカー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
  <input type="text" class="form-control" name="company_id" id="company_id">
    @if($errors->has('company_id'))
      <p>{{ $errors->first('company_id') }}</p>
    @endif
  </div>
  

  <div class="form-group">
    <label for="price">{{ __('価格') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
    <input type="text" class="form-control" name="price" id="price">
    @if($errors->has('price'))
      <p>{{ $errors->first('price') }}</p>
    @endif
  </div>

  <div class="form-group">
    <label for="stock">{{ __('在庫数') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
    <input type="text" class="form-control" name="stock" id="stock">
    @if($errors->has('stock'))
      <p>{{ $errors->first('stock') }}</p>
    @endif
  </div>

  <div class="form-group">
    <label for="comment">{{ __('商品説明') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
    <textarea  class="form-control" name="comment" id="comment"></textarea>
    @if($errors->has('comment'))
      <p>{{ $errors->first('comment') }}</p>
    @endif
  </div>
  <button type="submit">登録</button>

  
 </form>

 <button type="button" onclick="location.href='{{ route('product') }}'">戻る</button>

</div> 
@endsection