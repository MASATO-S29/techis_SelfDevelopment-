@extends('layouts.app')

@section('content')
<h2>条件検索</h2>
<form action="{{ url('/items') }}" method="GET" style="font-size:20px; padding: 10px;">
    <!-- チェックボックス -->
    <label><input type="checkbox" name="category[]" value="men"> メンズ</label>
    <label><input type="checkbox" name="category[]" value="women"> レディース</label>
    <label><input type="checkbox" name="category[]" value="kids"> キッズ</label>
    <label><input type="checkbox" name="category[]" value="accessories"> 小物</label>
    <label><input type="checkbox" name="category[]" value="bags"> バッグ</label>
    <label><input type="checkbox" name="category[]" value="shoes"> 靴</label>
    <label><input type="checkbox" name="stock[]" value="in_stock"> 在庫あり</label>
    <label><input type="checkbox" name="stock[]" value="out_of_stock"> 在庫なし</label>
    <label><input type="checkbox" name="size[]" value="S"> サイズS</label>
    <label><input type="checkbox" name="size[]" value="M"> サイズM</label>
    <label><input type="checkbox" name="size[]" value="L"> サイズL</label>
    <label><input type="checkbox" name="size[]" value="LL"> サイズLL</label>
    <!-- 並び順 -->
    <div class="sort-order"> 
    <label><input type="radio" name="order" value="new"> 新着順</label>
    <label><input type="radio" name="order" value="asc"> 昇順</label>
    <label><input type="radio" name="order" value="desc"> 降順</label>
    <label><input type="radio" name="order" value="sales"> 売れ行き順</label>
    </div> 

    <!-- 価格帯 -->
    <div class="price-range" style="padding: 10px; >
            <label for="min-price">価格帯: </label>
            <input type="text" id="min-price" placeholder="最小価格">
              <span>円</span> ～ 
            <input type="text" id="max-price" placeholder="最大価格"> <span>円</span>
    </div>
    
    <!-- フリーワード -->
    <div style="padding: 10px; width: 200px;">
        <input type="text" name="keyword" placeholder="フリーワード" >
    </div>

    <!-- 色 -->
      <div style="padding: 10px; margin-bottom: 16px;">
        <select name="color" style="padding: 5px; width: 150px;">
        <option value="">色を選択</option>
        <option value="red">赤</option>
        <option value="blue">青</option>
        <option value="green">白</option>
        <option value="green">黒</option>
        <option value="green">黄</option>
        </select>
      </div>
  

    <!-- 検索開始ボタン -->
    <!-- <button type="submit">条件検索開始</button> -->
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            条件検索開始
        </button>
    </div>
</form>

<h3>検索履歴</h3>
<ul>
    <li><a href="{{ url('/items') }}?category[]=men&order=desc">メンズ商品 - 新着順</a></li>
    <li><a href="{{ url('/items') }}?category[]=women&order=asc">レディース商品 - 昇順</a></li>
</ul>

@endsection

@section('css')
<style>
  .h2{
  text-align: center; 
  }
</style>
@stop

@section('js')
@stop