<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function userPage(Request $request)
{
    // 検索フォームからのクエリを取得
    $search = $request->input('search');

    // 検索クエリがある場合は、それを使ってアイテムを検索
    if ($search) {
        $values = Item::where('name', 'like', "%$search%")->paginate(10);
    } else {
        // 検索クエリがない場合は、通常のページネーション
        $values = Item::paginate(10);
    }

    return view('dashboard', compact('values'));
}

public function adminPage(Request $request)
{
    // 検索フォームからのクエリを取得
    $search = $request->input('search');

    // 検索クエリがある場合は、それを使ってアイテムを検索
    if ($search) {
        $values = Item::where('name', 'like', "%$search%")->paginate(10);
    } else {
        // 検索クエリがない場合は、通常のページネーション
        $values = Item::paginate(10);
    }

    return view('admin/dashboard', compact('values'));
}


    public function itemRegisterPage()
    {
        return view('admin/item_register');
    }


    
    public function itemRegister(Request $request)
    {
        // バリデーションを先に行う
        $request->validate([
            'name' => 'required',
            'img_path' => 'required',
            'memo' => 'required|max:200', 
            'price' => 'required|numeric' // 数値であることを確認
        ],
        [
            'name.required' => '商品名は必須項目です。',
            'img_path.required' => '画像の選択は必須です。',
            'memo.required' => '商品説明は必須項目です。',
            'memo.max' => '商品説明は200文字未満で入力してください。',
            'price.required' => '価格は必須項目です。',
            'price.numeric' => '価格は数値で入力してください。'
        ]);
    
        // バリデーションが成功した場合のみ InsertItem メソッドを呼び出す
        (new Item())->InsertItem($request);
    
        // リダイレクト
        return redirect()->route('admin.item_register');
    }
    
    

    public function itemEditPage()
    {
        return view('admin/item_edit');
    }


    // 編集フォーム表示
    public function itemEdit($item_id)
    {
        // 商品を取得して編集フォームに渡す
        $item = Item::find($item_id);
        
        return view('admin/item_edit', ['item' => $item]);
    }
    public function itemDetailPage($id)
    {
        $item = Item::find($id);
        return view('item_detail', compact('item'));
    }
    

    public function update(Request $request, $item_id)
    {
        // バリデーションなど必要に応じて追加
    
        // 商品を取得
        $item = Item::find($item_id);
    
        // 商品画像の更新
        if ($request->hasFile('img_path')) {
            // 以前の画像を削除
            if ($item->img_path) {
                // 以前の画像のパスを取得して削除
                $imagePath = storage_path('app/public/' . $item->img_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // 新しい画像を保存
            $item->img_path = $request->file('img_path')->store('items', 'public');
        }
    
        // 商品情報の更新
        $item->name = $request->input('name');
        $item->memo = $request->input('memo');
        $item->price = $request->input('price');
    
        // 商品保存
        $item->save();
    
        // 編集後の商品一覧ページにリダイレクト
        return redirect()->route('admin.dashboard');
    }

    //削除
    public function delete($id)
    {
        Item::destroy($id);
        return redirect()->route('admin.dashboard');
    }




}