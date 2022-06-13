<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UsersTask;


class Consumer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['phone', 'uin', 'fio', 'age', 'gender', 'city', 'lang', 'ref_user_id', 'prize_id'];

    public function getShortPhoneAttribute()
    {
        return sprintf('%s***', substr($this->phone, 0, 9));
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {

            // Бонусирование промоутеров за регистарцию консьюмера
            if (($id = $model->ref_user_id) !== null) {
                $promoter = User::where('id', $id)->first();
                $promoter->increment('user_count');
                $promoter->increment('bonus_count');
            }
        });
    }


    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'banned_at' => 'datetime:d-m-Y H:i:s',
    ];
}
