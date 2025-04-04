@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>商品一覧</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- < class="card-header"> -->
            <h3>検索</h3>
            <!-- 検索エリア -->
            <form action="{{ route('item.index') }}" method="GET">
                <div class="form-group">
                    <!-- 検索 -->
                    <!-- 価格帯 -->
                    <div class="price-range">
                        <label for="min-price">価格帯: </label>
                        <input type="text" id="min-price" placeholder="最小価格">
                        <span>円</span> ～
                        <input type="text" id="max-price" placeholder="最大価格"> <span>円</span>
                    </div>

                    <div><!-- 並べ替え -->
                        <select name="sort_by">
                            <option value="price_asc" {{ request()->sort_by == 'price_asc' ? 'selected' : '' }}>安い順</option>
                            <option value="price_desc" {{ request()->sort_by == 'price_desc' ? 'selected' : '' }}>高い順</option>
                            <option value="name_asc" {{ request()->sort_by == 'name_asc' ? 'selected' : '' }}>昇順</option>
                            <option value="name_desc" {{ request()->sort_by == 'name_desc' ? 'selected' : '' }}>降順</option>
                        </select>
                    </div>
                    <label for="keyword">
                        キーワード検索:</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" style="width: 40%;" value="{{ old('keyword', $keyword) }}" placeholder="商品名や説明で検索">

                </div>
                <div class="input-group input-group-sm" class="button-container">
                    <button type="submit" class="btn btn-primary" style="text-align: center;">検索</button>
                    <a href="{{ url('items/add') }}" class="btn btn-primary" class="register-button" style="text-right;" font-size:20px;>商品登録</a>
                </div>
        </div>
        </form>


    </div>
</div>
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>種別</th>
                <th>詳細</th>
                <th>金額</th>
                <th>削除</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->detail }}</td>
                <td>{{ $item->money }}</td>
                <!-- 削除formの追加 -->
                <td>
                    <form action="{{ url('items/delete') }}" method="POST"
                        onsubmit="return confirm('削除します。よろしいですか？');">
                        @csrf
                        <input type="hidden" name="id" value="{{$item -> id }}">
                        <input type="submit" value="削除" class="btn btn-danger">
                    </form>
                </td>
                <td>
                    <!-- 編集ボタン -->
                    <a href="/items/edit/{{ $item->id }}" class="btn btn-warning">編集</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</thead>
@stop

@section('css')
<style>
    .input-group-sm {
        display: flex;
        /* ボタンを横並びに */
        gap: 25px;
        /* ボタン間のスペースを設定 */
    }

    .button-container {
        .button-container {
            display: flex;
            justify-content: space-between;
            /* ボタンを左右に配置 */
            align-items: center;
            /* 縦方向に中央揃え */
        }

        .register-button {
            margin-left: auto;
            /* 左側のスペースを自動で埋めて右端に寄せる */
        }
</style>
@stop

@section('js')
@stop