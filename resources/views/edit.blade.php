@extends('layouts.app')

@section('content')
<div class="container small">
  <h1>商品情報編集画面</h1>
  <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="POST">
  @csrf
    <fieldset>
      <div class="form-group">
        <label for="product_name">{{ __('商品名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="product_name" id="product_name" value="{{$product->product_name}}">
        @if($errors->has('product_name'))
         <p>{{ $errors->first('product_name') }}</p>
        @endif
      </div>

      <div class="form-group">
        <label for="company_id">{{ __('メーカー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" name="company_id" id="company_id" value="{{ old('company_id')}}">
         @foreach ($companies as $company)
         <option value='{{$company->id}}'>{{ $company->company_name }}</option>
         @endforeach
        </select>

        @if($errors->has('company_id'))
         <p>{{ $errors->first('company_id') }}</p>
        @endif
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('価格') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="number" class="form-control" name="price" id="price" value="{{$product->price}}">
        @if($errors->has('price'))
         <p>{{ $errors->first('price') }}</p>
        @endif
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('在庫数') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="stock" id="stock" value="{{$product->stock}}">
        @if($errors->has('stock'))
         <p>{{ $errors->first('stock') }}</p>
        @endif
      </div>

      <div class="form-group">
        <label for="product_name">{{ __('コメント') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="comment" id="comment" value="{{$product->comment}}">
        @if($errors->has('comment'))
         <p>{{ $errors->first('comment') }}</p>
        @endif
      </div>

      <div class="form-group">
       <label for="img">{{ __('画像') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
       <input type="file" name="image">
       <img src="{{ asset($product->img_path) }}">
       <button>アップロード</button>
      </div>
    </fieldset>
    <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('product.detail', ['id'=>$product->id]) }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('戻る') }}
        </a>
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
  </form>
</div>
@endsection