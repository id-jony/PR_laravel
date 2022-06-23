<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'task_id',
      'prize',
  ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function task()
    {
      return $this->belongsTo(UsersTask::class);
    }
}
