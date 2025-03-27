@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                        <!-- 　　一括削除ボタン
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">一括削除</a>
                            </div> -->
                            <!-- 条件検索ボタン -->
                            <div class="input-group-append">
                                <a href="{{ url('items/show') }}" class="btn btn-default">条件検索</a>
                            </div>
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
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
                                        <form action="{{ url('items/delete') }}" method = "POST"
                                            onsubmit = "return confirm('削除します。よろしいですか？');">
                                        @csrf
                                            <input type = "hidden" name = "id" value = "{{$item -> id }}">
                                            <input type = "submit" value = "削除" class = "btn btn-danger">
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
                        .card-footer {
                            display: flex; /* ボタンを横並びに */ 
                            gap: 25px; /* ボタン間のスペースを設定 */
                        }
                    </style>
@stop

@section('css')
@stop

@section('js')
@stop
