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
                        <!-- 　　一括削除ボタン -->
                            <div class="input-group-append">
                                <button id="bulk-delete" onclick="confirmBulkDelete()" class="btn btn-default">一括削除</button>
                                <!-- <a href="{{ url('items/add') }}" class="btn btn-default">一括削除</a> -->
                            </div>
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
                                <th><input type="checkbox" id="select_all" onclick="toggleSelectAll()"></th> <!-- 全選択/解除 -->
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
                                    <td><input type="checkbox" class="select-item" value=""></td> <!-- 商品ID -->
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
                        .input-group-sm {
                            display: flex; /* ボタンを横並びに */ 
                            gap: 25px; /* ボタン間のスペースを設定 */
                        }
                    </style>
@stop

@section('css')
@stop

@section('js')
<script>
// 全選択/解除のトグル
function toggleSelectAll() {
  const selectAllCheckbox = document.getElementById("select_all");
  const checkboxes = document.querySelectorAll(".select-item");
  checkboxes.forEach(checkbox => {
    checkbox.checked = selectAllCheckbox.checked;
  });
}

// 一括削除の確認
function confirmBulkDelete() {
  const selectedItems = getSelectedItems();
  
  if (selectedItems.length === 0) {
    alert("削除する商品を選択してください。");
    return;
  }

  // 確認ダイアログ
  const confirmDelete = confirm("選択した商品を削除しますか？");
  if (confirmDelete) {
    // 削除処理
    deleteItems(selectedItems);
  }
}

// チェックボックスで選択された商品IDを取得
function getSelectedItems() {
  const selectedItems = [];
  const checkboxes = document.querySelectorAll(".select-item:checked");
  checkboxes.forEach(checkbox => {
    selectedItems.push(checkbox.value); // 商品ID
  });
  return selectedItems;
}

// 商品削除の処理（仮の例）
function deleteItems(items) {
  // ここで選択した商品の削除処理を行う
  console.log("削除する商品ID:", items);
  // AJAXやAPIを使ってサーバー側で削除処理を実行
}
function deleteItems(items) {
  // サーバーにDELETEリクエストを送信（仮のURL）
  fetch('/delete-items', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ ids: items }),
  })
  .then(response => response.json())
  .then(data => {
    alert("削除が完了しました。");
    // 削除後の画面更新などを行う
  })
  .catch(error => {
    alert("削除に失敗しました。");
    console.error(error);
  });
}

</script>
@stop