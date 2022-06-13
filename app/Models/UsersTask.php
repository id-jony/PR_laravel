<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTask extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'start_date', 'finish_date', 'category', 'title', 'description', 'image', 'condition', 'prize'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'start_date' => 'datetime:d-m-Y',
        'finish_date' => 'datetime:d-m-Y',

    ];
}
