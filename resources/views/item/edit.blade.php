@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop
<!-- 編集フォーム -->
<form action="{{ url('/edit/'.$item->id) }}" method="POST">
        @csrf
        @method('POST')  <!-- POSTメソッドを指定 -->

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                    </ul>
                </div>
            @endif

                <div class="card card-primary">
                <form action="/items/update/{{$item->id}}" method="POST">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{$item -> name}}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="種別"value="{{$item -> type}}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細"value="{{$item -> detail}}">
                        </div>

                        <!-- <div class="form-group">
                            <label for="money">金額</label>
                            <input type="text" class="form-control" id="money" name="money" placeholder="金額"value="{{$item -> money}}">
                        </div> -->
                    </div>

                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">編集破棄</button>
                        <!-- <a href = "{{ url('items') }}"  class="cancel-button">編集破棄</a> -->
                        <button type="submit"  class="btn btn-primary">編集完了</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</from>
@stop

@section('css')
                    <style>
                        .card-footer {
                            display: flex; /* ボタンを横並びに */ 
                            gap: 25px; /* ボタン間のスペースを設定 */
                        }
                    </style>
@stop

@section('js')
@stop
