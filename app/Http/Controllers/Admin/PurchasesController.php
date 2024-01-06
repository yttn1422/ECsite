<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;

class PurchasesController extends Controller
{
    //購入履歴画面
    public function create(Request $request)
    {
        // 検索フォームからのクエリを取得
        $searchUser = $request->input('search_user');
        $searchItem = $request->input('search_item');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // ユーザー名と日付で検索
        $orders = Order::with(['user', 'item'])
            ->when($searchUser, function ($query) use ($searchUser) {
                $query->whereHas('user', function ($userQuery) use ($searchUser) {
                    $userQuery->where('name', 'like', "%$searchUser%");
                });
            })
            ->when($searchItem, function ($query) use ($searchItem) {
                $query->whereHas('item', function ($userQuery) use ($searchItem) {
                    $userQuery->where('name', 'like', "%$searchItem%");
                });
            })
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->when(empty($searchUser) && empty($searchItem) && empty($startDate) && empty($endDate), function ($query) {
                // 何も検索条件が指定されていない場合、ここで全ての結果を取得
            })
            ->paginate(10)
            ->appends([
                'search_user' => $searchUser,
                'search_item' => $searchItem,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
    
        $totalPrice = $orders->sum(function ($order) {
            return $order->item->price * $order->quantity;
        });
    
        return view('admin.purchases', compact('orders', 'totalPrice'));
    }
}

