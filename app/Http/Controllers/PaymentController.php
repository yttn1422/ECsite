<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPayment()
    {
        return view('payment');
    }

    public function storePayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));
        $user = Auth::user();
        
        // ユーザーに関連するカートアイテムを取得
        $cartItems = Cart::where('user_id', $user->id)->with('item')->get();
    
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->item->price * $cartItem->quantity;
        });
    
        try {
            DB::beginTransaction();
            \Stripe\Charge::create([
                'source' => $request->stripeToken,
                'amount' => $totalPrice,
                'currency' => 'jpy',
            ]);
            foreach ($cartItems as $item){
                Order::create([
                    'user_id' => $item->user_id,
                    'item_id' => $item->item_id,
                    'quantity' =>$item->quantity,
                ]);
                $item->delete();
            }
            DB::commit();
            return view('complete')->with('status', '決済が完了しました！');
        } catch (QueryException $e) {
            DB::rollBack();
            // データベースエラーが発生した場合の処理
            return back()->with('flash_alert', 'データベースエラーが発生しました: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            // その他の例外が発生した場合の処理
            return back()->with('flash_alert', '決済に失敗しました！(' . $e->getMessage() . ')');
        }
    }
        //public function complete()
    //{
        //Cart::clear();

        //return view('complete');
    //}
}
