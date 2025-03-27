@extends('adminlte::page')

{{-- @section('title', '条件検索') --}}

@section('content_header')
    
@stop

@section('content')

    <div class="container">
        <h1>条件検索</h1>

        <!-- チェックボックスセクション -->
        <div class="checkbox-group">
            <label><input type="checkbox" id="mens"> メンズ</label>
            <label><input type="checkbox" id="ladies"> レディース</label>
            <label><input type="checkbox" id="kids"> キッズ</label>
            <label><input type="checkbox" id="accessories"> 小物</label>
            <label><input type="checkbox" id="bags"> バック</label>
            <label><input type="checkbox" id="shoes"> 靴</label>
            <label><input type="checkbox" id="new-arrivals"> 新着順</label>
            <label><input type="checkbox" id="desc-order"> 降順</label>
            <label><input type="checkbox" id="asc-order"> 昇順</label>
            <label><input type="checkbox" id="best-sellers"> 売れ行き順</label>
            <label><input type="checkbox" id="in-stock"> 在庫あり</label>
            <label><input type="checkbox" id="out-of-stock"> 在庫なし</label>
        </div>

        <!-- 価格帯 -->
        <div class="price-range">
            <label for="min-price">価格帯: </label>
            <input type="text" id="min-price" placeholder="最小価格">
              <span>円</span> ～ 
            <input type="text" id="max-price" placeholder="最大価格"> <span>円</span>
        </div>
      

        <!-- 検索ボタン -->
        <button id="search-button">条件検索開始</button>
        </form>

        <!-- 検索履歴 -->
        <div id="search-history">
            <h2>検索履歴(最大３つまで)</h2>
            <ul id="history-list">
                <!-- 履歴がここに表示されます -->
            </ul>
        </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
@stop


@section('css')
<style>
.body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f4f4;
}

.container {
  width: 50%;
  background-color: white;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
}

.checkbox-group {
  font-size: 20px;
  display: flex; /*要素を横並びにします*/
  flex-wrap: wrap; /* ラベルが横幅を超えたら折り返し */
  gap: 10px; /* ボタン間のスペース設定 */
}

.checkbox-group label {
  display: block;
  margin: 5px 0;
  margin-right: 20px;/*チェックボックスと条件名のスペース */
  align-items: center;
}

input[type="text"] {
  width: 100px; /* テキスト入力欄の幅を指定（任意） */
  padding: 5px; /* 内側の余白（任意） */
}

.price-range {
  margin-bottom: 15px;
}

#search-button {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

#search-button:hover {
  background-color: #45a049;
}

#search-history {
  margin-top: 30px;
  border-top: 1px solid #ddd;
  padding-top: 10px;
} 

#history-list {
  list-style-type: none;
  padding: 0;
}

#history-list li {
  margin-bottom: 5px;
}
</style>
@stop

@section('js')
<script>
    <!-- // チェックボックスの状態が変化したときに実行される処理
    nameSearchCheckbox.addEventListener('change', function() {
        if (this.checked) {
            // 名前検索チェックボックスがチェックされた場合
            nameInput.disabled = false;  // 名前検索欄を有効にする
            nameInput.focus();           // 名前検索欄にカーソルを移動
        } else {
            // 名前検索チェックボックスがチェック外れた場合
            nameInput.disabled = true;   // 名前検索欄を無効にする
        }
    }); -->

<!-- //   // 名前検索チェックボックスが変更されたとき
//   const nameSearchCheckbox = document.getElementById('name-search');
//   const nameInput = document.getElementById('name-input');
//   const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]:not(#name-search)'); -->


  // 検索ボタンをクリックしたとき
  document.getElementById('search-button').addEventListener('click', function () {
      const selectedConditions = getSelectedConditions();
      addSearchHistory(selectedConditions);
      alert("条件にマッチする商品を検索しました: " + JSON.stringify(selectedConditions));
  });

  // 選択された条件を取得する関数
  function getSelectedConditions() {
      const selectedConditions = {};
      
      // チェックボックスで選択された項目を取得
      document.querySelectorAll('.checkbox-group input[type="checkbox"]:checked').forEach(checkbox => {
          selectedConditions[checkbox.id] = true;
      });
      
      <!-- // 名前検索が有効なら名前入力を追加
      if (nameSearchCheckbox.checked) {
          selectedConditions['name-search-query'] = nameInput.value;
      } -->

      // 価格帯を取得
      const minPrice = document.getElementById('min-price').value;
      const maxPrice = document.getElementById('max-price').value;
      if (minPrice && maxPrice) {
          selectedConditions['price-range'] = `${minPrice}～${maxPrice}`;
      }

      return selectedConditions;
  }

  // 検索履歴を表示する関数
  function addSearchHistory(conditions) {
      const historyList = document.getElementById('history-list');
      const historyItem = document.createElement('li');
      historyItem.textContent = JSON.stringify(conditions);
      
      // 履歴を追加
      historyList.prepend(historyItem);
      
      // 履歴が3つ以上になったら古いものを削除
      if (historyList.children.length > 3) {
          historyList.removeChild(historyList.lastElementChild);
      }
  }
});
</script>
@stop
