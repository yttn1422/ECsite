<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Item extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    //テーブル名
    protected $table = 'items';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'memo',
        'price',
        'img_path',
    ];
    
    public function InsertItem($request)
    {
        // 画像を保存するディレクトリ
        $imageDirectory = 'public/images';

        // リクエストデータを基にアイテムを登録する
        $item = $this->create([
            'name'     => $request->name,
            'memo'     => $request->memo,
            'price'    => $request->price,
            'img_path' => '', // 一旦空の値をセット
        ]);


        // 画像がアップロードされている場合のみ保存
        if ($request->hasFile('img_path') && $request->file('img_path')->isValid()) {
            // 画像を保存
            $path = $request->file('img_path')->store($imageDirectory);

            // データベースの画像パスを更新
            $item->update(['img_path' => $path]);
        }

        return $item;
    }
    
}
