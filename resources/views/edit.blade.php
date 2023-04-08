@extends('layouts.app')

@section('content')
<div class="container small">
  <h1>商品情報編集画面</h1>
  <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="POST">
  @csrf
    <fieldset>
      <div class="form-group">
        <label for="product_name">{{ __('商品名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="product_name" id="product_name">
      </div>

      <div class="form-group">
        <label for="company_id">{{ __('メーカー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="company_id" id="company_id">
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('価格') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="price" id="price">
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('在庫数') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="stock" id="stock">
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('コメント') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="comment" id="comment">
      </div>
    </fieldset>
    <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('product') }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
  </form>
</div>
@endsection