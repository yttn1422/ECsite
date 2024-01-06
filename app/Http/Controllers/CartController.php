<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        // ログイン中のユーザーを取得
        $user = Auth::user();
    
        // ユーザーに関連するカートアイテムを取得
        $cartItems = Cart::where('user_id', $user->id)->with('item')->get();
    
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->item->price * $cartItem->quantity;
        });
    
        return view('cart', compact('cartItems', 'totalPrice'));
    }
    




    // カートにアイテムを追加するメソッド
    public function addToCart(Request $request, $itemId)
    {
        // カートに追加するアイテムを取得
        $item = Item::find($itemId);

        // カートにアイテムがない場合は新しく作成し、数量を増やす
        
        Cart::updateOrCreate(
            ['item_id' => $item->id],
            [
                'user_id' => auth()->user()->id,
                'quantity' => Cart::raw('quantity + 1') // 既存の数量に1を加える
            ]
        );

        return redirect()->route('dashboard' )->with('success', 'カートにアイテムを追加しました。');
    }

        //削除
        public function delete($id)
        {
            Cart::destroy($id);
            return redirect()->route('cart.show');
        }
}
