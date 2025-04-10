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
    public function index(Request $request)
    {

        // リクエストからキーワードを取得
        $keyword = $request->input('keyword', '');  // フリーワード


        // 商品の絞り込み（キーワードで商品名や説明を検索）
        $query = Item::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%')  // 商品名に一致するキーワードを検索
                ->orWhere('type', 'like', '%' . $keyword . '%') // 商品説明にも一致するキーワードを検索
                ->orWhere('detail', 'like', '%' . $keyword . '%');
        });

        $sortType = $request->input('sort', 'newest');

        switch ($sortType) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $items = $query->get();  // 検索結果を取得



        // ビューにデータを渡す
        return view('item.index', compact('items', 'keyword'));/*キーワード検索 */

        // $request->validate([
        //     'keyword' => 'nullable|string|max:255',
        // ]);

        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));

        // 商品一覧ページに渡す
        return view('items.index', compact('items'));
    }

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
                'type' => 'required|max:50',
                'detail' => 'required|max:200',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    // 　　商品削除ボタン
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        return redirect('/items');
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
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'required|max:50',
                'detail' => 'required|max:200',
            ]);
        $item = Item::find($id);  // 編集対象の商品を取得
        $item->name = $request->name;  // 商品名の更新
        $item->type = $request->type; /*種別の更新*/
        $item->detail = $request->detail; /*詳細の更新*/
        $item->save();  // データベースに保存

        return redirect('/items');  // 商品一覧画面にリダイレクト
        }
    }
}