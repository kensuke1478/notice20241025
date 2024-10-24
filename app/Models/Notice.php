<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    // モデルに関連づけるテーブル
    protected $table = 'asms_information';

    // テーブルに関連づける主キー
    public $incrementing = false;
    protected $primaryKey = 'information_id';

    // 登録・編集ができるカラムのリスト
    protected $fillable = [
        'information_title',
        'information_kbn',
        'keisai_ymd',
        'enable_start_ymd',
        'enable_end_ymd',
        'information_naiyo',
        'delete_flg',
        'create_time',
        'create_user_cd',
        'update_time',
        'update_user_cd',
    ];

    // update_at・create_atを無効
    public $timestamps = false;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
