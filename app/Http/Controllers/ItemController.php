<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
        
    }
     
    
        //     // 商品一覧ページに渡す
        //     return view('items.index', compact('items'));
        // }
    

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'money' => $request->money,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
        // 　　商品削除ボタン
            public function delete(Request $request)
            {
                $item = Item::find($request -> id);
                $item -> delete();
                return redirect('/items');
            }


    // 条件検索ボタン追加してボタンをクリック後条件検索画面へ遷移
    public function show()
    {
        return view('item.show');
    }

// //  編集ボタン
    public function edit($id)
    {
        $item = Item::find($id);
        return view('item.edit', compact('item')); 
    }

    
        // 商品編集完了（POST）: 商品情報を更新する
        public function update(Request $request, $id)
        {
            $item = Item::find($id);  // 編集対象の商品を取得
                $item->name = $request->name;  // 商品名の更新
                $item->money = $request->money;  // 価格の更新
                $item->type = $request->type; /*種別の更新*/
                $item->detail = $request->detail; /*詳細の更新*/
                $item->save();  // データベースに保存
    
         return redirect('/items');  // 商品一覧画面にリダイレクト
        }
} 